<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_id');
            $table->string('name');
            $table->string('job');
            $table->string('phone');
            $table->text('address');
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->string('vk')->nullable();
            $table->string('inst')->nullable();
            $table->string('tg')->nullable();
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
        Schema::dropIfExists('info_users');
    }
}
