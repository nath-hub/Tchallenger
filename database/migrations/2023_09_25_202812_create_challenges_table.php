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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('type');
            $table->string('lieu');
            $table->integer('price');
            $table->boolean('private')->default(0);
            $table->string('url_video');
            $table->string('url_audio');
            $table->string('url_image');

            $table->index(["categorie_id"], "fk_categories_challenge");

            $table->foreign('categorie_id')->references('id')->on('categories');

            $table->softDeletes();
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
        Schema::dropIfExists('challenges');
    }
};
