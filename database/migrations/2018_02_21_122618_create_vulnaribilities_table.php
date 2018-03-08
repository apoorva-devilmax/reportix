<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVulnaribilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vulnerabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code', 100)->unique();
            $table->integer('severity_id')->unsigned();
            $table->text('description');
            $table->text('recommendation');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('severity_id')->references('id')->on('severities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vulnerabilities');
    }
}
