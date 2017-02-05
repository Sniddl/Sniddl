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
          $table->integer('user_id')->unsigned();
          $table->integer('community_id')->unsigned();
          $table->longText('text');
          $table->softDeletes();
          $table->timestamps();
          $cs->collation = 'utf8_bin';
      });

      Schema::create('events', function (Blueprint $table) {
        $table->integer('post_id')->unsigned();
        $table->integer('added_by')->unsigned();
        $table->boolean('is_repost')->default(FALSE);
        $table->boolean('is_reply')->default(FALSE);
        $table->softDeletes();
      });


      Schema::create('reposts', function (Blueprint $table) {
        $table->integer('post_id')->unsigned();
        $table->integer('reposter')->unsigned();
        $table->integer('op')->unsigned();
        $table->softDeletes();
      });


      Schema::create('replies', function (Blueprint $table) {
        $table->integer('post_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->integer('op')->unsigned();
        $table->softDeletes();
      });


      Schema::create('likes', function (Blueprint $table) {
        $table->integer('post_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->integer('parent_id')->unsigned();
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('events');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('reposts');
        Schema::dropIfExists('replies');
    }
}
