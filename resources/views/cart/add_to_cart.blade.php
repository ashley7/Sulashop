@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{$product->name}}</div>     

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <img src="{{asset('images')}}/{{$product->image_url}}" width="100%">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <form method="POST" action="{{route('cart.store')}}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <label>Quantity</label>
                        <input type="text" id="qnty" name="quantity" value="1" class="form-control">
                        <br><br>
                        <span id="total">$ {{number_format($product->salling_price)}}</span>
                        <br><br>
                        <button class="btn btn-primary" type="submit">Save to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

@push('scripts')
  <script type="text/javascript">
      $(document).ready(function(){
    $("#qnty").keyup(function(){        
        var data_qnty=$('#qnty').val();
        showmobile(data_qnty);        
    });
 
});


function showmobile(data_amount){
    var amount=Math.round(data_amount*({{$product->salling_price}}));
    $('#total').html("$"+addcommas(amount));      
}

function addcommas(str)
{   
    str += '';
    var x = str.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.'+x[1]:'';
    var rgx = /(\d+)(\d{3})/;
    while(rgx.test(x1)){
        x1 = x1.replace(rgx,'$1'+','+'$2');
    }
    return x1+x2;
}
  </script>

@endpush