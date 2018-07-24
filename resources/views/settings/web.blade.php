<!DOCTYPE html>
@extends('adminlte::page')
@section('title', 'Web Settings')
@section('content_header')

<h1>Add User</h1>

@stop

<!-- Main content -->
@section('content')

<br>

<form method="post" action="{{url('settings/web')}}" enctype="multipart/form-data">
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
                <label for="logo">Logo</label></div>
            <div class="form-group col-md-6">
                <input type="file" class="form-control" name="logo['name']" value = <?php (!empty($list)) ? $list['logo']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="logo['active']" <?php echo(!empty($list) && $list['logo']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="title_bar">Title Bar Text</label></div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="title_bar['name']" value = <?php (!empty($list)) ? $list['title_bar']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="title_bar['active']" <?php echo(!empty($list) && $list['title_bar']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="favicon_icon">Favicon Icon</label></div>
            <div class="form-group col-md-6">
                <input type="file" class="form-control" name="favicon_icon['name']" value = <?php (!empty($list)) ? $list['favicon_icon']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="favicon_icon['active']" <?php echo(!empty($list) && $list['favicon_icon']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="facebook_link">Facebook Link</label></div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="facebook_link['name']" id="facebook_link" value = <?php (!empty($list)) ? $list['facebook_link']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="facebook_link['active']" <?php echo(!empty($list) && $list['facebook_link']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="google_plus_link">Google+ Link</label></div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="google_plus_link['name']" id="google_plus_link" value = <?php (!empty($list)) ? $list['google_plus_link']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="google_plus_link['active']" <?php echo(!empty($list) && $list['google_plus_link']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="twitter_link">Twitter Link</label></div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="twitter_link['name']" id="twitter_link" value = <?php (!empty($list)) ? $list['twitter_link']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="twitter_link['active']" <?php echo(!empty($list) && $list['twitter_link']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="linkedin_link">Linkedin Link</label></div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="linkedin_link['name']" id="linkedin_link" value = <?php (!empty($list)) ? $list['linkedin_link']->value : '';?>>
            </div>
            <div class="form-group col-md-3">
                <input type="checkbox" name="linkedin_link['active']" <?php echo(!empty($list) && $list['linkedin_link']->is_active) ? 'checked' : ''; ?> />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>

@stop