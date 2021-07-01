<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->tinyInteger('rating');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
