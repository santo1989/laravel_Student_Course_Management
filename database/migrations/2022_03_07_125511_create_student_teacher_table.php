<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTeacherTable extends Migration
{
    
    public function up()
    {
        Schema::create('student_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->reference('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id')->reference('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('student_teacher');
    }
}
