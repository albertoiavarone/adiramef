<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_data', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid',32);
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->decimal('latitude',16,14)->nullable();
            $table->decimal('longitude',16,14)->nullable();
            $table->smallInteger('altitude')->nullable();
            $table->smallInteger('speed')->nullable();
            $table->smallInteger('direction')->nullable();
            $table->smallInteger('km')->nullable()->comment('odometer');
            $table->smallInteger('hours')->nullable()->comment('Cumulative Operating Hours');
            $table->smallInteger('status')->default(0)->comment('0: fermo-quadro spento 1; in movimento 2: fermo-quadro acceso');
            $table->string('address')->nullable();
            $table->json('parameters')->nullable();
            $table->dateTime('timestamp')->nullable();
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
        Schema::dropIfExists('machine_data');
    }
}
