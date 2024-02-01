<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMachineDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_data', function (Blueprint $table) {
            $table->decimal('odometer',10,2)->after('direction')->nullable();
            $table->smallInteger('distance')->after('odometer')->nullable();
            $table->time('time')->after('distance')->nullable();
            $table->dropColumn('km');
            $table->dropColumn('hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_data', function (Blueprint $table) {
            $table->dropColumn('odometer');
            $table->dropColumn('distance');
            $table->dropColumn('time');
            $table->smallInteger('km')->after('direction')->nullable()->comment('');
            $table->smallInteger('hours')->after('km')->nullable()->comment('Cumulative Operating Hours');
        });
    }
}
