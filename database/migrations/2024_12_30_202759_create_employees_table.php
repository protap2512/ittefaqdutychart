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
        // database/migrations/xxxx_xx_xx_create_employees_table.php
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation'); // e.g., News Editor, Shift Incharge, Sub Editor, Artist
            $table->string('weekly_offday'); // e.g., Sunday, Monday
            $table->boolean('is_bideshi')->default(false);
            $table->boolean('is_bideshi_substitute')->default(false);
            $table->string('profile_image')->nullable(); // Path to the profile image
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
