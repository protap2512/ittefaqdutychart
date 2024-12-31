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
        Schema::create('duty_rotations', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // e.g., "Late Night", "Picture Selection"
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('start_date'); // Start date for rotation
            $table->unsignedInteger('sequence_order'); // Order of rotation
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duty_rotations');
    }
};
