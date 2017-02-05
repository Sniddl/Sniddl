<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('display_name');
            $table->ipAddress('ip_created');
            $table->ipAddress('ip_latest');
            $table->timestamp('ip_updated_at');
            $table->boolean('is_dark')->default(0);
            $table->string('avatar_url');
            $table->string('avatar_bg_color');
            $table->string('banner_url');
            $table->string('banner_bg_color');
            $table->string('phone');
            $table->string('confirmation_code')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
