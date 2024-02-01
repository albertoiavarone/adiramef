<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('label',255);
            $table->boolean('is_default')->default(0);
            $table->string('name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('vat_number', 20)->nullable();
            $table->string('fiscal_code', 20);
            $table->foreignId('nation_id')->constrained()->onDelete('cascade');
            $table->foreignId('province_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('address', 255);
            $table->string('address_number', 255)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('pec', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
