<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputequotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computequotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vmcount')->unsigned();
            $table->integer('corelimit')->unsigned();
            $table->integer('availabilityset')->unsigned();
            $table->integer('vmscaleset')->unsigned();
            $table->string('subscriptionid');
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
        Schema::dropIfExists('computequotas');
    }
}
