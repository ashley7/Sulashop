<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('product.products')->with(['products'=>Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add_products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','image_url'=>'required','quentity'=>'numeric|required','buying_price'=>'numeric|required','salling_price'=>'numeric|required','category_id'=>'required']);

        $save_product = new Product($request->all());
        $file_value = $request->file('image_url');
        $file_name = trim("sulashop_img_".time().".".$file_value->getClientOriginalExtension());       
        $save_product->image_url = $file_name;        
        $save_product->user_id=\Auth::user()->id;
        $save_product->time_added = time();            
        $file_value->move(public_path('images'),$file_name);
        $save_product->save();
        return redirect()->route('product.index');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $save_product = Product::find($id);
        return view('cart.add_to_cart')->with(['product'=>$save_product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $save_product = Product::find($id);
      return view('product.edit_product')->with(['product'=>$save_product]);
    }

    public function update(Request $request, $id)
    {
        $save_product = Product::find($id);
        if ($request->hasFile('image_url')) {
            try {
              unlink(public_path('images/'.$save_product->image_url));  
            } catch (\Exception $e) {}
            
            $file_value = $request->file('image_url');
            $file_name = trim("sulashop_img_".time().".".$file_value->getClientOriginalExtension());       
            $save_product->image_url = $file_name;
            $file_value->move(public_path('images'),$file_name);
        }               
        $save_product->user_id=\Auth::user()->id;
        $save_product->quentity = $request->quentity;
        $save_product->buying_price = $request->buying_price;
        $save_product->salling_price = $request->salling_price;
        $save_product->name = $request->name;
        $save_product->save();
        return redirect()->route('product.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
