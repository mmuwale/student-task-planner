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
            $table->string('course_code')->unique(); // e.g., ICS 1201
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('instructor')->nullable();
            $table->string('color')->default('#3b82f6');
            $table->integer('credit_hours')->default(3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};