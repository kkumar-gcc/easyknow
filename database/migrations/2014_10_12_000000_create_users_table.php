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
        Schema::create('users', function (Blueprint $table) {
            $table->id();  
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('about_me')->nullable();
            $table->text('short_bio')->nullable(); 
            $table->string('profile_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string("website_url")->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
};
