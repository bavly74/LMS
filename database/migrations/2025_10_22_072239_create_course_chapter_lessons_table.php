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
        Schema::create('course_chapter_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignId('chapter_id')->constrained('course_chapters')->onDelete('cascade');
            $table->text('file_path');
            $table->enum('storage', ['upload', 'youtube', 'vimeo', 'external_link']);
            $table->string('volume')->nullable();
            $table->string('duration')->nullable();
            $table->enum('file_type', ['video', 'audio', 'doc','pdf', 'file']);
            $table->boolean('is_preview')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_downloadable')->default(false);
            $table->enum('lesson_type',['lesson','live']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_chapter_lessons');
    }
};
