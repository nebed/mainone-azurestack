<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkquotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networkquotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('publicip')->unsigned();
            $table->integer('vnets')->unsigned();
            $table->integer('virtual_gateway')->unsigned();
            $table->integer('tunnels')->unsigned();
            $table->integer('loadbalancers')->unsigned();
            $table->integer('nics')->unsigned();
            $table->integer('nsgs')->unsigned();
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
        Schema::dropIfExists('networkquotas');
    }
}
