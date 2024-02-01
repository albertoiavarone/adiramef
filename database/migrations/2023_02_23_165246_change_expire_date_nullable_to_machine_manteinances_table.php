<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExpireDateNullableToMachineManteinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_manteinances', function (Blueprint $table) {
            $table->date('expire_date')->nullable()->change();
            $table->string('title')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_manteinances', function (Blueprint $table) {
            $table->date('expire_date')->nullable(false)->change();
            $table->string('title')->nullable()->change();
        });
    }
}
