<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->string('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default('completed');
            $table->boolean('featured')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }
};
