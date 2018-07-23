<!DOCTYPE html>
@extends('adminlte::page')
@section('title', 'Update User')
@section('content_header')

<h1>Update User</h1>

@stop

<!-- Main content -->
@section('content')

<form method="post" action="{{action('UserController@update', $user->id)}}">
    @csrf
    {{ method_field('PUT')}}
    <div class="row">
        <div class="col-md-4">
            <label for="Name">First Name:</label></div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="Name">Last Name:</label></div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="Email">Email:</label></div>
        <div class="form-group col-md-4">
            <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="isAdmin">Is Admin:</label></div>
        <div class="form-group col-md-4">
            <select name='isAdmin' style="width: 100%">
                <option value ='1' <?php echo ($user->isAdmin) ? 'selected' : ''; ?> >Yes</option>
                <option value ='0' <?php echo ($user->isAdmin) ? '' : 'selected'; ?> >No</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="Number">Password:</label></div>
        <div class="form-group col-md-4">
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="Number">Confirm Password:</label></div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="confirm_password" id="confirm_password">
        </div>
    </div>
    <div class="row password-error" style="display: none;">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <span style="color : red">Passwords don't match.</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>

@stop
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script>
$(document).ready(function () {
    $('button[type="submit"]').click(function () {
        var isValid = true;
        if ($('#password').val() !== $('#confirm_password').val()) {
            $('.password-error').css('display', 'block');
            $("#password, #confirm_password").css({
                "border": "1px solid red",
                "background": "#FFCECE"
            });
            isValid = false;
        }
        if (isValid === true) {
            $('.password-error').css('display', 'none');
            $("#password, #confirm_password").css({
                "border": "",
                "background": ""
            });
            $('input[type="text"], input[type="email"]').each(function () {
                if (($(this).attr('id') != 'confirm_password') && $.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border": "1px solid red",
                        "background": "#FFCECE"
                    });
                } else {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }
            });
        }
        if (isValid === false) {
            $('button[type="submit"]').prop('disabled', true);
        } else {
            $('button[type="submit"]').prop('disabled', false);
        }
    });
    $('input').focusout(function () {
        $('button[type="submit"]').prop('disabled', false);
    });
});
</script>