<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgnizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgnizers', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('profile_img')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('login_token')->nullable();
            $table->string('api_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orgnizers');
    }
}
