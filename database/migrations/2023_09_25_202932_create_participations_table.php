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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('vues')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('nb_vote')->default(0);
            $table->softDeletes();

            $table->index(["post_id"], "fk_post_participation");
            $table->index(["user_id"], "fk_user_participation");
            $table->index(["media_id"], "fk_media_participation");

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('media_id')->references('id')->on('media');

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
