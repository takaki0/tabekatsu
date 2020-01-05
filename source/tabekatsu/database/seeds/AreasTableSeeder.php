<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            //read seed file.
            $file = 'app/areas_seeds.csv';
            $seeds_file = new \SplFileObject(storage_path($file));
            $seeds_file->setFlags(
                \SplFileObject::READ_CSV |           // CSV 列として行を読み込む
                \SplFileObject::READ_AHEAD |       // 先読み/巻き戻しで読み出す。
                \SplFileObject::SKIP_EMPTY |         // 空行は読み飛ばす
                \SplFileObject::DROP_NEW_LINE    // 行末の改行を読み飛ばす
            );

            //register seeds to areas table.
            $i = 0;
            $header = [];
            foreach ($seeds_file as $line){
                if($i==0){
                   $header = $line;
                   $i++;
                   continue;
                }
                DB::table('areas')
                    ->insert(array_combine($header, $line));
            }
        } catch (\Illuminate\Filesystem\FileNotFoundException $exception) {
            die("ファイルがありません");
        }
    }
}
