<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestCompany extends Model
{
    //companiesテーブルからデータを取得
    protected $table = 'test_companies';
    // public function getList() {
    //     $companies = DB::table('test_companies')->get();

    //     return $companies;
    // }
    use HasFactory;
    public function products() {
        return $this->hasMany(TestProduct::class);
    }

    // public function companies() {
    //     return $this->hasOne('App\Products');
    // }
}
