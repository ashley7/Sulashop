@extends('layouts.app')
@section('content')
 <h1>List of users</h1>
    <a class="btn btn-primary" style="float: right;" href="{{route('user.create')}}">Add user</a><br><br>
    <div class="card-box">
        <table class="table" id="sales">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Roles</th>
            </thead>

            <tbody>
                @foreach($user as $users)
                  <tr>
                      <td>{{$users->id}}</td>
                      <td>{{$users->name}}</td>
                      <td>{{$users->phone_number}}</td>
                      <td>{{$users->email}}</td>
                      <td>
                          @foreach($users->roles as $role)
                            {{$role->name}}
                          @endforeach
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table> 
    </div>            
       
 
 
@endsection