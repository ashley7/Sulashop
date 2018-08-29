<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $save_cart = new Cart();
        $save_cart->user_id = \Auth::user()->id;
        $save_cart->product_id = $request->product_id;
        $save_cart->quantity = $request->quantity;

        $cart_item_count = Cart::all()->where('product_id',$request->product_id)->where('status',1)->count();
        $product = Product::find($request->product_id);
        if (($product->quentity - $cart_item_count)>=$save_cart->quantity) {
             $save_cart->save();
             return redirect()->route('product.index'); 
        }
        else{
            return redirect()->route('product.index')->with(['status'=>'Only '.$product->quentity - $cart_item_count.' is in stock, operation failed']); 
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user_cart = Cart::all()->where('user_id',$id);
       return view('cart.user_cart')->with(['user_cart'=>$user_cart]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);
        return back();
    }
}
