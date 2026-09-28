
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        throw_if(
            empty($tableNames),
            new Exception(
                'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.'
            )
        );

        throw_if(
            $teams && empty($columnNames['team_foreign_key'] ?? null),
            new Exception(
                'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.'
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        Schema::create($tableNames['permissions'], static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('guard_name');

            $table->timestamps();

            $table->unique(
                ['name', 'guard_name'],
                'permissions_name_guard_uq'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        Schema::create($tableNames['roles'], static function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id');

            if ($teams || config('permission.testing')) {
                $table->unsignedBigInteger(
                    $columnNames['team_foreign_key']
                )->nullable();

                $table->index(
                    $columnNames['team_foreign_key'],
                    'roles_team_idx'
                );
            }

            $table->string('name');
            $table->string('guard_name');

            $table->timestamps();

            if ($teams || config('permission.testing')) {
                $table->unique(
                    [
                        $columnNames['team_foreign_key'],
                        'name',
                        'guard_name',
                    ],
                    'roles_team_name_guard_uq'
                );
            } else {
                $table->unique(
                    ['name', 'guard_name'],
                    'roles_name_guard_uq'
                );
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Model Has Permissions
        |--------------------------------------------------------------------------
        */

        Schema::create(
            $tableNames['model_has_permissions'],
            static function (Blueprint $table) use (
                $tableNames,
                $columnNames,
                $pivotPermission,
                $teams
            ) {
                $table->unsignedBigInteger($pivotPermission);

                $table->string('model_type');

                $table->unsignedBigInteger(
                    $columnNames['model_morph_key']
                );

                $table->index(
                    [
                        $columnNames['model_morph_key'],
                        'model_type',
                    ],
                    'mhperm_model_idx'
                );

                $table->foreign($pivotPermission, 'mhperm_perm_fk')
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                if ($teams) {
                    $table->unsignedBigInteger(
                        $columnNames['team_foreign_key']
                    );

                    $table->index(
                        $columnNames['team_foreign_key'],
                        'mhperm_team_idx'
                    );

                    $table->primary(
                        [
                            $columnNames['team_foreign_key'],
                            $pivotPermission,
                            $columnNames['model_morph_key'],
                            'model_type',
                        ],
                        'mhperm_pk'
                    );
                } else {
                    $table->primary(
                        [
                            $pivotPermission,
                            $columnNames['model_morph_key'],
                            'model_type',
                        ],
                        'mhperm_pk'
                    );
                }
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Model Has Roles
        |--------------------------------------------------------------------------
        */

        Schema::create(
            $tableNames['model_has_roles'],
            static function (Blueprint $table) use (
                $tableNames,
                $columnNames,
                $pivotRole,
                $teams
            ) {
                $table->unsignedBigInteger($pivotRole);

                $table->string('model_type');

                $table->unsignedBigInteger(
                    $columnNames['model_morph_key']
                );

                $table->index(
                    [
                        $columnNames['model_morph_key'],
                        'model_type',
                    ],
                    'mhrole_model_idx'
                );

                $table->foreign($pivotRole, 'mhrole_role_fk')
                    ->references('id')
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                if ($teams) {
                    $table->unsignedBigInteger(
                        $columnNames['team_foreign_key']
                    );

                    $table->index(
                        $columnNames['team_foreign_key'],
                        'mhrole_team_idx'
                    );

                    $table->primary(
                        [
                            $columnNames['team_foreign_key'],
                            $pivotRole,
                            $columnNames['model_morph_key'],
                            'model_type',
                        ],
                        'mhrole_pk'
                    );
                } else {
                    $table->primary(
                        [
                            $pivotRole,
                            $columnNames['model_morph_key'],
                            'model_type',
                        ],
                        'mhrole_pk'
                    );
                }
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Role Has Permissions
        |--------------------------------------------------------------------------
        */

        Schema::create(
            $tableNames['role_has_permissions'],
            static function (Blueprint $table) use (
                $tableNames,
                $pivotRole,
                $pivotPermission
            ) {
                $table->unsignedBigInteger($pivotPermission);

                $table->unsignedBigInteger($pivotRole);

                $table->foreign($pivotPermission, 'rhperm_perm_fk')
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                $table->foreign($pivotRole, 'rhperm_role_fk')
                    ->references('id')
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                $table->primary(
                    [$pivotPermission, $pivotRole],
                    'rhperm_pk'
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Clear Permission Cache
        |--------------------------------------------------------------------------
        */

        app('cache')
            ->store(
                config('permission.cache.store') != 'default'
                    ? config('permission.cache.store')
                    : null
            )
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception(
                'Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.'
            );
        }

        Schema::dropIfExists($tableNames['role_has_permissions']);
        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::dropIfExists($tableNames['model_has_permissions']);
        Schema::dropIfExists($tableNames['roles']);
        Schema::dropIfExists($tableNames['permissions']);
    }
};