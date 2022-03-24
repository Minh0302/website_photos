<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\v1\ProductResources;
use App\Http\Resources\v1\ProductCollection;

class HandleProductController extends Controller
{
    public function show_deleted(){
        return new ProductCollection(Product::onlyTrashed()->get());
    }
    public function destroy($product_id){
        Product::find($product_id)->delete();
    }
    public function restore($product_id){
        Product::withTrashed()->where('product_id', $product_id)->restore();
    }
    public function product_related($product_id){
        $product = Product::where('product_id', $product_id)->first();
        return new ProductCollection(Product::with('user')->whereNotIn('product_id',[$product->product_id])->get());
    }
    public function search(Request $request){
        $search_name = $request->product_name;
        $search_desc = $request->product_desc;
        $data_search = Product::where('product_name','LIKE','%'.$search_name.'%')->orWhere('product_desc','LIKE','%'.$search_desc.'%')->get();
        return $data_search;
    }
}
