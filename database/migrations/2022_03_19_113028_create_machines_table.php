<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid', 32);
            $table->foreignId('builder_id')->constrained()->onDelete('cascade');
            $table->foreignId('machine_type_id')->constrained()->onDelete('cascade');
            $table->string('name',255);
            $table->string('serial_number',255);
            $table->date('purchase_date')->nullable();
            $table->boolean('sync_production')->default(1);
            $table->boolean('sync_diagnostics')->default(0);
            $table->json('options')->nullable();
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
        Schema::dropIfExists('machines');
    }
}
