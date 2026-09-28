<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ERP_TREE_PAGE_MAPPINGS', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tree_value')->unique();

            $table->unsignedBigInteger('page_id');

            $table->timestamps();

            $table->foreign('page_id')
                ->references('id')
                ->on('ERP_PAGES')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ERP_TREE_PAGE_MAPPINGS');
    }
};