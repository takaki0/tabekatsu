<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->string('message', 256);
            $table->boolean('has_read');
            $table->boolean('has_replied');
            $table->dateTime('send_datetime');
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
        Schema::dropIfExists('messages');
    }
}
