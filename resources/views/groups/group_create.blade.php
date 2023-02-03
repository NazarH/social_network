@extends('layouts.auth_form')
@section('content')
    <div class="container">
        <div class="groups-create">
            <div class="groups-create__h">
                Group Create Form
            </div>
            <form action='{{route('groups.store')}}' method="post" class="groups-create__form">
                @csrf
                <div>
                    <input type="text" placeholder="Group Name" name="name" value="{{old('name')}}">
                </div>
                @error('name')
                    <p class="error-message error-group">{{$message}}</p>
                @enderror
                <div>
                    <textarea id="" cols="30" rows="10" placeholder="Description" name="description">{{trim(old('description'))}}</textarea>
                </div>
                @error('description')
                    <p class="error-message error-group">{{$message}}</p>
                @enderror

                <div class="groups-create-radio">
                    <div class="first">
                        Community type:
                    </div>
                    <div class="second">
                        <div>
                            Open<input type="radio" value="open" name="type">
                        </div>
                        <div>
                            Close<input type="radio" value="close" name="type">
                        </div>
                    </div>
                </div>
                @error('type')
                    <p class="error-message error-group">{{$message}}</p>
                @enderror
                <div class="groups-create__btn">
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
