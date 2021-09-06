@if(session()->has('user'))
    <div class="uk-container-expand userMenu proba">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-center userMenuBackground">
                <div class="uk-navbar-center">
                        <ul class="uk-navbar-nav">


                            @if(isset($userMenu))
                                @foreach($userMenu as $one)
                                    @if($one->name == 'Profile')
                                        <li><a href="{{route($one->route, session()->get('user')->id)}}"> <span uk-icon="icon: {{$one->icon}}" class="menuIcon"></span> </a></li>
                                    @elseif($one->name == 'Questions')
                                        <li>
                                            <a href="{{route($one->route)}}">
                                                <span uk-icon="icon: {{$one->icon}}" class="menuIcon"></span>
                                                <span class="uk-badge firstb">{{session()->get('questionNumber')}}</span>
                                            </a>
                                        </li>
                                    @elseif($one->name == 'Notifications')
                                        <li>
                                            <a href="{{route($one->route)}}">
                                                <span uk-icon="icon: {{$one->icon}}" class="menuIcon"></span>
                                                <span class="uk-badge secondb">{{session()->get('notificationNumber')}}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li><a href="{{route($one->route)}}"> <span uk-icon="icon: {{$one->icon}}" class="menuIcon"></span> </a></li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                </div>

            </div>
        </nav>
    </div>
@endif
