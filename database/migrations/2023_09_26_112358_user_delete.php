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
        Schema::create('user_delete', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('email');
            $table->string('phone');
            $table->boolean('active');
            $table->date('derniereConnexion');
            $table->string('avatar');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        //
    }
};
