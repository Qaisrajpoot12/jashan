<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('cover_img')->nullable();
            $table->string('profile_img');
            $table->string('banner_img')->nullable();
            $table->string('description')->nullable();
            $table->string('organizer_id');
            $table->string('event_slug');
            $table->string('country');
            $table->string('city');
            $table->string('event_start_date');
            $table->string('event_end_date');
            $table->string('fb_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->string('sk_link')->nullable();
            $table->string('what_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('other_link')->nullable();
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
        Schema::dropIfExists('events');
    }
}
