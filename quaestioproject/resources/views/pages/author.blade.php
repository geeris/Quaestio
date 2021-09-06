@extends('layouts.layout')

@section('content')
    <div class="uk-container">
        <a href="{{route('goBack')}}" class="goBack"> <span class="uk-margin-small-right iconGoBack" uk-icon="icon: arrow-left; ratio: 2"></span> Go back </a>

        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div>
                {{--        uk-height-viewport--}}
                <img src="{{asset('assets/img/author.jpg')}}" class="authorImage" />
            </div>
            <div class="uk-padding-large">

                <p class="uk-text-center">Gabrijela Matović 21/18</p>

            </div>
        </div>
    </div>

@endsection
