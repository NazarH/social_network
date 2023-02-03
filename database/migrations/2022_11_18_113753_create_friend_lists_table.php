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
        Schema::create('friend_lists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invite_friend_id')->nullable();
            $table->index('invite_friend_id', 'user_friend_invite_friend_idx');
            $table->foreign('invite_friend_id', 'user_friend_invite_friend_fk')->on('users')->references('id');

            $table->unsignedBigInteger('invited_friend_id')->nullable();
            $table->index('invited_friend_id', 'user_friend_invited_friend_idx');
            $table->foreign('invited_friend_id', 'user_friend_invited_friend_fk')->on('users')->references('id');

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
        Schema::dropIfExists('friend_lists');
    }
};
