<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\TestProduct;
use App\Models\TestCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function purchase($id)
        {
            
            return DB::transaction(function () use ($id) {
                // 指定したIDの商品を取得
                $product = TestProduct::find($id);
                
    
                if (!$product) {
                    return response()->json(['message' => '商品が見つかりません'], 404);
                }
    
                // 商品の在庫を減らす
                if ($product->stock > 0) {
                    $product->stock -= 1;
                    $product->save();
    
                    // 購入履歴をsalesテーブルに挿入
                    $sale = new Sale();
                    $sale->product_id = $id;
                    $sale->save();
    
                    return response()->json(['message' => '商品を購入しました'], 200);
                } else {
                    return response()->json(['message' => '在庫切れです'], 400);
                }
            });
        }

    // public function purchase(Request $request) 
    // {
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('quantity', 1);

    //     $product = TestProduct::find($productId);
    //     if (!$product) {
    //         return response()->json(['message' => '商品が存在しません。'], 404);
    //     }
    //     if ($product->stock < $quantity) {
    //         return response()->json(['message' => '商品が不足しています。'], 400);
    //     }

    //     $product->stock -= $quantity;
    //     $product->save();

    //     $sale = new Sale([
    //         'product_id' => $productId,
    //     ]);
    //     $sale->save();
        
    //     return response()->json(['message' => '購入成功！']);
    // }

}
