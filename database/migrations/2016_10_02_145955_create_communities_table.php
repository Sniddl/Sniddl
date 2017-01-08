<?php

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
      Schema::create('communities', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('desc')->nullable();
        $table->integer('owner_id')->unsigned()->index();
        $table->string('url')->unique();
        $table->string('avatar')->nullable();
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
        Schema::drop('communities');
    }
}
