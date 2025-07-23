<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('buku_tamus', function (Blueprint $table) {
            $table->dropColumn('instansi');
        });
    }

    public function down()
    {
        Schema::table('buku_tamus', function (Blueprint $table) {
            $table->string('instansi', 255)->nullable();
        });
    }
};
