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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invite_id')->nullable();
            $table->index('invite_id', 'user_friend_invite_idx');
            $table->foreign('invite_id', 'user_friend_invite_fk')->on('users')->references('id');

            $table->unsignedBigInteger('invited_id')->nullable();
            $table->index('invited_id', 'user_friend_invited_idx');
            $table->foreign('invited_id', 'user_friend_invited_fk')->on('users')->references('id');

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
        Schema::dropIfExists('friends');
    }
};
