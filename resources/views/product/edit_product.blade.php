@extends('layouts.app')
@section('content')
<h1>Add Property</h1>   

        <div class="card-box">

         {{Form::model($product,['method'=>'PATCH', 'action'=>['ProductController@update',$product->id], 'files'=>true])}}
            <label>Name</label>
            <input type="text" class="form-control" value="{{$product->name}}" name="name">    
            
            <label>Quantity</label>
            <input type="text" name="quentity" value="{{$product->quentity}}" class="form-control">

            <label>Buying price</label>
            <input type="text" name="buying_price" value="{{$product->buying_price}}" class="form-control number">

            <label>Salling price</label>
            <input type="text" name="salling_price" value="{{$product->salling_price}}" class="form-control number">
            <br>
            <input type="file" name="image_url">
            <br><br>
            <button class="btn btn-primary" type="submit">Save</button>
          {{ Form::close() }}                        
        </div>
     
@endsection