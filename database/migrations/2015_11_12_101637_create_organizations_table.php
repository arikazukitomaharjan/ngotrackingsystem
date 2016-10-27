<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $this->text('introduction');
            $table->string('address');
            $table->string('contact_person');
            $table->text('objectives');
            $table->string('reg_district');
            $table->string('reg_no');
            $table->date('reg_date');
            $table->string('pan_no');
            $table->date('pan_reg_date');
            $table->string('affiliation_no');
            $table->date('last_renewal');
            $table->string('last_audit');
            $table->text('assets');
            $table->string('status');
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
           Schema::drop('organizations');
        }
}
