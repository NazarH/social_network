@extends('layouts.auth')
@section('content')
    <div class="container container__friends">
        <div class="invitations">
            <div class="h">Invitations</div>
            @foreach($invitations as $invite)
                <div class="invitations__user">
                    <a href="{{asset('/users/'.$invite[0])}}">{{$invite[1]}}</a>
                    <form action="{{route('friends.confirm')}}" method="post" class="invitations__confirm">
                        @csrf
                        <input type='text' name="invite_friend_id" value="{{$invite[0]}}">
                        <input type='text' name="invited_friend_id" value="{{Auth::user()->id}}">
                        <button type="submit">Add</button>
                    </form>
                    <form action="{{route('confirm.cancel', $invite[2])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Cancel" class="">
                    </form>
                </div>
            @endforeach
        </div>
        <div class="friends">
            <div class="h">Friends</div>
            @foreach($friends as $friend)
                <div class="friends__user">
                    <a href="{{asset('/users/'.$friend[0])}}">{{$friend[1]}}</a>
                    <form action="{{route('friends.delete', $friend[2])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" class="">
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
