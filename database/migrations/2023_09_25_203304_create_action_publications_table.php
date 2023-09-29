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
        Schema::create('action_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('challenge_id')->nullable();
            $table->unsignedBigInteger('publication_id')->nullable();
            $table->unsignedBigInteger('participation_id')->nullable();
            $table->string("comments")->nullable();
            $table->enum("type", ["LIKE", "VOTE", "VUE", "FAVORIS", "COMMENTAIRE"]);
            $table->string("ip_adress")->nullable();
            $table->enum("canal", ["WHATSAPP", "FACEBOOK", "GMAIL", "PHONE_NUMBER"])->nullable();

            $table->index(["user_id"], "fk_parameter_user");
            $table->index(["challenge_id"], "fk_challenger_user");
            $table->index(["publication_id"], "fk_publication_user");
            $table->index(["participation_id"], "fk_participation_user");

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('challenge_id')->references('id')->on('challenges');
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->foreign('participation_id')->references('id')->on('participations');
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
        Schema::dropIfExists('action_publications');
    }
};
