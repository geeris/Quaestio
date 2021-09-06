@extends('layouts.layout')
@section('content')

    <div class="uk-container">
        <a href="{{route('userQuestions')}}" class="goBack"> <span class="uk-margin-small-right iconGoBack" uk-icon="icon: arrow-left; ratio: 2"></span> Go back </a>
    </div>
    <div class="uk-container firstHeight">
        <div class="registerForm profileBlock">
            <form action="{{route('answerOnQuestionInsert', ['id' => $oneQuestion->question_id, 'id2' => $oneQuestion->userTo_id])}}" method="post">
                @csrf
                @method('put')
                <div class="uk-margin">
    {{--                <p class="classLabel">{{$oneQuestion->text}}</p>--}}
                    <p class="classLabel"> {{$oneQuestion->text}} &nbsp; @if($userFrom != null)<a href="{{route('user.show', $oneQuestion->userFrom_id)}}" class="userFrom">({{$userFrom}})</a>@endif </p>
                    <textarea class="uk-textarea classTextarea" name="answer" rows="3" id="form-stacked-text"></textarea>
                </div>

                <input type="submit" class="fullLinkButton" value="Answer" />
            </form>
        </div>
    </div>

@endsection
