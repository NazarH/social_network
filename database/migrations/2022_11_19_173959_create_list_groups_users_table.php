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
        Schema::create('list_groups_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id')->nullable();
            $table->index('group_id', 'list_group_user_group_idx');
            $table->foreign('group_id', 'list_group_user_group_fk')->on('list_groups')->references('id');

            $table->unsignedBigInteger('member_id')->nullable();
            $table->index('member_id', 'list_group_user_member_idx');
            $table->foreign('member_id', 'list_group_user_member_fk')->on('users')->references('id');

            $table->string('role')->default('user');

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
        Schema::dropIfExists('list_groups_users');
    }
};
