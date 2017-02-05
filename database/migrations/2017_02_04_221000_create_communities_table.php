<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::enableForeignKeyConstraints();

      Schema::create('communities', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('description')->nullable();
        $table->integer('owner')->unsigned();
        $table->string('page_url')->unique();
        $table->string('avatar_url');
        $table->string('banner_url');
        $table->string('theme_color');
        $table->softDeletes();
        $table->timestamps();
      });

      Schema::create('community_members', function (Blueprint $table) {
        $table->integer('user_id')->unsigned();
        $table->integer('community_id')->unsigned();
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
      Schema::dropIfExists('communities');
      Schema::dropIfExists('community_members');
    }
}
