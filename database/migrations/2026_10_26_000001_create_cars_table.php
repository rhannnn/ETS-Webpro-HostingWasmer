<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('category', ['Supercar', 'Luxury Sedan', 'Motorsport', 'SUV']);
            $table->decimal('price_per_day', 12, 2);
            $table->unsignedInteger('hp');
            $table->unsignedInteger('top_speed');
            $table->enum('status', ['available', 'rented'])->default('available');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
