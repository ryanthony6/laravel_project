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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('court');
            $table->decimal('price', 10, 2); 
            $table->date('schedule_date'); 
            $table->dateTime('schedule');
            $table->enum('status', ['available', 'booked', 'not_available'])->default('available');
            $table->unsignedBigInteger('user_id')->nullable(); // Added user_id column
            $table->timestamps();
            $table->unique(['court', 'schedule']);

            // Add foreign key constraint if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key constraint
        });
        Schema::dropIfExists('schedules');
    }
};
