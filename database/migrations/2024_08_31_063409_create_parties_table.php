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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->onDelete('set null');
            $table->string('party_name'); // Name of the party
            $table->string('contact_number')->nullable(); // Contact number (optional)
            $table->string('email')->nullable(); // Email address (optional)
            $table->text('address')->nullable(); // Address (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
