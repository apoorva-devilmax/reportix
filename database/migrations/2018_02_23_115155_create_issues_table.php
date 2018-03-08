<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            /***/
            $table->string('name');
            $table->integer('report_id')->unsigned();        // reports table
            $table->integer('vulnerability_id')->unsigned();   // vulnerabilities table
            $table->integer('severity_id')->unsigned();        // severities table
            $table->text('description');
            $table->text('recommendation');
            $table->string('affected_url');
            $table->text('affected_params');
            $table->integer('user_id')->unsigned();      // users table
            $table->dateTime('rejected_at')->nullable();
            $table->integer('rejected_by_id')->unsigned()->nullable();  // users table
            /***/
            $table->timestamps(); // created_at will be reported date
            $table->softDeletes(); // deleted_at will be the rejected issues
            $table->foreign('report_id')->references('id')->on('reports');
            $table->foreign('vulnerability_id')->references('id')->on('vulnerabilities');
            $table->foreign('severity_id')->references('id')->on('severities');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rejected_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issues');
    }
}
