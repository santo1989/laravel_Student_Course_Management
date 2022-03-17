<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('role_id')->refarence('id')->on('roles');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
