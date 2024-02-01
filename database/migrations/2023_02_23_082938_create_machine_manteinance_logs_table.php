<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineManteinanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_manteinance_logs', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid',32);
          $table->foreignId('machine_manteinance_id')->constrained()->onDelete('cascade');
          $table->foreignId('machine_manteinance_status_id')->constrained()->onDelete('cascade');
          $table->foreignId('user_id')->constrained()->onDelete('cascade');
          $table->text('notes')->nullable();
          $table->string('path_doc')->nullable();
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
        Schema::dropIfExists('machine_manteinance_logs');
    }
}
