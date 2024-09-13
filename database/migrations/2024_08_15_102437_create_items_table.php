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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->onDelete('set null');
            $table->string('item_name');
            $table->timestamps();
        });
    }

    /**
     * ALTER TABLE items ADD COLUMN gross DECIMAL(8, 3) NULL AFTER item;

     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
