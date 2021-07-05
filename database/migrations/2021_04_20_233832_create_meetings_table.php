<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            //$table->dateTime('datetime');
            $table->integer('day'); //1
            $table->string('hour'); //15:30 17:15
            //$table->dateTime('alternative_datetime')->nullable();
            $table->string('status')->default('active'); //activo - cancelado
            $table->string('type');
            $table->string('classroom')->nullable();
            $table->string('meeting_url')->nullable();
            //$table->string('reason')->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('meetings');
    }
}
