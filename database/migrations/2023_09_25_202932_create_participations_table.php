<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('challenge_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('url_video');
            $table->string('url_audio');
            $table->string('url_image');
            $table->softDeletes();

            $table->index(["challenge_id"], "fk_challenge_participation");

            $table->foreign('challenge_id')->references('id')->on('challenges');

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
        Schema::dropIfExists('participations');
    }
};
