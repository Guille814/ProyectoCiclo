<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('spotify_url')->nullable();
            $table->string('soundcloud_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('apple_music_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('spotify_url');
            $table->dropColumn('soundcloud_url');
            $table->dropColumn('youtube_url');
            $table->dropColumn('apple_music_url');
        });
    }
};
