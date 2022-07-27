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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('link')->nullable();
            $table->foreignId('user_id')
                ->constrained("users")
                ->onUpdate('cascade');
            $table->text('description');
            $table->enum("type", ['public', 'private','follower'])->default('public');
            $table->enum("status", ['approved', 'unapproved'])->default('unapproved');
            $table->boolean("pinned")->default(false);
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
        Schema::dropIfExists('videos');
    }
};
