<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineSyncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_syncs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid', 32);
            $table->string('type',20);
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('machine_syncs');
    }
}
