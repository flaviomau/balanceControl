@extends('adminlte::page')

@section('title', 'Confirm transfer')

@section('content_header')
    <h1>Confirm transfer</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Balance</a></li>
        <li><a href="{{ route('balance.transfer') }}">Transfer</a></li>
        <li><a href="{{ route('transfer.confirm') }}">Confirm transfer</a></li>
    </ol>
@stop

@section('content_header')
    <h1>Confirm transfer</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transfer value:</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <p><strong>Receiver name:</strong> {{ $receiver->name }}</p>
            <p><strong>Receiver email:</strong> {{ $receiver->email }}</p>
            <p><strong>Max value to transfer:</strong> {{ $balance }}</p>
            <form method="POST" action="{{ route('transfer.store')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <input type="text" name="value" placeholder="Transfer value" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transfer</button>
                </div>
            </form>
        </div>
    </div>
@stop