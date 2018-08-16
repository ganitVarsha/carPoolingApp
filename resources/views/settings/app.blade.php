<!DOCTYPE html>
@extends('adminlte::page')
@section('title', 'Web Settings')
@section('content_header')

<h1>Add User</h1>

@stop

<!-- Main content -->
@section('content')

<br>

<?php if ($updated) { ?>
    <div class="alert alert-success">
        <p>{{ 'Settings updated successfully!' }}</p>
    </div><br />
<?php } ?>

<form method="post" action="{{url('settings/app')}}" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT')}}
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <b> Value </b>
        </div>
        <div class="form-group col-md-3">
            <b> Is Active </b>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="radius">Radius</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="radius[name]" value = <?php echo (!empty($list)) ? $list['radius']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="radius[active]" <?php echo(!empty($list) && $list['radius']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="google_api_key">Google API Key</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="google_api_key[name]" value = <?php echo (!empty($list)) ? $list['google_api_key']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="google_api_key[active]" <?php echo(!empty($list) && $list['google_api_key']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="play_store_link">Play Store Link</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="play_store_link[name]" value = <?php echo (!empty($list)) ? $list['play_store_link']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="play_store_link[active]" <?php echo(!empty($list) && $list['play_store_link']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">   
        <div class="col-md-3">
            <label for="app_store_link">App Store Link</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="app_store_link[name]" value = <?php echo (!empty($list)) ? $list['app_store_link']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="app_store_link[active]" <?php echo(!empty($list) && $list['app_store_link']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">   
        <div class="col-md-3">
            <label for="google_direction_api_key">Google Direction API Key</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="google_direction_api_key[name]" value = <?php echo (!empty($list)) ? $list['google_direction_api_key']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="google_direction_api_key[active]" <?php echo(!empty($list) && $list['google_direction_api_key']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">   
        <div class="col-md-3">
            <label for="facebook_secret_key_app_appId">Facebook Secret Key App ID</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="facebook_secret_key_app_appId[name]" value = <?php echo (!empty($list)) ? $list['facebook_secret_key_app_appId']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="facebook_secret_key_app_appId[active]" <?php echo(!empty($list) && $list['facebook_secret_key_app_appId']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">   
        <div class="col-md-3">
            <label for="google_plus_secret_key_app_appId">Google Plus Secret Key App ID</label></div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="google_plus_secret_key_app_appId[name]" value = <?php echo (!empty($list)) ? $list['google_plus_secret_key_app_appId']->value : ''; ?>>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="google_plus_secret_key_app_appId[active]" <?php echo(!empty($list) && $list['google_plus_secret_key_app_appId']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>

@stop

@extends('common.footer')