<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\TestCompany;

class TestCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('test_companies')->insert([
            [
                'company_name' => '株式会社コカコーラ',
                'street_address' => '1',
                'representative_name' => '山田',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社三矢',
                'street_address' => '2',
                'representative_name' => '四谷',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社伊藤園',
                'street_address' => '3',
                'representative_name' => '伊藤',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社ファンタ',
                'street_address' => '4',
                'representative_name' => '田中',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社橋本',
                'street_address' => '5',
                'representative_name' => '橋本',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社ペプシ',
                'street_address' => '6',
                'representative_name' => '佐藤',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'company_name' => '株式会社サントリー',
                'street_address' => '7',
                'representative_name' => '鳥居',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],

        ]);
        
    }
}
