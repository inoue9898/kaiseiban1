<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TestProduct;
use App\Models\TestCompany;
use Illuminate\Support\Facades\DB;


class TestProductController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  * 
    //  * @return \Illuminate\Http\Response
    //  */

    //test_productsから受け取ったデータをviewのlistに。
    public function showList(Request $request) {

        // $products = TestProduct::Paginate(6);
        // $companies = TestCompany::Paginate(6);
        //受け取ったform内のname="keyword"とnome="search-company"を変数に詰める。
        $keyword = $request->input('keyword');
        $searchCompany = $request->input('company_name');

        //productsテーブルとcompaniesテーブルをjoin
        $query = DB::table('test_products')
                    ->join('test_companies', 'test_products.company_id', '=', 'test_companies.id')
                    ->select('test_products.*', 'test_companies.company_name');

        //キーワードでwhere。
        //$keywordの箇所はダブルクォーテーションじゃないとうまく展開できないよ！
        if($keyword) {
            $query->where('test_products.product_name', 'like', "%{$keyword}%");
        }

        //企業idでwhere
        if($searchCompany) {
            $query->where('test_products.company_id', '=', "$searchCompany");
        }

        //条件に合うデータを全件取得。$productsに詰める
        $products = $query->get();

        //selectBOX用に企業テーブル全件取得
        $companies = DB::table('test_companies')->get();
        return view('product.list_product', compact('products', 'companies'));

    }

    //新規登録ボタンを押した時の処理
    public function create() {
        $companies = TestCompany::all();
        return view('product.create_product')
        ->with('companies' ,$companies);
    }

    //登録処理
    public function store(Request $request)
    {
    $request->validate([
        'product_name' => 'required|max:20',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'comment' => 'required|max:100',
        'image' => 'required|image',
    ]);

    $data = new TestProduct;
    $data->product_name = $request->input('product_name');
    $data->company_id = $request->input('company_name');
    $data->price = $request->input('price');
    $data->stock = $request->input('stock');
    $data->comment = $request->input('comment');

    //画像アップロード
    if ($request->hasFile('image')) {
        $name = $request->file('image')->getClientOriginalName();
        $file = $request->file('image')->storeAs('public/images', $name);
        $data->img_path = 'images/'.$name;
    }

    $data->save();

    //登録ボタンを押したらlistに戻る（完成じゃないから直すように）
    return redirect()->route('list_product')->with('message','登録しました');

    }
    //詳細表示
    public function showDetail($id) {
        $product = TestProduct::find($id);
        return view('product.detail_product',['product' => $product]);

    }
    //削除ボタン押下
    public function delete($id) {

        TestProduct::destroy($id);
        //$product->delete();

         return redirect()->route('list_product')->with('message', '削除しました');

    }
    //編集ボタン押下
    //public function edit($id) {
        // $product = TestProduct::find($id);
        // $companies = TestCompany::find($id);
        // $companies = TestCompany::all();
        // return view('product.edit_product', ['product' => $product])
        // ->with('companies' ,$companies);

        public function edit(Request $request) {
        $companies = DB::table('test_companies')->get();
        $product = DB::table('test_products')
                    ->where('id', $request->id)->first();
        return view('product.edit_product', ['product' => $product])
        ->with('companies', $companies);

    }
    //検索ボタン押下
    public function search(Request $request) {

        $products = TestProduct::all();
        $companies = TestCompany::all();

        $keyword = $request->input('keyword');
        $company_id = $request->input('company_name');

        //検索欄が空ではない場合
        if(!empty($keyword)) {

            $products->where('product_name', '=', $keyword);
            $companies->where('company_id', '=', $company_id);
        }

        $products->first();
        return view('product.list_product',compact('products', 'companies', 'keyword'));

    }

    public function update(Request $request,$id) {

        //dd($request->all());
        $request->validate([
            'product_name' => 'required|max:20',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:100',
            //'company_name' => 'required|integer',
            'image' => 'required|image',
        ]);

        //--------------Eloquentでの更新コードです---------------------------------

        $product = TestProduct::find($id);

        // dd($product);

        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $file = $request->file('image')->storeAs('public/images', $name);
            $product->img_path = 'images/'.$name;
        }

        $product->save();

        return redirect()->route('list_product')->with('message', '更新しました');

        //-----------------クエリビルダでの更新コードですーーーーーーーーーーーーーー

        // DB::table('test_products')
        //     ->where('id', $id)
        //     ->update([
        //         'product_name' => $request->input('product_name'),
        //         'company_name' => $request->input('company_name'),
        //         'price' => $request->input('price'),
        //         'stock' => $request->input('stock'),
        //         'comment' => $request->input('comment'),
    
        //     ]);

        //return redirect()->route('list_product')->with('message', '更新しました');



    // -----------------------------------------------------------------------------------------------

            // $product = [
            //     'product_name' => $request->product_name,
            //     'company_name' => $request->company_name,
            //     'price' => $request->price,
            //     'stock' => $request->stock,
            //     'comment' => $request->comment,
            //'image' => $request->img_path,
            
        // ];


    //     $productData = [
    //         'product_name' => $request->product_name,
    //         'company_name' => $request->company_name,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'comment' => $request->comment,
    //         'image' => $request->img_path,
    //     ];

    //     if ($request->hasFile('image')) {
    //         $name = $request->file('image')->getClientOriginalName();
    //         $file = $request->file('image')->storeAs('public/images', $name);
    //         $productData['img_path'] = 'images/' . $name;
    //     }
    
    //     // クエリビルダを使用してデータを更新
    //     DB::table('test_products')
    //         ->where('id', $id)
    //         ->update($productData);
    
    //     return redirect()->route('list_product')->with('message', '更新しました');
    // }
        // $data = DB::table('test_products')
        //         ->where('id',$request->id)
        //         ->update($product);

    // return redirect()->route('list_product')->with('message', '更新しました');

        // $data = TestProduct::find($id);
    
        // //$data = new TestProduct;
        // $data->product_name = $request->input('product_name');
        // $data->company_id = $request->input('company_name');
        // $data->price = $request->input('price');
        // $data->stock = $request->input('stock');
        // $data->comment = $request->input('comment');

    
        //画像アップロード
    //     if ($request->hasFile('image')) {
    //         $name = $request->file('image')->getClientOriginalName();
    //         $file = $request->file('image')->storeAs('public/images', $name);
    //         $data->img_path = 'images/'.$name;
    //     }
    
    //     $data->save();
    
    //     return redirect()->route('list_product')->with('message', '更新しました');
    // $request->validate([
    //     'product_name' => 'required|max:20',
    //     'price' => 'required|integer',
    //     'stock' => 'required|integer',
    //     'comment' => 'required|max:100',
    //     'company_name' => 'required|integer',
    //     'image' => 'required|image',
    // ]);

    // $data = TestProduct::find($id);

    // $data->product_name = $request->product_name;
    // $data->company_id = $request->company_name;
    // $data->price = $request->price;
    // $data->stock = $request->stock;
    // $data->comment = $request->comment;

    // //画像アップロード
    // if ($request->hasFile('image')) {
    //     $name = $request->file('image')->getClientOriginalName();
    //     $file = $request->file('image')->storeAs('public/images', $name);
    //     $data->img_path = 'images/'.$name;
    // }

    // $data->save();

    // return redirect()->route('list_product')->with('message', '更新しました');

     
}

}