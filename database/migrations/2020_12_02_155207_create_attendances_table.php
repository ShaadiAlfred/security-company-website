<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->boolean('is_present');
            $table->string('note', 128)->nullable();
            $table->foreignId('submitted_by')->references('id')->on('users');
            $table->string('submitted_from', 256);
            $table->double('latitude', 16, 12);
            $table->double('longitude', 16, 12);
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
        Schema::dropIfExists('attendances');
    }
}
