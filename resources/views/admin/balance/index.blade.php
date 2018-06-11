@extends('adminlte::page')

@section('title', 'Balance')

@section('content_header')
    <h1>Balance</h1>
    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Balance</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Deposit</a>
            <a href="" class="btn btn-danger"><i class="fa fa-cart-arrow-down"></i> Withdraw</a>
        </div>
        <div class="box-body">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>R$ 90,00<sup style="font-size: 20px"></sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="#" class="small-box-footer">Historic <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@stop