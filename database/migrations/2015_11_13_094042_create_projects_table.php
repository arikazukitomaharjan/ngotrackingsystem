<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('organization');
            $table->integer('sector');
            $table->integer('working_zone');
            $table->integer('line_office');
            $table->integer('area');
            $table->string('budget' , 20);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('targeted_group');
            $table->text('objectives');
            $table->text('activities');
            $table->string('remark');
            $table->string('status' , 20);
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
        Schema::drop('projects');
    }
}
