<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\TestProduct;

class TestProducsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('test_products')->insert([
            [
                'company_id' => '1',
                'product_name' => 'コカコーラ',
                'price' => '150',
                'stock' => '50',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '2',
                'product_name' => 'サイダー',
                'price' => '140',
                'stock' => '45',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '3',
                'product_name' => 'お茶',
                'price' => '130',
                'stock' => '60',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '4',
                'product_name' => 'ファンタ',
                'price' => '160',
                'stock' => '30',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '5',
                'product_name' => 'CCレモン',
                'price' => '120',
                'stock' => '25',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '6',
                'product_name' => 'ペプシ',
                'price' => '130',
                'stock' => '20',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_id' => '7',
                'product_name' => 'ボス',
                'price' => '110',
                'stock' => '40',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],

        ]);
    }
}
