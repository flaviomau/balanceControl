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
            <form action="{{ route('historic.search') }}" method="post" class="form form-inline">
                {!! csrf_field() !!}
                <input type="text" name="id" class="form-control" placeholder="ID"/>
                <input type="date" name="date" class="form-control"/>
                <select name="type" class="form-control">
                    <option value=""> --- Select --- </option>
                    @foreach ($types as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>                    
                        <th>Date</th>
                        <th>Type</th>
                        <th></th>
                        <th>Amount</th>                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($historics as $historic)
                    <tr>
                        <th>{{ $historic->id }}</th>
                        <th>{{ $historic->date }}</th>
                        <th>{{ $historic->type($historic->type) }}</th>
                        <th>
                            @if($historic->user_id_transaction)
                                {{ $historic->userTransaction->name }}
                            @endif
                        </th>
                        <th>{{ number_format($historic->amount, 2, ',', '') }}</th>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @if(isset($dataForm))
                {!! $historics->appends($dataForm)->links() !!}
            @else
                {!! $historics->links() !!}
            @endif            
        </div>
    </div>
@stop