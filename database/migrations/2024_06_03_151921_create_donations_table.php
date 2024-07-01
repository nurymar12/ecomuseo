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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['material', 'dinero'])->default('material');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('razon_social')->nullable();
            $table->string('persona_contacto');
            $table->string('celular_contacto');
            $table->string('email_contacto');
            $table->date('requested_date');
            $table->date('approved_date')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
