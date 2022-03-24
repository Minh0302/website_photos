<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\v1\ProductResources;
use App\Http\Resources\v1\ProductCollection;
use File;
use Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        $user = User::where('id',$user_id)->first();
        // return new ProductCollection(Product::whereUserId($request->user()->id)->get());
        return new ProductCollection(Product::with('user')->where('user_id',$user->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // $request->validate([
        //     'product_name' => 'required',
        //     'product_desc' => 'required',
        //     'product_image' => 'required',
        // ]);
        // $product = Product::create($request->all());
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->user_id = $request->user()->id;
        $product->product_desc = $request->product_desc;
        $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->product_image){
            $image = $request->product_image;
            $extensions = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $product->product_image = $name;
        }
        $product->save();
        return new ProductResources($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResources($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return new ProductResources($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        Product::find($product_id)->delete();
    }
}
