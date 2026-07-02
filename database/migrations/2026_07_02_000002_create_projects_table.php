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
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('customer_id')->nullable()->index();
            $table->unsignedBigInteger('industry_id')->index();
            $table->text('description');
            $table->string('status')->index();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location');
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->index('featured');
        });
    }
};
