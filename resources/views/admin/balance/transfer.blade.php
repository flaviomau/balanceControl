@extends('adminlte::page')

@section('title', 'Transfer')

@section('content_header')
    <h1>Transfer</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Balance</a></li>
        <li><a href="{{ route('balance.transfer') }}">Transfer</a></li>
    </ol>
@stop

@section('content_header')
    <h1>Transfer</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transfer value (Inform the receiver data)</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <form method="POST" action="{{ route('transfer.confirm')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="receiver" placeholder="Receiver data (name or email)" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Next Step</button>
                </div>
            </form>
        </div>
    </div>
@stop