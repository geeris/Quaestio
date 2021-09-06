@extends('layouts.layout')

@section('content')
    <div class="uk-container">
        <a href="{{route('user.show', session()->get('user')->id)}}" class="goBack"> <span class="uk-margin-small-right iconGoBack" uk-icon="icon: arrow-left; ratio: 2"></span> Go back </a>
        <div class="registerForm">
            {{--        <h2 class="titleFont"> Register form </h2>--}}

            <form class="uk-form-stacked" method="post" enctype="multipart/form-data" action="{{route('user.update', $profile->id)}}">
                @method('put')
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">First name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="firstname" value="{{$profile->firstname}}" id="form-stacked-text" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Last name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="lastname" value="{{$profile->lastname}}" id="form-stacked-text" type="text">
                    </div>
                </div>

                <div class="uk-margin" uk-margin>
                    <div uk-form-custom="target: true">
                        <input type="file" name="image">
                        <input class="uk-input uk-form-width-medium" name="image" type="text" placeholder="Select new profile image" disabled>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Age (12-62)</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" value="{{$profile->age}}" name="age" min="12" max="62" id="form-stacked-text" type="number">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">Gender</div>
                    <div class="uk-form-controls">
                        @foreach($genderList as $one)
                                <label><input class="uk-radio" type="radio" @if($one->id == $profile->name) checked @endif value="{{$one->id}}" name="gender_id">{{$one->name}}</label><br/>
                        @endforeach
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Country</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="country" value="{{$profile->country}}" id="form-stacked-text" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Description</label>
                    <textarea class="uk-textarea" name="description" rows="3" id="form-stacked-text">{{$profile->description}}</textarea>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="errors">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="resultMessage">{{session()->get('message')}}</p>

                @if(session()->has('message'))



                    @php
                        session()->forget('message');
                    @endphp
                @endif

                <input type="submit" class="fullLinkButton logInSpecial" value="Save changes" />

            </form>

        </div>
    </div>

@endsection
