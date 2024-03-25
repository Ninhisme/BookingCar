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
        Schema::create('booking_cars', function (Blueprint $table) {
            $table->id();
            $table->string('name_customer');
            $table->string('phone');
            $table->string('location');
            $table->string('destination');
            $table->string('round_way')->nullable();
            $table->unsignedBigInteger('id_car_category'); // Sử dụng unsignedBigInteger để đảm bảo khóa ngoại là số dương.
            $table->foreign('id_car_category')->references('id')->on('car_categories')->onDelete('cascade'); 
            $table->string('appointment_time');
            $table->text('postage');
            $table->enum('status',['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_cars');
    }
};