<article class="uk-comment questionAnswer questionAnswerWraper">
    <header class="uk-comment-header questionHeader">
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            @if($image)
                <div class="uk-width-auto">
                    <img class="uk-comment-avatar" src="{{asset('storage/products/'.$one->image)}}" alt="{{$one->userTo}}">
                </div>
            @endif
            <div class="uk-width-expand">
                @if($username)
                    <p class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="{{route('user.show', $one->userTo_id)}}"> @if(session()->get('user')->username == $one->userTo) You @else{{$one->userTo}}@endif </a></p>
                @endif
                <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                    <li>{{date("F j, Y, g:i a",$one->dateAnswered)}}</li>
                </ul>
            </div>
            @if(session()->get('user')->id != $one->userTo_id)
               <a href="#" title="Report question"><i class="fas fa-flag reportLink"></i></a>
            @else
                <a href="#" data-id="{{$one->answer_id}}" class="deleteLink" title="Delete" uk-icon="icon: trash"></a>
            @endif
        </div>
    </header>
    <div class="uk-comment-body answer uk-margin-remove-bottom">

        <p class="question"> {{$one->question}} &nbsp; @if($userFrom != null)<a href="{{route('user.show', $one->userFrom_id)}}" class="userFrom">({{$userFrom}})</a>@endif </p>
        <p class="uk-margin-remove-top"> {{$one->answer}} </p>
    </div>
{{--    <div class="options">--}}
{{--        <ul class="uk-flex uk-margin-remove uk-flex-around">--}}
{{--            <a href="#" uk-icon="heart" class="optionLinks"> Like</a>--}}
{{--            <a href="#" uk-icon="ban" class="optionLinks"> report</a>--}}
{{--        </ul>--}}
{{--    </div>--}}
</article>


