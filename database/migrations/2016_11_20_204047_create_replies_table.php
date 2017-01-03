<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("post_id")->unsigned()->index(); //link to the reply
            $table->integer("replyto_id")->unsigned()->index(); //link to the original post
            $table->integer("user_id")->unsigned()->index(); //link to the user who made the reply
            $table->integer("reply_id")->unsigned()->index()->nullable(); //if filled: link the reply to a reply
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
        Schema::dropIfExists('replies');
    }
}
