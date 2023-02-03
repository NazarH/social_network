@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="news-posts">
            @foreach($posts_sort as $post)
                <div class="news-posts__post">
                    <div class="news-posts__top">
                        <div>
                            {{$post->group_name}}
                        </div>
                        <div>
                            {{str_replace('-', '.', $post->date)}} - {{substr($post->time, 0, -3)}}
                        </div>
                    </div>
                    <div class="news-posts__content">
                        {{$post->post}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
