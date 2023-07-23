<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TestCompany;
use App\Models\TestProduct;


class TestCompanyController extends Controller
{
    protected $fillable = [
        'company_name', 'street_address','representative_name',
        'created_at', 'updated_at'
    ];

    // public function store(Request $request) {
    //     $data = $request->all();
    //     $image = $request->file('img_path');
    //     //アップロードされていれば保存
    //     if ($request->hasFile('img_path')) {
    //         $path = \Storage::put('/public', $image);
    //         $path = explode('/', $path);
    //     } else {
    //         $path = null;
    //     }

    //     \DB::table('test_products')->insert([
    //         'img_path' => $path,
    //     ]);
    // }
}
