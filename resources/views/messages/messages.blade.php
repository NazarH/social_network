@extends('layouts.auth_form')
@section('content')
    <div class="container">
        <div class="messages">
            <div class="messages__users">
                @foreach($users_list as $k => $user)
                    <div id="user-item-{{$k}}" class="user-items"
                         onclick="show_user_messages('<?php echo $k;?>', '<?php echo $user->id;?>')">{{$user->name}}</div>
                @endforeach
            </div>
            <div class="messages__block">
                <div class="messages__area">
                    @foreach($user_messages as $k => $message_items )
                        <div class="message__items" id="{{$k}}">
                        @foreach($message_items as $item)
                            <div class="item">
                                <div class="message__info">
                                    <div>
                                        {{substr(substr($item->created_at, 0, -3), 11, 5)}}
                                    </div>
                                    <div>
                                        @if($item->name === Auth::user()->name)
                                            You:
                                        @else
                                            {{$item->name}}:
                                        @endif
                                    </div>
                                    <div>
                                        {{$item->message}}
                                    </div>
                                </div>
                                <div>
                                    {{str_replace('-','.',substr($item->created_at, 0, 10))}}
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                </div>

                <form action="{{route('messages.send', Auth::user()->id)}}" class="messages__form" id="send-form">
                    <input type='text' id='send_user_id' style="display: none" name="to_whom_id">
                    <input type="text" placeholder="write a message..." name="message">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

@endsection
