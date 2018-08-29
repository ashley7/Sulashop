@extends('layouts.app')
@section('content')
<h1>Add new Category</h1>
    <div class="card-box">
      <form method="POST" action="{{route('category.store')}}">
        @csrf
        <label>Name</label>
        <input type="text" class="form-control" name="name">
        <br>
        <button class="btn btn-primary" type="submit">Save</button>
      </form>                        
    </div>   
@endsection