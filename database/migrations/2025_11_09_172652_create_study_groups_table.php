<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
{
    Schema::create('study_groups', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->foreignId('task_id')->constrained()->onDelete('cascade'); // Changed from course_id to task_id
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        $table->integer('max_members')->default(5);
        $table->enum('status', ['active', 'inactive', 'completed'])->default('active');
        $table->timestamps();
        
        $table->unique(['task_id']); // One group per task
    });
}
   

    public function down()
    {
        Schema::dropIfExists('study_groups');
    }
};