<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineManteinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_manteinances', function (Blueprint $table) {
          $table->id();
          $table->uuid('uuid',32);
          $table->foreignId('machine_id')->constrained()->onDelete('cascade');
          $table->foreignId('machine_manteinance_type_id')->constrained()->onDelete('cascade');
          $table->foreignId('machine_manteinance_status_id')->constrained()->onDelete('cascade');
          $table->string('title')->nullable();
          $table->text('notes')->nullable();
          $table->date('expire_date');
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
        Schema::dropIfExists('machine_manteinances');
    }
}
