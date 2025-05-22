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
       Schema::create('user_profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');

    // Basic Details
    $table->string('phone')->nullable();
    $table->string('address')->nullable();
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->string('country')->nullable();

    // Education & Certificates
    $table->string('qualification')->nullable();
    $table->text('certificates')->nullable(); // changed from string to text for multiple certs

    // Resume and Experience
    $table->string('resume')->nullable(); // path to file
    $table->text('experience')->nullable(); // spelling fixed from "expirence"
    $table->text('summary')->nullable();

    // Social Links
    $table->string('github')->nullable();
    $table->string('linkedin')->nullable();

    // Skills
    $table->text('skills')->nullable(); // changed from string to text for more flexibility (JSON, comma-separated, etc.)

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
