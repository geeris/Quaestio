@extends('layouts.layout')

@section('content')
    <div class="uk-container uk-position-relative firstHeight">
    @component('components.profilePreview', ['profile' => $profile, 'answeredQuestionsOfUser' => $answeredQuestionsOfUser, 'email' => false])
        @endcomponent

        @if($profile->id != session()->get('user')->id)
        <div class="registerForm profileBlock uk-margin-remove-bottom">
            <form method="post" action="{{route('sendQuestion', ['id' => session()->get('user')->id, 'id2' => $profile->id])}}">
                @csrf
                @method('put')
                <div>
                    <p class="classLabel">Ask a question</p>
                    <textarea class="uk-textarea classTextarea" name="question" rows="3" id="form-stacked-text">{{$profile->description}}</textarea>
                </div>

                <input type="submit" class="fullLinkButton uk-margin-top" value="Send" />
            </form>
        </div>
        @endif

        @if($profile->id == session()->get('user')->id)
            <a href="{{route('user.edit', $profile->id)}}" uk-icon="icon: pencil" class="uk-position-absolute editProfileIcon">Edit profile</a>
        @endif

        @if(!$answeredQuestionsOfUser->isEmpty())
            <div class="uk-container">
                @foreach($answeredQuestionsOfUser as $one)
                    @component('components/answeredQuestion', ['one' => $one, 'image' => false, 'username' => false, 'userFrom' => $userFrom->userFrom[$loop->index][$loop->index]])
                    @endcomponent
                @endforeach
            </div>
        @else
            <div class="registerForm">
                @if($profile->id == session()->get('user')->id)
                    @component('components.noRecords', ['message' => 'You have not answered on any question yet.'])
                    @endcomponent
                @else
{{--                    <article class="uk-comment questionAnswer questionAnswerWraper uk-padding-remove">--}}
{{--                        <p class="uk-margin-remove uk-padding-small"><span uk-icon="icon: info"></span> {{$profile->username}} has not answered any questions yet. </p>--}}
{{--                    </article>--}}

                    @component('components.noRecords', ['message' => 'has not answered any questions yet.', 'username' => $profile->username])
                    @endcomponent
                @endif
            </div>

        @endif
    </div>

@endsection
