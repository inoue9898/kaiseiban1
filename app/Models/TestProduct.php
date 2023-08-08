<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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
        return $this->belongsTo(TestCompany::class);
    }

    //一覧表示
    public function showList() {
        $query = DB::table('test_products')
            ->join('test_companies', 'test_products.company_id', '=', 'test_companies.id')
            ->select('test_products.*', 'test_companies.company_name');
        return $query;

    }
    //検索処理
    public function getSearch($keyword,$searchCompany) {

        $query = DB::table('test_products')
        ->join('test_companies', 'test_products.company_id', '=', 'test_companies.id')
        ->select('test_products.*', 'test_companies.company_name');

        if($keyword) {
            $query->where('test_products.product_name', 'like', "%{$keyword}%");
        }

        if($searchCompany) {
            $query->where('test_products.company_id', '=', "$searchCompany");
        }

        $products = $query->get();

        //$companies = DB::table('test_companies')->get();
        return $products;

    }

    //新規登録ボタン押下
    public function getCreate() {
        $companies = DB::table('test_companies')->get();

        return $companies;
    }

    // 登録処理
    public function getStore($data, $image)
    {
        $this->product_name = $data['product_name'];
        $this->company_id = $data['company_name'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];
        $this->comment = $data['comment'];

        if ($image) {
            $name = $image->getClientOriginalName();
            $file = $image->storeAs('public/images', $name);
            $this->img_path = 'images/'.$name;
        }

        $this->save();
    }

    //詳細ボタン
    public function detail($id) {
        $product = DB::table('test_products')
            ->join('test_companies', 'test_products.company_id', '=', 'test_companies.id')
            ->select('test_products.*', 'test_companies.company_name')
            ->where('test_products.id', $id)
            ->first();
        
            return $product;
        
    }

    //編集ボタン
    public function getEdit($id) {
        $product = DB::table('test_products')
        ->join('test_companies', 'test_products.company_id', '=', 'test_companies.id')
        ->select('test_products.*', 'test_companies.company_name')
        ->where('test_products.id', $id)
        ->first();
    
        return $product;

    }

    //更新処理
    public function getUpdate($id,$request) {
        $product = TestProduct::find($id);

        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $file = $request->file('image')->storeAs('public/images', $name);
            $product->img_path = 'images/'.$name;
        }

        return $product->save();
    }

}
