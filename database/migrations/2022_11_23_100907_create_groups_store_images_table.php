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
        Schema::create('groups_store_images', function (Blueprint $table) {
            $table->id();

            $table->string('img_url');

            $table->unsignedBigInteger('group_id')->nullable();
            $table->index('group_id', 'list_groups_user_store_images_user_idx');
            $table->foreign('group_id', 'list_groups_user_store_images_user_fk')
                ->on('list_groups')->references('id');

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
        Schema::dropIfExists('groups_store_images');
    }
};
