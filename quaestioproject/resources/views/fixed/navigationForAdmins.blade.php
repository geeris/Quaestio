<div class="holdMenuButton">
    <a href="#offcanvas-slide" class="uk-button uk-button-default uk-align-right menuButton" uk-icon="menu" uk-toggle></a>
</div>

<div id="offcanvas-slide" uk-offcanvas>
    <div class="uk-offcanvas-bar">
        <h2 class="titleFont changeSizeAdmin"> {{session()->get('user')->username}} </h2>

        <ul class="uk-nav uk-nav-default">
            @foreach($adminMenu as $one)
                <li><a href="{{route($one->route)}}"><span uk-icon="icon: {{$one->icon}}" class="menuIcon"></span>{{$one->name}}</a></li>
            @endforeach
        </ul>

    </div>
</div>
