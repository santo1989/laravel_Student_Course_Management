<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
   
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->reference('id')->on('students')->onDelete('cascade');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('image');
            $table->date('dob');
            $table->softDeletes();
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
