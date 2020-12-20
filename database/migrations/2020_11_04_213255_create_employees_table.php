<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('number')->unique();
            $table->string('name', 64)->nullable();
            $table->char('national_id', 64)->nullable()->unique();
            $table->string('address', 128)->nullable();
            $table->string('phone', 64)->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('notes', 64)->nullable();
            $table->foreignId('job_location_id')->nullable()->references('id')->on('job_locations'); // الموقع
            $table->foreignId('job_shift_id')->nullable()->references('id')->on('job_shifts');
            $table->string('section', 32)->nullable();
            $table->string('3ohda', 16)->nullable();
            $table->date('hired_on')->nullable();
            $table->char('status', 1)->nullable();
            $table->string('kashf_amny', 16)->nullable();
            $table->string('no3_el_mo5alfa', 64)->nullable();
            $table->string('pants', 32)->nullable();
            $table->string('summer_t_shirt', 32)->nullable();
            $table->string('winter_t_shirt', 32)->nullable();
            $table->string('eish', 32)->nullable();
            $table->string('jacket', 32)->nullable();
            $table->string('shoes', 32)->nullable();
            $table->string('vest', 32)->nullable();
            $table->string('donk', 32)->nullable();
            $table->string('notes_2', 32)->nullable();
            $table->string('picture', 64)->default('default.png');
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
        Schema::dropIfExists('employees');
    }
}
