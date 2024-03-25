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
        Schema::create('car_categories', function (Blueprint $table) {
            $table->id();
            $table->string('car_category_name');
            $table->string('car_category_img');
            $table->string('car_fare_under_30');
            $table->string('car_fare_up_30');
            $table->enum('status',['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_categories');
    }
};