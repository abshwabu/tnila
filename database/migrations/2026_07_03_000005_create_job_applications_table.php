<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->cascadeOnDelete();
            $table->string('applicant_name');
            $table->string('email')->index();
            $table->string('phone');
            $table->string('resume');
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('new')->index();
            $table->timestamp('created_at')->useCurrent();
        });
    }
};
