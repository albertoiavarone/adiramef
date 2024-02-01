<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->comment('docmagt_cod');
            $table->string('number',6)->comment('docmagt_num');
            $table->date('date')->comment('docmagt_dtuk');
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
        Schema::dropIfExists('work_documents');
    }
}
