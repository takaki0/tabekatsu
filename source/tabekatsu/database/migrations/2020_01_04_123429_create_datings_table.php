<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->dateTime('dating_datetime');
            $table->date('dating_date');
            $table->time('dating_time');
            $table->unsignedTinyInteger('meal_class');
            $table->boolean('has_fixed');
            $table->boolean('has_cancelled');
            $table->boolean('has_done');
            $table->unsignedTinyInteger('sender_evaluation');
            $table->unsignedTinyInteger('recipient_evaluation');
            $table->string('sender_comment', 256);
            $table->string('recipient_comment', 256);
            $table->timestamps();

            //foreign key
            $table->foreign('sender_id')->references('id')
                ->on('members');
            $table->foreign('recipient_id')->references('id')
                ->on('members');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datings');
    }
}
