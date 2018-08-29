@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">List of Categories</div>

        <a href="{{route('category.create')}}">Add category</a>

        <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                  <thead>
                      <th>#</th>
                      <th>Name</th>
                      <th>Number of Products</th>  
                      <th>Action</th>         
                  </thead>
                  <tbody>
                      @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                             {{App\Product::all()->where('category_id',$category->id)->count()}}
                            </td>

                            <td>
                               <a href="{{route('category.show',$category->id)}}" class="btn btn-primary">View Products</a>
                            </td>                   
                        </tr>
                      @endforeach
                  </tbody>
              </table>             
          </div>
      </div>
  </div>
</div>
@endsection