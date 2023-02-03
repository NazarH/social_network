@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="group">
            <div class="group__left">
                <div class="group__name">
                    <div>
                        {{$group->name}}
                    </div>
                    <div>
                        <a href="{{route('groups.members', $group->id)}}">Group Members</a>
                    </div>
                </div>
                <div class="group__description">
                    <div>Description:</div>
                    {{$group->description}}
                </div>
                @if(!empty($user))
                    @if($user[0]->role === 'admin')
                        <form action="{{route('groups.post', $group->id)}}" method="post" class="group__post">
                            @csrf
                            <textarea name="post" cols="30" rows="10" placeholder="Write post...">{{trim(old('post'))}}</textarea>
                            <button type="submit">Post</button>
                        </form>
                        @error('post')
                            <p class="error-message">{{$message}}</p>
                        @enderror
                    @endif
                @endif
                <div class="group__posts">
                    @foreach($posts->reverse() as $post)
                        <div class="group__post-block">
                            <div class="group__post-top">
                                <div>
                                    {{$group->name}}
                                </div>
                                <div>
                                    {{$post->date}} - {{$post->time}}
                                </div>
                            </div>
                            <div class="group__content">
                                {{$post->post}}
                            </div>
                            @if(!empty($user))
                                @if($user[0]->role === 'admin')
                                    <form action="{{route('groups.post_delete', ['group'=>$group->id, 'post'=>$post->id])}}" method="post" class="post__form-delete">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="post__delete">
                                    </form>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="group__right">
                @if(!empty($user))
                    @if($user[0]->role === 'admin')
                        <form action="{{route('images.groups.upload', $group->id)}}" method="post" enctype="multipart/form-data" class="img-form">
                            @csrf
                            <input type="file" name="img">
                            <button type="submit">Upload</button>
                        </form>
                    @endif
                @endif
                <div class="group__photo">
                    @if(!empty($image[0]))
                        <img src="{{asset('/storage/'.$image[0]->img_url)}}" alt="">
                    @endif
                </div>
                <div class="group__join-btn">
                    @if(empty($user))
                        <form action="{{route('groups.join', ['group'=>$group->id, 'member'=>Auth::user()->id])}}"
                              method="post" class="group__join-form">
                            @csrf
                            <button type="submit">
                                Join
                            </button>
                        </form>

                    @else
                        <form action="{{route("groups.exit", ['group_id'=>$group->id, 'member_id'=>$user[0]->member_id])}}" method="post" class="group__join-form">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Exit" class="exit-btn">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
