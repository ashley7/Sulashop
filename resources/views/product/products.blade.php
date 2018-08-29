@extends('layouts.app')
@section('content')
<h1>List of products</h1>
 @role(['store'])
    <a style="float: right;" class="btn btn-success" href="{{route('product.create')}}">Add products</a> 
     <br><br><br>
 @endrole
     <div class="row text-center">
    @foreach($products as $product)
        @php	        
	        $cart_item_count = App\Cart::all()->where('product_id',$product->id)->where('status',1)->count();
	    @endphp 
	    @if(($product->quentity - $cart_item_count) > 0)
           	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            	<div class="card-box widget-box-one">
		          	<img src="{{asset('images')}}/{{$product->image_url}}" width="100%" height="200px">
		          	<span>$ {{number_format($product->salling_price)}}</span>
		          	  <span style="float: right;">
		          	  @role('store')
		          	  	<span><a href="{{route('product.edit',$product->id)}}"><i class="zmdi zmdi-edit"></i></a></span>
		          	  @endrole
		         

		          	  	@role('buyer')       
			     		<span><a href="{{route('product.show',$product->id)}}"><i class="zmdi zmdi-shopping-cart"></i></a></span>
			     		@endrole
		          	  </span>	      
		           </div>
		    </div>        		
        @endif 
	@endforeach  
    </div>                  
@endsection