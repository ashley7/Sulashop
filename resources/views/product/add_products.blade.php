@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Add Property</div>     

        <div class="card-body">

          <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <label>Name</label>
            <input type="text" class="form-control" name="name">
          
            <label>Category</label>
            <select name="category_id" class="form-control" class="form-control">
                <option></option>
                @foreach(App\Category::all() as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <label>Quantity</label>
            <input type="text" name="quentity" class="form-control">

            <label>Buying price</label>
            <input type="text" name="buying_price" class="form-control number">

            <label>Salling price</label>
            <input type="text" name="salling_price" class="form-control number">
            <br>
            <input type="file" name="image_url">
            <br><br>
            <button class="btn btn-primary" type="submit">Save</button>
          </form>

                        
        </div>
    </div>
</div> 
@endsection