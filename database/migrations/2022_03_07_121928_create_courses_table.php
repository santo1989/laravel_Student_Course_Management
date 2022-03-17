<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course_code');
            $table->string('course_type');
            $table->string('course_duration');
            $table->string('course_fee');
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
