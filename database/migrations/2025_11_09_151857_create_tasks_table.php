<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // In database/migrations/2025_11_09_151857_create_tasks_table.php

public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->date('due_date')->nullable();
        $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        
        // CHANGE THIS: Use regular unsignedBigInteger instead of foreignId
        $table->unsignedBigInteger('project_id')->nullable();
        $table->unsignedBigInteger('category_id')->nullable();
        
        $table->foreignId('created_by')->constrained('users');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};