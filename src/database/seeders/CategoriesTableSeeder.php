<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //お問い合わせの種類5件登録
        $params = [
            [
                'content' => '商品のお届けについて',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'content' => '返品・交換について',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'content' => '支払いについて',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'content' => '配送について',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'content' => 'その他',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('categories')->insert($params);

    }
}
