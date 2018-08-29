@extends('layouts.app')
@section('content')
<h1>List of Categories</h1>
  <a class="btn btn-success" style="float: right;" href="{{route('category.create')}}">Add category</a>
  <br><br>

        <div class="card-box">
            <div class="table-responsive">
              <table class="table table-sales" id="sales">
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
      
@endsection