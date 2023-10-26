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
            $table->unsignedBigInteger('post_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('url_video');
            $table->string('url_audio');
            $table->string('url_image');
            $table->integer('likes')->default(0);
            $table->integer('vues')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('comments')->default(0);
            $table->softDeletes();

            $table->index(["post_id"], "fk_post_participation");

            $table->foreign('post_id')->references('id')->on('posts');

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
