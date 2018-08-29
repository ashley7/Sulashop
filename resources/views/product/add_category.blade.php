@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Add new Category</div>     

        <div class="card-body">

          <form method="POST" action="{{route('category.store')}}">
            @csrf
            <label>Name</label>
            <input type="text" class="form-control" name="name">
            <br>
            <button class="btn btn-primary" type="submit">Save</button>
          </form>

                        
        </div>
    </div>
</div> 
@endsection