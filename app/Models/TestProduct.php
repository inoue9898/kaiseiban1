<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TestProduct extends Model
{
    use HasFactory;
    protected $table = 'test_products';
    protected $fillable =[
        'id','company_id',
        'product_name', 'price',
        'stock', 'comment', 'img_path',
        'created_at', 'updated_at'
    ];

    //test_productsからcompany()で、データを取得
    public function company() {
        // $products = DB::table('test_products')->get();

        // return $products;
        return $this->belongsTo(TestCompany::class);
    }

    public function forceDelete() {
        return $this->delete();
    }

    // public function update($request, $product)
    // {
    //     $result = $product->fill([
    //         'book_name' => $request->book_name
    //     ])->save();

    //     return $result;
    // }
}
