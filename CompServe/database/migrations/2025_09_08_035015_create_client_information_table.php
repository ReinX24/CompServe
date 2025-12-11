<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_information', function (Blueprint $table) {
            $table->id();

            // Relationship to users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic details
            $table->string('company_name')->nullable();   // If client is an organization
            $table->string('contact_person')->nullable(); // If client is an individual
            $table->string('contact_number')->nullable();
            $table->string('website')->nullable();

            // Location
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            // Business Info
            $table->text('about_us')->nullable();
            $table->string('industry')->nullable(); // e.g. Tech, Marketing, Design
            $table->integer('company_size')->nullable(); // Number of employees

            $table->json('social_links')->nullable(); // LinkedIn, Twitter, etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_information');
    }
};
