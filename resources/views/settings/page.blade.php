<!DOCTYPE html>
@extends('adminlte::page')
@section('title', 'Page Settings')
@section('content_header')
<style>
    .form-group textarea{
        width: 100%;
        height: 100px;
    }
</style>
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

<form method="post" action="{{url('settings/page')}}" enctype="multipart/form-data">
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
            <label for="about_us">About Us</label></div>
        <div class="form-group col-md-6">
            <textarea name="about_us[name]"> <?php echo (!empty($list)) ? $list['about_us']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="about_us[active]" <?php echo(!empty($list) && $list['about_us']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="contact_us">Contact Us</label></div>
        <div class="form-group col-md-6">
            <textarea name="contact_us[name]"> <?php echo (!empty($list)) ? $list['contact_us']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="contact_us[active]" <?php echo(!empty($list) && $list['contact_us']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="terms_and_conditions">Terms &amp; Conditions</label></div>
        <div class="form-group col-md-6">
            <textarea name="terms_and_conditions[name]"> <?php echo (!empty($list)) ? $list['terms_and_conditions']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="terms_and_conditions[active]" <?php echo(!empty($list) && $list['terms_and_conditions']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="privacy_policies">Privacy Policy</label></div>
        <div class="form-group col-md-6">
            <textarea name="privacy_policies[name]"> <?php echo (!empty($list)) ? $list['privacy_policies']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="privacy_policies[active]" <?php echo(!empty($list) && $list['privacy_policies']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="refund_policies">Refund Policies</label></div>
        <div class="form-group col-md-6">
            <textarea name="refund_policies[name]"> <?php echo (!empty($list)) ? $list['refund_policies']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="refund_policies[active]" <?php echo(!empty($list) && $list['refund_policies']->is_active) ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="faq">FAQs</label></div>
        <div class="form-group col-md-6">
            <textarea name="faq[name]"> <?php echo (!empty($list)) ? $list['faq']->value : ''; ?> </textarea>
        </div>
        <div class="form-group col-md-3">
            <input type="checkbox" name="faq[active]" <?php echo(!empty($list) && $list['faq']->is_active) ? 'checked' : ''; ?> />
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