@extends('site.layouts.app')

@section('title', 'My Profile')

@section('content')
    <h1>My Profile</h1>
    @include('site.includes.alerts')
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{auth()->user()->name}}" name="name" placeholder="Name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{auth()->user()->email}}" name="email" id="Email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="form-group">
            @if (auth()->user()->image != null)
                <img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="max-width: 50px;">
            @endif
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Update profile</button>
        </div>
    </form>
@endsection