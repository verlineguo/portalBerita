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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->longText('description');
            $table->unsignedBigInteger('category_id');
            $table->integer('views');
            $table->integer('comments');
            $table->unsignedBigInteger('writer_id');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on(table: 'category')->onDelete('cascade');
            $table->foreign('writer_id')->references('id')->on(table: 'users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }

    
};
