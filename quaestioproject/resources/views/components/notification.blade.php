<article class="uk-comment questionAnswer questionAnswerWraper">
    <header class="uk-comment-header questionHeader">
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
                <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                    <li>{{date("F j, Y, g:i a",$one->dateAnswered)}}</li>
                </ul>
            </div>
        </div>
    </header>
    <div class="uk-comment-body answer uk-margin-remove-bottom">
        <div class="uk-margin">
            <p class="notification uk-margin-remove"> <a href="{{route('user.show', $one->userTo_id)}}"> {{$one->userTo}} </a> has answered on your question <span class="uk-text-italic">'{{$one->question}}'</span> <a title="See question" href="#" data-id="{{$one->answer_id}}" class="viewLink"> &nbsp;&nbsp;<i class="fas fa-eye"></i></a> </p>
        </div>
    </div>
    <div id="novo"></div>
</article>
