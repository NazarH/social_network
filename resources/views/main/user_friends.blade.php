@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="friends">
            <div class="h">{{$username}} - Friends:</div>
            @foreach($friends as $friend)
                <div class="friends__user friends__user-list">
                    <a href="{{asset('/users/'.$friend[0])}}">{{$friend[1]}}</a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
