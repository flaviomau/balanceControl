@extends('adminlte::page')

@section('title', 'Withdraw')

@section('content_header')
    <h1>Withdraw</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.balance') }}">Balance</a></li>
        <li><a href="{{ route('balance.withdraw') }}">Withdraw</a></li>
    </ol>
@stop

@section('content_header')
    <h1>Withdraw</h1>
@stop

@section('content')
    <p>My Withdraw</p>
@stop