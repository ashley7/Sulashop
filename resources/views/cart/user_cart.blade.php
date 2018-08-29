@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Items on your Cart </div>     
            <div class="card-body">
                <a href="/pay_cart" class="btn btn-primary">Pay Cart</a><br><br>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php $sumation = 0; ?>
                        <thead>
                            <th>#</th> <th>Item Name</th> <th>Picture</th> <th>Quantity</th> <th>Unit Price(USD)</th> <th>Amount (USD)</th> <th>Status</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($user_cart as $carts)
                              @php 
                                if($carts->status == 0){
                                  $sumation =  $sumation + ($carts->quantity * $carts->product->salling_price);
                                }
                                
                              @endphp                           
                              <tr>
                                  <td>{{$carts->id}}</td>
                                  <td>{{$carts->product->name}}</td>
                                  <td><img src="{{asset('images')}}/{{$carts->product->image_url}}" width="20%"></td>
                                  <td>{{$carts->quantity}}</td>
                                  <td>{{number_format($carts->product->salling_price)}}</td>
                                  <td>{{number_format($carts->quantity * $carts->product->salling_price)}}</td>
                                  <td>
                                    @if($carts->status == 0)
                                      <span class="alert alert-warning">Pending</span>
                                      @elseif($carts->status == 1)
                                      <span class="alert alert-success">Paid</span>
                                    @endif  
                                  </td>
                                  <td>
                                      {{ Form::open(array('route' => array('cart.destroy',$carts->id), 'method' => 'delete','onsubmit' => 'return confirm("You are about to delete an item from your cart. Do you want to proceed?"); return false;')) }}                                      
                                              <button  class="btn btn-danger" type="submit">Delete</button>
                                           {{ Form::close() }}
                                  </td>
                              </tr>
                            @endforeach
                            <tr>
                                <td>Total Unpaid</td> <td></td> <td></td> <td></td> <td></td> <td>{{number_format($sumation)}}</td><td></td> <td></td> 
                            </tr>
                        </tbody>
                    </table>
                </div>     
            </div>
        </div>
    </div> 
@endsection