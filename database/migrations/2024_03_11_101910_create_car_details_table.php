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
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->unsignedBigInteger('car_category_id'); // Sử dụng unsignedBigInteger để đảm bảo khóa ngoại là số dương.
            $table->foreign('car_category_id')->references('id')->on('car_categories')->onDelete('cascade'); // Tạo khóa ngoại và thiết lập chính sách xóa nếu bảng cha bị xóa.
            $table->string('storage');
            $table->string('seat');
            $table->string('price');          
            $table->enum('status', ['Hoạt động', 'Dừng hoạt động'])->default('Hoạt động');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_details');
    }
};