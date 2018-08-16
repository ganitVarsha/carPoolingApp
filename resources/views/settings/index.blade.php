<!DOCTYPE html>
@extends('adminlte::page')
@section('title', $title)
@section('content_header')
<style>
    .form-group textarea{
        width: 100%;
        height: 100px;
    }
</style>

@stop

<!-- Main content -->
@section('content')

<br>

<?php if ($updated) { ?>
    <div class="alert alert-success">
        <p>{{ 'Settings updated successfully!' }}</p>
    </div><br />
<?php } ?>

<form method="post" action="{{url($redirect_to)}}" enctype="multipart/form-data">
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

    <?php
    if (!empty($list)) {
        foreach ($list as $key => $field) {
            ?>
            <div class="row">
                <div class="col-md-3">
                    <label for="{{ $field->settings_name }}">{{ $field->settings_label }}</label></div>
                <div class="form-group col-md-6">
                    @if($field->input_type == 'file')
                    <input type="file" class="form-control" name="<?php echo $field->settings_name . '[name]'; ?>" value = <?php echo $field->value; ?>>
                    @elseif($field->input_type == 'textarea')
                    <textarea name="<?php echo $field->settings_name . '[name]'; ?>"> <?php echo $field->value; ?> </textarea>
                    @else     
                    <input type="text" class="form-control" name="<?php echo $field->settings_name . '[name]'; ?>" value = <?php echo $field->value; ?>>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <input type="checkbox" name="<?php echo $field->settings_name . '[active]'; ?>" <?php echo($field->is_active) ? 'checked' : ''; ?> />
                </div>
            </div>

            <?php
        }
    }
    ?>

    <div class="row">
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>

@stop

@extends('common.footer')