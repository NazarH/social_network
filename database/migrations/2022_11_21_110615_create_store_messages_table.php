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
        Schema::create('store_messages', function (Blueprint $table) {
            $table->id();

            $table->text('message');

            $table->unsignedBigInteger('from_id')->nullable();
            $table->index('from_id', 'user_store_message_from_idx');
            $table->foreign('from_id', 'user_store_message_from_fk')->on('users')->references('id');

            $table->unsignedBigInteger('to_whom_id')->nullable();
            $table->index('to_whom_id', 'user_store_message_to_whom_idx');
            $table->foreign('to_whom_id', 'user_store_message_to_whom_fk')->on('users')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_messages');
    }
};
