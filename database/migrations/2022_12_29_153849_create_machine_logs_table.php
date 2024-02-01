<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_logs', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid', 32);
          $table->foreignId('machine_id')->constrained()->onDelete('cascade');
          $table->dateTime('date')->nullable();
          $table->string('type',20);
          $table->string('action',20);
          $table->json('message')->nullable();
          $table->boolean('alarm')->default(0);
          $table->integer('duration')->nullable();
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
        Schema::dropIfExists('machine_logs');
    }
}
