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
        // If the 'role_user' table already exists (e.g., from a legacy system), skip.
        if (Schema::hasTable('role_user')) {
            return;
        }

        Schema::create('role_user', function (Blueprint $table) {
            // Oracle-safe ID
            $table->bigInteger('id')->unsigned()->autoIncrement();

            // Foreign key columns
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();

            // Explicit short FK names (Oracle 30-char limit)
            $table->foreign('user_id', 'ru_user_foreign')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('role_id', 'ru_role_foreign')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');

            // Explicit short unique name
            $table->unique(['user_id', 'role_id'], 'role_user_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};