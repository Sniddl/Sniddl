<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts', function (Blueprint $table) {
          $table->increments('id');
          $cs = $table->string('url')->unique();
          $table->integer('user_id')->unsigned()->index();
          $table->integer('community_id')->unsigned()->index();
          $table->longText('text');
          $table->softDeletes();
          $table->timestamps();
          $cs->collation = 'utf8_bin';
      });

      Schema::create('events', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('post_id')->unsigned()->index();
        $table->integer('added_by')->unsigned()->index();
        $table->boolean('is_vote')->default(FALSE);
        $table->boolean('is_reply')->default(FALSE);
        $table->softDeletes();
        $table->timestamps();
      });


      Schema::create('votes', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('post_id')->unsigned()->index();
        $table->integer('voter')->unsigned()->index();
        $table->integer('op')->unsigned()->index(); //leave so we can count total votes
        $table->string('type')->nullable();
        $table->softDeletes();
        $table->timestamps();
      });


      Schema::create('replies', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('post_id')->unsigned()->index();
        $table->integer('user_id')->unsigned()->index();
        $table->integer('op')->unsigned()->index();
        $table->softDeletes();
        $table->timestamps();
      });


      // Schema::create('likes', function (Blueprint $table) {
      //   $table->increments('id');
      //   $table->integer('post_id')->unsigned()->index();
      //   $table->integer('user_id')->unsigned()->index();
      //   $table->softDeletes();
      //   $table->timestamps();
      // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('events');
        Schema::dropIfExists('votes');
        Schema::dropIfExists('replies');
    }
}
