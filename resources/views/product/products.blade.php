@extends('layouts.app')
@section('content')
<div class="container">    
    <div class="card-header">List of products</div>
    <a href="{{route('product.create')}}">Add products</a> 
    <div class="row">  
        @foreach($products as $product)
        @php	        
	        $cart_item_count = App\Cart::all()->where('product_id',$product->id)->where('status',1)->count();
	    @endphp 
	   
	    @if(($product->quentity - $cart_item_count) > 0)
           	<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
        		<div class="card">
		          <div class="card-body">
		          	<img src="{{asset('images')}}/{{$product->image_url}}" width="100%">
		          	<span>$ {{number_format($product->salling_price)}}</span>		      
		          		<span><a href="{{route('product.edit',$product->id)}}">Edit</a></span>         
			     		<span><a href="{{route('product.show',$product->id)}}">Add to cart</a></span>	     
		          </div>
		        </div>        		
        	</div>
        @endif 

        @endforeach                 
    </div> 
</div>
@endsection