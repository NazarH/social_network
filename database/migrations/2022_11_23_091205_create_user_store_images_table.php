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
        Schema::create('user_store_images', function (Blueprint $table) {
            $table->id();

            $table->string('img_url');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'user_user_store_images_user_idx');
            $table->foreign('user_id', 'user_user_store_images_user_fk')
                ->on('users')->references('id');

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
        Schema::dropIfExists('user_store_images');
    }
};
