<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ERP_PAGES', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('type')->default('application');

            $table->string('component')->nullable();
            $table->string('controller')->nullable();

            $table->string('route_name')->unique();
            $table->string('route_path')->unique();

            $table->string('status')
                ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ERP_PAGES');
    }
};