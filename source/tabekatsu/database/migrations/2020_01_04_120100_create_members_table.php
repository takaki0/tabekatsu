<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('login_id', 32)->unique();
            $table->string('hashed_password', 255);
            $table->string('nickname', 32);
            $table->string('mail_address', 32)->unique();
            $table->unsignedInteger('age');
            $table->unsignedTinyInteger('sex');
            $table->unsignedInteger('area');
            $table->unsignedInteger('prefecture');
            $table->string('photo_info', 256);
            $table->text('introduction');
            $table->text('like_food');
            $table->text('dislike_food');
            $table->date('join_date');
            $table->timestamps();

            //foreign key
            $table->foreign('area')->references('id')
                ->on('areas');
            $table->foreign('prefecture')->references('id')
                ->on('prefectures');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
