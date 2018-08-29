<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Transaction;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_expenses = $payments = $revenue = $pending_payments = 0;
        $un_paid_items = Cart::all()->where('status',0);
        $paid_items = Cart::all();
        $products = Product::all();
        $transaction_sum = Transaction::all()->sum('amount');
        $transaction = Transaction::all();

        foreach ($products as $product_value) {
           $product_expenses = $product_expenses + ($product_value->quentity * $product_value->buying_price);  
        }

        foreach ($paid_items as $value_paid) {
            $payments = $payments + ($value_paid->quantity * $value_paid->product->salling_price);
        }

        $revenue = $payments - $product_expenses;

        foreach ($un_paid_items as $value_un_paid) {
            $pending_payments = $pending_payments + ($value_un_paid->quantity * $value_un_paid->product->salling_price);
        }

        $data = ["product_expenses"=>$product_expenses,"payments"=>$payments,"revenue"=>$revenue,"pending_payments"=>$pending_payments,"paid_items"=>$paid_items,"un_paid_items"=>$un_paid_items,"products"=>$products,"transaction_sum"=>$transaction_sum];

        return view('home')->with($data);
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


    public function visaTransactions($amount)
    {
        if (!function_exists('curl_init')){
            echo 'Sorry cURL is not installed!';
        }
         
        $loginresults=$this->login_results();
        $url="https://app.ugmart.ug/api/request-payment";
        $vendor_id=time(); 
        $post_data=array(           
            'TransactionReference'=>'a6006ad3dba'.$vendor_id,
            'account_code'=>'UGM1535575513',
            'transaction_id'=>'auto',
            'provider_id'=>'visa_mastercard',
            'msisdn'=>\Auth::user()->phone_number,            
            'currency'=> 'UGX',
            'amount'=>(int)$amount,
            'application'=> 'SulaShop',
            'description'=> 'Payment Request for my Cart.',
            'callback_url'=>'http://127.0.0.1:8000/savetransactions',
        );
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 ;Windows NT 6.1; WOW64; AppleWebKit/537.36 ;KHTML, like Gecko; Chrome/39.0.2171.95 Safari/537.36");
        try {
             curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$loginresults['token']));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }     

        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
      
    }

      public function login_results(){    
           $loginpost_data=array(          
            "password"=>"inovation#",
            "email"=>"thembocharles123@gmail.com",            
        );
 
        // Login
        $login=curl_init();
        curl_setopt($login, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($login, CURLOPT_URL, "https://app.ugmart.ug/api/login");
        curl_setopt($login, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($login, CURLOPT_POST, TRUE);
        curl_setopt($login, CURLOPT_POSTFIELDS, json_encode($loginpost_data));
        curl_setopt($login, CURLOPT_HEADER, 0);
        curl_setopt($login, CURLOPT_USERAGENT, "Mozilla/5.0 ;Windows NT 6.1; WOW64; AppleWebKit/537.36 ;KHTML, like Gecko; Chrome/39.0.2171.95 Safari/537.36");
        curl_setopt($login, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $loginoutput=curl_exec($login);
        curl_close($login);
        $loginresults=json_decode($loginoutput,TRUE);

        return $loginresults;
    }


    public function pay_cart()
    {
        $user_cart = Cart::all()->where('user_id',\Auth::user()->id)->where('status',0);
        $amount = 0;
        foreach ($user_cart as $carts) {
            $amount =  $amount + ($carts->quantity * $carts->product->salling_price);
        }
        $results = json_decode($this->visaTransactions($amount),TRUE);
        if ($results["status"] == "PENDING") {
            $save_transaction_copy = new Transaction();
            $save_transaction_copy->transaction_id = $results['data']['transaction_id'];
            $save_transaction_copy->status = $results["status"];
            $save_transaction_copy->message = $results["message"];
            $save_transaction_copy->amount = $amount;
            $save_transaction_copy->user_id = \Auth::user()->id;
            $save_transaction_copy->save();
            echo file_get_contents($results['data']['payment_url']);//start the URL in the browser
            exit();
        }
        else{
           $status = $results["message"]; 
        }
        return back()->with(['status'=>$status]); 
     }

    public function savetransactions()
    {
        if ($_GET["status"]=="SUCCESS"){
            $user_cart = Cart::all()->where('user_id',\Auth::user()->id)->where('status',0);
            foreach ($user_cart as $carts) {
               $updates = Cart::find($carts->id);
               $updates->status = 1;
               $status->save();
            } 

            $updates_transaction = Transaction::all()->where('transaction_id',$_GET['data']["transaction_id"])->last();
            if (json_encode($updates_transaction) != "null") {
                 $updates_transaction->status = $_GET["status"];
                 $updates_transaction->save();
            }    
        }       
        else{
            return redirect()->route('product.index')->with(['status'=>$_GET["message"]]); 
        }
    }
}
