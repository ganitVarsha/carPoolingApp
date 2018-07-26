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
            <label for="phone">Phone Number:</label></div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}" maxlength="10">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="isAdmin">Role:</label></div>
        <div class="form-group col-md-4">
            <select name='isAdmin' style="width: 100%">
                <option value ='1' <?php echo ($user->isAdmin) ? 'selected' : ''; ?> >Admin</option>
                <option value ='0' <?php echo ($user->isAdmin) ? '' : 'selected'; ?> >Others</option>
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
    
    $("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
});
</script>