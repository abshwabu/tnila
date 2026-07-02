<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('author_name');
            $table->string('author_role')->nullable();
            $table->string('company')->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('rating');
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('approved')->default(false)->index();
        });
    }
};
