<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_assets', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('song_id');
	        $table->foreign('song_id')->references('id')->on('songs');
            $table->string('full_track')->nullable();
	        $table->string('instrumental')->nullable();
	        $table->string('clean')->nullable();
	        $table->string('steam')->nullable();
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
        Schema::dropIfExists('song_assets');
    }
}
