@extends('adminlte::page')

@section('title', 'Historic')

@section('content_header')
    <h1>Historic</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.historic') }}">Historic</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        <a href="{{ route('balance.deposit') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Deposit</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Name</th>                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($historics as $historic)
                    <tr>
                        <th>{{ $historic->id }}</th>
                        <th>{{ number_format($historic->amount, 2, ',', '') }}</th>
                        <th>{{ $historic->type($historic->type) }}</th>                        
                        <th>{{ $historic->date }}</th>
                        <th>
                            @if($historic->user_id_transaction)
                                {{ $historic->userTransaction->name }}
                            @endif                        
                        </th>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop