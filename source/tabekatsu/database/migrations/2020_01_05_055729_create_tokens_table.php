<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('login_id', 32)->unique();
            $table->string('token', 256);
            $table->string('refresh_token', 256);
            $table->dateTime('start_datetime');
            $table->integer('expires');
            $table->timestamps();
            //foreign key
            $table->foreign('login_id')->references('login_id')
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
        Schema::dropIfExists('tokens');
    }
}
