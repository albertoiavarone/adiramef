<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nations', function (Blueprint $table) {
            $table->id();
            $table->string('countryCode',2);
            $table->string('viesCode',2)->nullable();
            $table->string('countryName',255);
            $table->string('currencyCode',3);
            $table->string('fipsCode',2)->nullable();
            $table->string('isoNumeric',4);
            $table->string('continentName',100);
            $table->string('continent',2);
            $table->string('isoAlpha3',3);
            $table->boolean('extraue')->default(0);
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
        Schema::dropIfExists('nations');
    }
}
