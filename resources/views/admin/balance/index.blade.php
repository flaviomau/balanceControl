@extends('adminlte::page')

@section('title', 'Balance')

@section('content_header')
    <h1>Balance</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Balance</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        <a href="{{ route('balance.deposit') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Deposit</a>
        @if($amount > 0)
            <a href="{{ route('balance.withdraw') }}" class="btn btn-danger"><i class="fa fa-cart-arrow-down"></i> Withdraw</a>
            <a href="{{ route('balance.transfer') }}" class="btn btn-warning"><i class="fa fa-exchange"></i> Transfer</a>
        @endif        
        </div>
        <div class="box-body">            
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-green">                    
                    <div class="inner">
                    <h3>$ {{ number_format($amount, 2, ',', '') }}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="#" class="small-box-footer">Historic <i class="fa fa-arrow-circle-right"></i></a>      
                </div>
                @include('admin.includes.alerts')
            </div>
        </div>
    </div>
@stop