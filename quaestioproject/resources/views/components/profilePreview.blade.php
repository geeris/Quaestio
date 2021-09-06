    <div class="uk-flex uk-padding-remove uk-margin-remove-bottom uk-flex-around profileBlock">
        <div class="info">
            <div class="usernameImage">
                <img class="profileImage infop1" src="{{asset('storage/products/'.$profile->image)}}" alt="{{$profile->username}}" />
            </div>
            <p class="infop1"> {{$profile->username}} </p>

            <p class="infop1"> @if($profile->country) <span uk-icon="location"></span> @endif {{$profile->country}}  </p>
            <p class="infop1"> {{$profile->age}} @if($profile->age) | @endif  <i class="{{$profile->icon}} {{$profile->colour}} genderIconProfile"></i> </p>
        </div>

        <ul class="info">
            @if(isset($profile->firstname))
                <li>
                    <p class="infotitle"> Full name</p>  {{$profile->firstname}} {{$profile->lastname}}
                </li>
            @endif
            @if($email)
                <li>
                    <p class="infotitle"> E-mail </p>  {{$profile->email}}
                </li>
            @endif
            <li>
                <p class="infotitle"> Answers </p> {{count($answeredQuestionsOfUser)}}
            </li>
            @if(isset($profile->description))
                <li>
                    <p class="infotitle"> Description </p> {{$profile->description}}
                </li>
            @endif
        </ul>
    </div>
