<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStackalertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stackalerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alertid');
            $table->string('title');
            $table->text('description');
            $table->string('faulttype');
            $table->string('impactedresource');
            $table->string('severity');
            $table->string('state');
            $table->string('remediation');
            $table->string('createdtimestamp');
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
        Schema::dropIfExists('stackalerts');
    }
}
