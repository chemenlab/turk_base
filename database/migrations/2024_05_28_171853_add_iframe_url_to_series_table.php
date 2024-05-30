<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIframeUrlToSeriesTable extends Migration
{
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->string('iframe_url')->nullable()->after('kinopoisk_id');
        });
    }

    public function down()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('iframe_url');
        });
    }
}
