<div class="uk-container-expand navigationDiv">
    <div class="uk-container">
        <nav class="uk-navbar-container uk-margin uk-navbar">
{{--            @if(isset($userMenu) || (\Request::is('user/create')) || (\Request::is('author')))--}}
{{--                <div class="uk-navbar-left logoImage">--}}
{{--                    <img src="{{asset('assets/img/header.jpg')}}" />--}}
{{--                </div>--}}
{{--            @endif--}}


            <div class="uk-navbar-right">
                <h1 class="uk-margin-remove">
                    <a class="uk-navbar-item uk-logo titleFont" href="{{route('home')}}">
                        <span class="firstLetter">
                            Q</span>uaestio
                    </a>
                </h1>
            </div>
        </nav>
    </div>
</div>
