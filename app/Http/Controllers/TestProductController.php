<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TestProduct;
use App\Models\TestCompany;
use App\Http\Requests\TestProductRequest;
use Illuminate\Support\Facades\DB;


class TestProductController extends Controller
{
    //test_productsから受け取ったデータをviewのlistに。
    public function showList(Request $request) {

        $productModel = new TestProduct();
        $companyModel = new TestCompany();
        $products = $productModel->showList()->get();
        $companies = $companyModel->showList();

        return view('product.list_product', ['products' => $products, 'companies' => $companies]);

    }
    //検索
    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $searchCompany = $request->input('company_name');

            $productModel = new TestProduct();
            $companyModel = new TestCompany();
            $products = $productModel->getSearch($keyword,$searchCompany);
            $companies = $companyModel->showList();

        return view('product.list_product', ['products' => $products, 'companies' => $companies]);

    }

    //新規登録ボタンを押した時の処理
    public function create() {

        $model = new TestProduct();
        $companies = $model->getCreate();

        return view('product.create_product', ['companies' => $companies]);

    }
    //登録処理

    public function store(TestProductRequest $request) {
        DB::beginTransaction();
    
        try {
            $data = [
                'product_name' => $request->input('product_name'),
                'company_name' => $request->input('company_name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'comment' => $request->input('comment'),
            ];
    
            $product_model = new TestProduct();
            $product_model->getStore($data, $request->file('image'));
            
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => '登録処理が失敗しました。']);
        }
    
        return redirect()->route('list_product')->with('message',config('const.create'));
    }
    

    //詳細表示
    public function showDetail($id) {
        $product_model = new TestProduct();
        $product = $product_model->detail($id);
        return view('product.detail_product',['product' => $product]);
    }
    //削除ボタン押下
    public function delete($id) {

        TestProduct::destroy($id);

         return redirect()->route('list_product')->with('message', config('const.delete'));

    }
    //編集ボタン押下
    public function edit($id) {
        $product_model = new TestProduct();
        $company_model = new TestCompany();
        $product = $product_model->getEdit($id);
        $companies = $company_model->showList();


        return view('product.edit_product',['product' => $product, 'companies' => $companies]);
    }

    //更新処理
    public function update(TestProductRequest $request,$id) {
        DB::beginTransaction();

        try {
        $product_model = new TestProduct();
        $product = $request->all();

        if ($product_model->getUpdate($id, $request)) {
        }

        DB::commit();
    } catch (\Exception $e){
        DB::rollback();
        return back();
    }
        return redirect()->route('list_product')->with('message', config('const.update'));
    }

}