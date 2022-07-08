<?php

use Database\Seeders\AddressSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('state');
            $table->string('street');
            $table->integer('number');
            $table->string('complement')->nullable();
            $table->string('zip_code');
            $table->string('neighborhood');

            $table->timestamps();

        });

           //run seeder
           $seeder = new AddressSeeder();
           $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
