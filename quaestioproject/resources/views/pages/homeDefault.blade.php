@extends('layouts.layout')

@section('content')
    <div class="uk-container">
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div>
                {{--        uk-height-viewport--}}
                <img src="{{asset('assets/img/header.jpg')}}" />
            </div>
            <div class="uk-padding-large">

                <p>Quaestio is an app made to connect you with people worldwide, get to know them better by asking a questions
                    and eventually make new friends.

                    You have a chance to learn more about other cultures, languages and people in general but also share your interests
                    and knowledge with others.
                </p>
                <div class="uk-flex uk-flex-around">
                    <a href="{{route('user.create')}}" class="fullLink"> Sign up now </a>
                    <a href="#" class="emptyLink"> Log in </a>
                </div>
            </div>
        </div>
    </div>


    {{--            MODAL            --}}
    <div id="modalLogin" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-text-left">
                <a class="uk-logo titleFont titleFontLogin uk-text-right" href="{{route('home')}}">
                <span class="firstLetter">
                    Q</span>uaestio
                </a>
            </h2>

            <form method="post" action="{{route('logUser')}}" id="logform">
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Username</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" name="username" type="text">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" name="password" type="password">
                    </div>
                </div>
            </form>
            <p class="errors">{{session()->pull('message')}}</p>
            <p class="uk-text-right">
                <div class="uk-flex uk-flex-right">
                    <button class="uk-button uk-button-default uk-modal-close emptyLinkButton" type="button">Cancel</button>
                        <input type="submit" form="logform" class="fullLinkButton logInSpecial" value="Log in" />
                </div>
            </p>
        </div>
    </div>


@endsection
