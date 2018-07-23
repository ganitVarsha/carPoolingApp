<!DOCTYPE html>
@extends('adminlte::page')
@section('title', 'Users List')
@section('content_header')

<h1>Users List</h1>

@stop

<!-- Main content -->
@section('content')

<br />
@if (\Session::has('success'))
<div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div><br />
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Added Date</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $user)
        @php
        $date=date('Y-m-d', $user['date']);
        @endphp
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['first_name']." ".$user['last_name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['created_at']}}</td>

            <td><a href="{{action('UserController@edit', $user['id'])}}" class="btn btn-warning">Edit</a></td>
            <td>
                <form action="{{action('UserController@destroy', $user['id'])}}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger delete-user" type="submit" >Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
$(document).ready(function () {
    $('.alert').fadeOut(3000);
    $('.delete-user').click(function () {
        event.preventDefault();
        if (confirm("Do you want to delete this user?")) {
            $(this).parent('form').submit();
        }
    });
});
</script>