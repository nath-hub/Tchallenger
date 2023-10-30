<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum("type", ["STANDARD", "CHALLENGE"])->default("CHALLENGE");

            $table->timestamp('end_date');
            $table->timestamp('start_date')->nullable();
            $table->string('lieu')->nullable();
            $table->enum('state', ['OPEN', 'CLOSE'])->default("OPEN");
            $table->enum('state_signe', ['OPEN', 'BLOCK'])->default("OPEN");
            $table->integer('price')->nullable();
            $table->boolean('private')->default(0);
            $table->string('url_video')->nullable();
            $table->string('url_audio')->nullable();
            $table->string('url_image')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('vues')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('n_vote')->default(0);
            $table->integer('comments')->default(0);

            $table->index(["user_id"], "fk_user_post");
            $table->index(["categorie_id"], "fk_categories_post");

            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
