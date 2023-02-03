@extends('layouts.auth')
@section('content')
        <div class="info info-user" id="info">
            <div class="info__block info-block-user">
                <div class="info__top">
                    <div class="info__logo info-logo-user">
                        {{$user->name}} - message
                    </div>
                    <div class="info__button info-button-user">
                        <button onclick="closeInfo()">×</button>
                    </div>
                </div>
                <form action="{{route('messages.user_page', ['user'=>$user->id, 'user_from'=>Auth::user()->id])}}" class="info__message">
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Write a message..."></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="profile__left">
                @if($_SERVER['REQUEST_URI'] === '/users/'.Auth::user()->id)
                    <form action="{{route('images.users.upload')}}" method="post" enctype="multipart/form-data" class="img-form">
                        @csrf
                        <input type="file" name="img">
                        <button type="submit">Upload</button>
                    </form>
                @endif
                <div class="profile__avatar">
                    @if(!empty($image[0]))
                        <img src="{{asset('/storage/'.$image[0]->img_url)}}" alt="">
                    @endif
                </div>
                @if($_SERVER['REQUEST_URI'] !== '/users/'.Auth::user()->id)
                    @if(empty(reset($friend)) && empty(reset($invite)))
                        <form action="{{route('friends.add', ['user'=>Auth::user()->id, 'invited'=>$user->id])}}" method="post" class="profile__add-friend">
                            @csrf
                            <button type="submit">Add</button>
                        </form>
                    @endif
                    <button onclick="openInfo()">Message</button>
                @endif
            </div>
            <div class="profile__right">
                @if($_SERVER['REQUEST_URI'] !== '/users/'.Auth::user()->id)
                <div class="profile__items">
                    <ul>
                        <li><a href="{{route('user.friends', $user->id)}}">Friends</a></li>
                        <li><a href="{{route('user.groups', $user->id)}}">Groups</a></li>
                    </ul>
                </div>
                @endif
                <div class="profile__info">
                    <div>
                        <div>
                            Full name:
                        </div>
                        <div>
                            {{$user->name}}
                        </div>
                    </div>
                    <div>
                        <div>
                            Date of birth:
                        </div>
                        <div>
                            {{str_replace('-', '.', $user->birth_date)}}
                        </div>
                    </div>
                    <div>
                        <div>
                            Gender:
                        </div>
                        <div>
                            {{$user->gender}}
                        </div>
                    </div>
                </div>
                @if($_SERVER['REQUEST_URI'] === '/users/'.Auth::user()->id)
                <div class="profile__posts">
                    <form action="{{route('post.create', $user->id)}}" method="post">
                        @csrf
                        <textarea cols="30" rows="10" placeholder="Write a post..." name="post">{{trim(old('post'))}}</textarea>
                        <button type="submit">Post</button>
                    </form>
                    @error('post')
                    <p class="error-message">{{$message}}</p>
                    @enderror
                </div>

                @endif
                <div class="profile__show-posts">
                    @foreach($posts->reverse() as $post)
                        <div class="post">
                            <div class="post__time">
                                <div>
                                    {{$post->date}}
                                </div>
                                <div>
                                    {{$post->time}}
                                </div>
                            </div>
                            {{$post->post}}
                            @if($_SERVER['REQUEST_URI'] === '/users/'.Auth::user()->id)
                                <form action="{{route('post.delete', $post->id)}}" method="post" class="post__form-delete">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="post__delete">
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
