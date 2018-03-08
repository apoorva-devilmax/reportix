<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            /***/
            $table->string('document_title');
            $table->integer('project_id')->unsigned();   // projects table
            $table->string('tested_domain');
            $table->date('submission_date');
            $table->string('version');
            $table->text('description');
            $table->integer('created_by_id')->unsigned();      // users table
            $table->dateTime('approved_at')->nullable();
            $table->integer('approved_by_id')->unsigned()->nullable();  // users table
            /***/
            $table->timestamps(); // created_at will be start date
            $table->softDeletes();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('approved_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reports');
    }
}
