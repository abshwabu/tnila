<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->index();
            $table->string('company_name')->nullable();
            $table->string('address');
            $table->text('notes')->nullable();
            $table->string('status')->default('lead')->index();
            $table->string('source')->default('website')->index();
            $table->timestamps();
        });
    }
};
