@extends('layouts.auth')
@section('content')
    <div class="container container__groups">
        <div class="personal__groups">
            <div class="personal__groups-top">
                <div class="h">Personal Groups</div>
                <a href="{{route("groups.create")}}">Create</a>
            </div>
            @foreach($personal as $group)
                <a href="/groups/{{$group->id}}">{{$group->name}}</a>
            @endforeach
        </div>
        <div class="ather__groups">
            <div class="ather__groups-top">
                <div class="h">Ather Groups</div>
            </div>
            @foreach($ather_list as $group)
                @if($group[0]->creator_id !== Auth::user()->id)
                        <a href="/groups/{{$group[0]->id}}">{{$group[0]->name}}</a>
                @endif
            @endforeach

        </div>
    </div>

@endsection
