@extends('layouts.layout')

@section('content')

<div class="uk-container">
    <a href="{{route('goBack')}}" class="goBack"> <span class="uk-margin-small-right iconGoBack" uk-icon="icon: arrow-left; ratio: 2"></span> Go back </a>
    <div class="registerForm">
{{--        <h2 class="titleFont"> Register form </h2>--}}

        <form class="uk-form-stacked" method="post" action="{{route('user.store')}}">
            @csrf
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="username" id="form-stacked-text" type="text">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">E-mail</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="email" id="form-stacked-text" type="text">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="password" id="form-stacked-text" type="password">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-form-label">Gender</div>
                <div class="uk-form-controls">
                    @foreach($genderList as $one)
                        <label><input class="uk-radio" type="radio" value="{{$one->id}}" name="gender">{{$one->name}}</label><br/>
                    @endforeach
                </div>
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

            <input type="submit" class="fullLinkButton logInSpecial" value="Sign up" />

        </form>

    </div>
</div>

@endsection
