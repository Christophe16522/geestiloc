<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->enum('type', ['appartement', 'maison', 'studio', 'commercial', 'autre'])->default('appartement');
            $table->decimal('surface_m2', 8, 2)->nullable();
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('charges', 10, 2)->default(0);
            $table->decimal('deposit', 10, 2)->default(0);
            $table->enum('status', ['occupee', 'vacante'])->default('vacante');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
