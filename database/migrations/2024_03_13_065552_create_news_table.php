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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('news_title');
            $table->string('author_name')->nullable();;
            $table->unsignedBigInteger('id_news_category'); // Sử dụng unsignedBigInteger để đảm bảo khóa ngoại là số dương.
            $table->foreign('id_news_category')->references('id')->on('news_categories')->onDelete('cascade'); 
            $table->string('thumbnail')->nullable();;
            $table->text('description')->nullable();;
            $table->text('content')->nullable();;
            $table->enum('status',['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};