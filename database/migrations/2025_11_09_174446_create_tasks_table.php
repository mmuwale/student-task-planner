<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('assignment_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'on_hold'])->default('not_started');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->dateTime('due_date')->nullable();
            $table->integer('estimated_duration')->nullable(); // in minutes
            $table->integer('actual_duration')->nullable(); // in minutes
            $table->decimal('progress', 5, 2)->default(0); // 0-100%
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_pattern')->nullable();
            $table->enum('type', ['assignment', 'study', 'review', 'project', 'personal'])->default('assignment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};