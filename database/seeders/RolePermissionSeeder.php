<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (['view emps', 'create emps', 'edit emps', 'delete emps'] as $name) {
            Permission::findOrCreate($name, 'web');
        }

        $admin  = Role::findOrCreate('admin', 'web');
        $editor = Role::findOrCreate('editor', 'web');

        $admin->syncPermissions(Permission::all());
        $editor->syncPermissions(['view emps']);
    }
}
