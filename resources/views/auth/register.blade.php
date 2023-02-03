@if(Auth::user())
    @php(redirect('news')->send())
@endif

@extends('layouts.main')
@section('content')
    <form action="{{ route('register') }}" class="register__form" method="POST">
        @csrf
        <input type="text" placeholder="Name Surname" name="name" value="{{old('name')}}">
        @error('name')
            <p>{{$message}}</p>
        @enderror
        <input type="date" id="start" name="birth_date"
               value="{{old('birth_date')}}">
        @error('birth_date')
            <p>{{$message}}</p>
        @enderror
        <div class="register__radio">
            <div>
                Male<input type="radio" name="gender" value="male">
            </div>
            <div>
                Female<input type="radio" name="gender" value="female">
            </div>
        </div>
        @error('gender')
            <p>{{$message}}</p>
        @enderror
        <input type="text" placeholder="Email address" name="email" value="{{old('email')}}">
        @error('email')
            <p>{{$message}}</p>
        @enderror
        <input type="password" placeholder="Enter password" name="password">
        @error('password')
            <p>{{$message}}</p>
        @enderror
        <input id='password-confirm' type="password" placeholder="Repeat password" name="password_confirmation">
        @error('password_confirmation')
            <p>{{$message}}</p>
        @enderror
        <div class="login__btns">
            <button type="submit">{{ __('Register') }}</button>
        </div>
    </form>
@endsection
