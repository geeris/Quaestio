@extends('layouts.layout')
@section('content')

    <div class="uk-container firstHeight">
        <form class="uk-search uk-search-default searchDesign">
            <span uk-search-icon></span>
            <input class="uk-search-input" autocomplete="off" id="search" type="search" placeholder="Search">
            <div class="uk-position-absolute searchResults" id="searchResult">

            </div>
        </form>

    @if(!$answeredQuestionsOfAllUsers->isEmpty())
        @foreach($answeredQuestionsOfAllUsers as $one)
            @component('components/answeredQuestion', ['one' => $one, 'image' => true, 'username' => true, 'userFrom' => $userFrom->userFrom[$loop->index][$loop->index]])
            @endcomponent
        @endforeach
        @else
            @component('components.noRecords', ['message' => 'There is no record of any answer so far.'])
            @endcomponent
    @endif
    </div>

@endsection
