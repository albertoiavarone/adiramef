<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid',32);
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->string('name', 255);
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->smallInteger('priority')->nullable();
            $table->string('code',32)->nullable();
            $table->boolean('sent')->comment('set to 1 when the record is sent to the machine')->default(0);
            $table->boolean('done')->default(0);
            $table->json('info')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
