@if(Auth::user())
    @php(redirect('news')->send())
@endif
@extends('layouts.main')
@section('content')
    <form class="login__form" method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email address" value="{{old('email')}}">
        @error('email')
            <p>{{$message}}</p>
        @enderror
        <input type="password" placeholder="Enter password" name="password">
        @error('password')
            <p>{{$message}}</p>
        @enderror
        <div class="login__btns">
            <button type="submit">{{ __('Login') }}</button>
            <button><a href="{{asset("register")}}">Register</a></button>
        </div>
    </form>
@endsection
