<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //areas
        $cnt = DB::table('areas')->count();
        //seedsがない場合はseeds登録。
        if ($cnt == 0){
            $this->call(AreasTableSeeder::class);
        }
        //prefectures
        $cnt = DB::table('prefectures')->count();
        //seedsがない場合はseeds登録。
        if ($cnt == 0){
            $this->call(PrefecturesTableSeeder::class);
        }

    }
}
