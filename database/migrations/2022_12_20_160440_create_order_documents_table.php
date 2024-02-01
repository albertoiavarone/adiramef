<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_documents', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid');
          $table->foreignId('order_id')->constrained()->cascadeOnDelete();
          $table->string('label',255);
          $table->string('path',255);
          $table->string('original_name',255);
          $table->integer('size')->comment('size in bytes');
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_documents');
    }
}
