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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->enum('color', ['BACK', 'WHITE'])->default('WHITE');
            $table->boolean('notif_abonnement')->default(1);
            $table->boolean('notif_challenge')->default(1);
            $table->boolean('notif_comment')->default(1);
            $table->boolean('notif_publication')->default(1);
            $table->boolean('notif_message')->default(1);
            $table->boolean('langue')->default(1);

            $table->index(["user_id"], "fk_parameter_user");

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('parameters');
    }
};
