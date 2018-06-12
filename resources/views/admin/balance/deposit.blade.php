@extends('adminlte::page')

@section('title', 'Deposit')

@section('content_header')
    <h1>Deposit</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Balance</a></li>
        <li><a href="{{ route('balance.deposit') }}">Deposit</a></li>
    </ol>
@stop

@section('content_header')
    <h1>Deposit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Deposit value:</h3>
        </div>
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('deposit.store')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="deposit_value" placeholder="Deposit value" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Deposit</button>
                </div>
            </form>
        </div>
    </div>
@stop