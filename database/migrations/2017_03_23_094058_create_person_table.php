<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('person', function (Blueprint $table){
            $table->increments('id');
            $table->integer('agent_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->integer('personable_id')->unsigned()->nullable();
            $table->string('personable_type')->nullable();
        });

        Schema::table('person',function (Blueprint $table){
            $table->foreign('agent_id')->references('id')->on('agent')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade');
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
        Schema::drop('person');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
