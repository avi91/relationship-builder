<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->unsignedInteger('user1');
            $table->unsignedInteger('user2');
            $table->unsignedInteger('tag');
            $table->primary(['user1','user2']);
            $table->foreign('user1')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user2')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tag')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
            $table->index('user1','user2');
        });
    }

    /**
     * ALTER TABLE edges ADD CONSTRAINT no_self_loop CHECK (user1 <> user2)
     *
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('relationship');
    }
}
