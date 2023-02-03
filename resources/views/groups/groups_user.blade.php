@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="invitations">
            <div class="h">{{$user->name}} - Group List:</div>
            @foreach($user_groups as $group)
                <div class="invitations__user mwidth">
                    <a href="{{asset('/groups/'.$group[0]->id)}}">{{$group[0]->name}}</a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
