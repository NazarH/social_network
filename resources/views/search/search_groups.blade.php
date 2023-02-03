@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="search">
            <form action="{{route('search.groups.form')}}" class="search__form" method="post">
                @csrf
                <input type="text" name="name" placeholder="Enter name...">
                <button type="submit">Search</button>
            </form>
            @error('name')
                <p class="error-message error-search">{{$message}}</p>
            @enderror
            <div class="search__items">
                @foreach($groups as $group)
                    <a href="{{asset('/groups/'.$group->id)}}" class="search__item">{{$group->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
