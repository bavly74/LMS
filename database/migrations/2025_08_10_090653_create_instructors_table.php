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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('document')->nullable();
            $table->enum('status',['approved','pending','rejected'])->default('pending');
            $table->string('image')->default('/default-files/default.png');
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->string('facebook')->nullable();
            $table->string('x')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
