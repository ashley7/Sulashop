@extends('layouts.app')
@section('content')
<h1>Product in {{$category->name}} </h1>
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover" id="sales">
                    <?php $sumation = 0; ?>
                    <thead>
                        <th>#</th> <th>Picture</th> <th>Item Name</th> <th>Qnty In</th> <th>Qnty Out</th>  <th>Buying Price(USD)</th> <th>Salling price (USD)</th> <th>Expected profit</th>
                    </thead>

                    <tbody>
                        @foreach($category_products as $product)                                               
                          <tr>
                              <td>{{$product->id}}</td>

                               <td><img src="{{asset('images')}}/{{$product->image_url}}" width="30%"></td>
                              <td>{{$product->name}}</td>
                              <td>{{$product->quentity}}</td>
                              @php
                                $sum = 0;
                                $cart_item = App\Cart::all()->where('product_id',$product->id)->where('status',1);
                              @endphp                              
                               @foreach($cart_item as $item)
                                @php
                                  $sum = $sum + $item->quantity;
                                @endphp

                               @endforeach

                              <td>{{$product->quantity - $sum}}</td>
                             
                              <td>{{number_format($product->buying_price)}}</td>
                              <td>{{number_format($product->salling_price)}}</td>
                              <td>{{number_format($product->salling_price - $product->buying_price)}}</td>                              
                          </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
            </div>   
        
@endsection