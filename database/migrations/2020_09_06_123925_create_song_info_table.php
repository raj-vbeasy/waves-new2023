<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_info', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('song_id');
	        $table->foreign('song_id')->references('id')->on('songs');
	        $table->json('publishing_splits');
	        $table->json('master_splits');
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
        Schema::dropIfExists('song_metadatas');
    }
}
