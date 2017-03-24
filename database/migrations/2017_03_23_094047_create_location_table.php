<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table){
            $table->increments('id');
            $table->integer('coordinate_id')->unsigned();
            $table->integer('zipcode')->unsigned();
            $table->string('city')->nullable();
            $table->string('state',2)->nullable();

        });

        Schema::table('location',function (Blueprint $table){
            $table->foreign('coordinate_id')->references('id')->on('coordinate')->onDelete('cascade');
            $table->unique('coordinate_id','unique_coordinate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('person');
        Schema::drop('location');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
