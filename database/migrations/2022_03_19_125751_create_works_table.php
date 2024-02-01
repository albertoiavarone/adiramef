<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid', 32);
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade');
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_stop');
            $table->time('total_time')->nullable();
            $table->string('program_name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('energy_consumed', 10,2)->nullable();
            $table->json('info')->nullable()->comment('specified machine info');
            $table->smallInteger('processes')->default(0);
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
        Schema::dropIfExists('works');
    }
}
