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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('user_id');
            // $table->string('party_name');
            $table->unsignedBigInteger('party_id');
            $table->string('item');
            $table->decimal('gross', 8, 3)->default(0)->nullable();
            $table->decimal('weight', 8, 3)->default(0)->nullable();
            $table->decimal('less', 8, 3)->default(0)->nullable();
            $table->decimal('add', 8, 3)->default(0)->nullable();
            $table->decimal('net_wt', 8, 3)->default(0)->nullable();
            $table->decimal('touch', 5, 2)->default(0)->nullable();
            $table->decimal('wastage', 5, 2)->default(0)->nullable();
            $table->decimal('fine', 8, 3)->default(0)->nullable();
            $table->date('date');
            $table->text('note')->nullable();
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
