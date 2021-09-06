@extends('layouts.layoutAdmin')

@section('content')

    <div class="uk-container firstHeight">
        <a href="{{route('starterQuestion.index')}}" class="goBack"> <span class="uk-margin-small-right iconGoBack" uk-icon="icon: arrow-left; ratio: 2"></span> Go back </a>
        <div class="registerForm">
            {{--        <h2 class="titleFont"> Register form </h2>--}}

            <form class="uk-form-stacked" method="post" action="{{route('starterQuestion.update', $question->id)}}">
                @csrf
                @method('put')
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Edit starter question</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="question" value="{{$question->text}}" id="form-stacked-text" type="text">
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

                <input type="submit" class="fullLinkButton" value="Save" />

            </form>

        </div>
    </div>

@endsection
