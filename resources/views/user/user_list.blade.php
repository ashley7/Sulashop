@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">List of users</div>

        <a href="{{route('user.create')}}">Add user</a>

        <div class="card-body">

            <table class="table">
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
    </div>
</div>
 
 
@endsection