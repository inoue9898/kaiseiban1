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

        //dd($sort);
        $productModel = new TestProduct();
        $companyModel = new TestCompany();
        $products = $productModel->showList();
        $companies = $companyModel->showList();
        
        return view('product.list_product', ['products' => $products, 'companies' => $companies]);

    }
    //検索
    public function search(Request $request) {

        $productModel = new TestProduct();
        $companyModel = new TestCompany();

        
        $keyword = $request->input('keyword');
        $searchCompany = $request->input('company_name');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_stock = $request->input('min_stock');
        $max_stock = $request->input('max_stock');



        $products = $productModel->getSearch($keyword, $searchCompany, $min_price, $max_price, $min_stock, $max_stock);
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

   // ソート成功コントローラ
    // public function sort(Request $request)
    // {
    //     $sortableColumns = ['id', 'price', 'stock']; // ソート可能なカラムのリスト
        
    //     // リクエストからソートカラムとソート順を取得（デフォルトは'id'と'asc'）
    //     $sortColumn = $request->input('sort', 'id');
    //     $sortDirection = $request->input('direction', 'asc');

    //     // ソートカラムが有効なものか確認
    //     if (!in_array($sortColumn, $sortableColumns)) {
    //         $sortColumn = 'id'; // デフォルトのソートカラム
    //     }

    //     // ソート順が正しい値であるか確認し、デフォルトは'asc'とする
    //     if ($sortDirection !== 'asc' && $sortDirection !== 'desc') {
    //         $sortDirection = 'asc';
    //     }

    //     // 商品データの取得とソート
    //     //$products = TestProduct::orderBy($sortColumn, $sortDirection)->get();


    //     $model = new TestProduct();
    //     $products = $model->sortList($sortColumn, $sortDirection);
    //     $companyModel = new TestCompany();
    //     $companies = $companyModel->showList();

    //     // ビューにデータを渡して表示
    //     return view('product.list_product', [
    //         'companies' => $companies,
    //         'products' => $products,
    //         'sortableColumns' => $sortableColumns,
    //         'sortColumn' => $sortColumn,
    //         'sortDirection' => $sortDirection,
    //     ]);
    // }

    //試しソートコントローラ　1ダメ

    // public function sort(Request $request)
    // {

    //     $keyword = $request->input('keyword');
    //     $searchCompany = $request->input('company_name');
    //     $min_price = $request->input('min_price');
    //     $max_price = $request->input('max_price');
    //     $min_stock = $request->input('min_stock');
    //     $max_stock = $request->input('max_stock');

    //     $sortableColumns = ['id', 'price', 'stock']; // ソート可能なカラムのリスト
        
    //     // リクエストからソートカラムとソート順を取得（デフォルトは'id'と'asc'）
    //     $sortColumn = $request->input('sort', 'id');
    //     $sortDirection = $request->input('direction', 'asc');

    //     // ソートカラムが有効なものか確認
    //     if (!in_array($sortColumn, $sortableColumns)) {
    //         $sortColumn = 'id'; // デフォルトのソートカラム
    //     }

    //     // ソート順が正しい値であるか確認し、デフォルトは'asc'とする
    //     if ($sortDirection !== 'asc' && $sortDirection !== 'desc') {
    //         $sortDirection = 'asc';
    //     }

    //     // 商品データの取得とソート
    //     //$products = TestProduct::orderBy($sortColumn, $sortDirection)->get();


    //     $model = new TestProduct();
    //     $products = $model->sortList($sortColumn, $sortDirection,$keyword, $searchCompany, $min_price, $max_price, $min_stock, $max_stock);
    //     $companyModel = new TestCompany();
    //     $companies = $companyModel->showList();

    //     // ビューにデータを渡して表示
    //     return view('product.list_product', [
    //         'companies' => $companies,
    //         'products' => $products,
    //         'sortableColumns' => $sortableColumns,
    //         'sortColumn' => $sortColumn,
    //         'sortDirection' => $sortDirection,
    //     ]); 
    // }

//     public function sort(Request $request)
// {
//     // ユーザーの検索条件を取得
//     $keyword = $request->input('keyword');
//     $searchCompany = $request->input('company_name');
//     $min_price = $request->input('min_price');
//     $max_price = $request->input('max_price');
//     $min_stock = $request->input('min_stock');
//     $max_stock = $request->input('max_stock');
//     $orderBy = $request->input('orderBy', 'created_at'); // デフォルトは作成日時でソート

//     // 検索クエリを作成
//     $query = TestProduct::query();

//     if ($keyword) {
//         $query->where('column_name', 'like', '%' . $keyword . '%');
//     }

//     // ソートを適用
//     $query->orderBy($orderBy, 'asc'); // あるいは 'desc' に変更可能

//     $results = $query->paginate(10); // ページネーションを適用

//     return view('search_results', ['results' => $results]);
// }




}