
@extends('adminlte::page')



@section('title', 'Dashboard')



@section('content_header')

<h1>Dashboard</h1>

@stop

<!-- Main content -->
@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>

                <p>Completed Trips</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Cancelled Trips</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-cancel"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>

                <p>Ongoing Trips</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue-gradient">
            <div class="inner">
                <h3>65</h3>

                <p>Total Users(Male)</p>
            </div>
            <div class="icon">
                <i class="ion ion-male"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>65</h3>

                <p>Total Users(Female)</p>
            </div>
            <div class="icon">
                <i class="ion ion-female"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
                <h3>65</h3>

                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">

    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-12 connectedSortable">
        
        <!-- using Lava charts -->
        <div id="pop_div"></div>
        
        {!! $lava->render('AreaChart', 'Booking', 'pop_div') !!}
        <!-- Lava charts end -->

    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->


@stop



@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">

@stop



@section('js')

<script> //console.log('Hi!');</script>

@stop