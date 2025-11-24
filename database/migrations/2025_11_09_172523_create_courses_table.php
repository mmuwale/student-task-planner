<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->nullable(); // Remove unique() - users can have same course codes
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('instructor')->nullable();
            $table->integer('credit_hours')->default(3);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ADD THIS LINE
            $table->timestamps();
            
            // A user can't have duplicate course codes, but different users can
            $table->unique(['course_code', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};