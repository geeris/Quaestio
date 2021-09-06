@extends('layouts.layout')
@section('content')

    <div class="uk-container firstHeight">
    @if(!$askedQuestions->isEmpty())
        @foreach($askedQuestions as $one)
            <article class="uk-comment questionAnswer questionAnswerWraper uk-padding-remove">
                <div class="uk-comment-body uk-flex uk-flex-between responsiveFlex">
                    <div>
                        @if(isset($one->userFrom_id))
                        <a href="{{route('user.show', $one->userFrom_id)}}" class="uk-margin-remove userFromClass"> {{$userFrom->userFrom[$loop->index][$loop->index]}} </a>
                        @endif
                            <p class="question uk-margin-remove answerSecond "> {{$one->text}} </p>
                    </div>

                    <div class="uk-flex answerPart">
                        <form action="{{route('answerOnQuestion', ['id' => $one->question_id, 'id2' => $one->userTo_id, 'userFrom' => $userFrom->userFrom[$loop->index][$loop->index]])}}" method="post">
                            @csrf
                            <input type="submit" class="answerIconLink fullLinkButton" value="Answer" />
                        </form>
                        <form action="{{route('question.destroy', $one->question_id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="answerIconLink emptyDeleteButton" value="Delete" />
                        </form>

{{--                        <a href="{{route('answerOnQuestion', $one->question_id)}}" class="answerIconLink" uk-icon="icon: commenting"></a>--}}
{{--                        <a href="{{route('question.destroy', $one->question_id)}}" class="answerIconLink" uk-icon="icon: trash"></a>--}}
                    </div>
                </div>
            </article>
        @endforeach
        @else
            @component('components.noRecords', ['message' => 'You have not recieved any questions yet.'])
            @endcomponent
        @endif
    </div>

@endsection
