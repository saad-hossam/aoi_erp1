<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Oracle-safe ID
            $table->bigInteger('id')->unsigned()->autoIncrement();

            // Link back to the Oracle EMP table (store EMP_NO)
            $table->bigInteger('emp_no')->unsigned()->nullable();

            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            // Explicit short unique names for Oracle
            $table->unique('emp_no', 'users_emp_no_unique');
            $table->unique('email', 'users_email_unique');
        });

        // Password reset tokens table (needed by Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 255)->primary();
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table (needed for login persistence)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');

            $table->index('user_id', 'sessions_user_id_idx');
            $table->index('last_activity', 'sessions_last_activity_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};