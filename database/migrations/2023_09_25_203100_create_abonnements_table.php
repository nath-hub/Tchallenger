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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_from_id');
            $table->unsignedBigInteger('user_to_id');
            $table->date("date");

            $table->index(["user_from_id"], "fk_from_user");
            $table->index(["user_to_id"], "fk_to_user");

            $table->foreign('user_from_id')->references('id')->on('users');
            $table->foreign('user_to_id')->references('id')->on('users');
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
        Schema::dropIfExists('abonnements');
    }
};
