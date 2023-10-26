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
        Schema::create('vote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('participation_id');
            $table->date("date");

            $table->index(["user_id"], "fk_vote_user");
            $table->index(["participation_id"], "fk_participation_vote");

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('participation_id')->references('id')->on('participations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote');
    }
};
