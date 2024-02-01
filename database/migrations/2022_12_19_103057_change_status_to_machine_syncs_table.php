<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusToMachineSyncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_syncs', function (Blueprint $table) {
            $table->smallInteger('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_syncs', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->boolean('status')->after('ref_date')->default(1)->change();
        });
    }
}
