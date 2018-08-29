@extends('layouts.app')

@section('content') 
<h1>Dashboard</h1>
    <div class="row text-center">

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Expenses</p>
                    <h2 class="text-danger"><span data-plugin="counterup">UGX: {{number_format($product_expenses)}}</span></h2>
                     
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Payment</p>
                    <h2 class="text-primary"><span data-plugin="counterup">UGX: {{number_format($payments)}}</span> </h2>
                
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-success text-overflow">Revenue</p>
                    <h2 class="text-success"><span data-plugin="counterup">UGX: {{number_format($revenue)}}</span></h2>
               
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-warning text-overflow">Pending Cart</p>
                    <h2 class="text-warning"><span data-plugin="counterup">UGX: {{number_format($pending_payments)}}</span></h2>
               
                </div>
            </div>
        </div><!-- end col -->
    </div>

    <br>
    <h1>Sales</h1>
    <div class="card-box">
        <div class="table-responsive">
            <table class="table table-hover" id="sales">
                <?php $sumation = 0; ?>
                <thead>
                    <th>#</th> <th>Item Name</th> <th>User</th> <th>Quantity</th> <th>Amount (USD)</th> <th>Status</th>
                </thead>

                <tbody>
                    @foreach($paid_items as $carts)
                      @php
                        $sumation =  $sumation + ($carts->quantity * $carts->product->salling_price);           
                       @endphp                           
                      <tr>
                          <td>{{$carts->id}}</td>
                          <td>{{$carts->product->name}}</td>
                          <td>{{$carts->user->name}} ({{$carts->user->phone_number}})</td>
                          <td>{{$carts->quantity}}</td>                         
                          <td>{{number_format($carts->quantity * $carts->product->salling_price)}}</td>
                          <td>
                             @if($carts->status == 0)
                              <span class="btn btn-warning">Pending</span>
                              @elseif($carts->status == 1)
                              <span class="btn btn-success">Paid</span>
                            @endif  
                          </td>
                          
                      </tr>
                    @endforeach
                    <tr>
                        <td>Total</td> <td></td> <td></td> <td></td> <td></td> <td>{{number_format($sumation)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>     
    </div>
@endsection
