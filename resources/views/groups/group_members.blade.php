@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="members">
            <div class="h">Users List</div>
            @foreach($user_list_f as $user)
                <div class="members__user">
                    <a href="/users/{{$user[0]->id}}">{{$user[0]->name}}</a>
                    <div>{{$user[0]->role}}</div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
