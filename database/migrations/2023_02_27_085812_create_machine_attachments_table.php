<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_attachments', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid');
          $table->foreignId('machine_id')->constrained()->cascadeOnDelete();
          $table->string('label',255);
          $table->string('path',255);
          $table->text('description')->nullable();
          $table->string('original_name',255);
          $table->integer('size')->comment('size in bytes');
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
        Schema::dropIfExists('machine_attachments');
    }
}
