<div class="uk-container-expand footerContainer">
    <div class="uk-flex uk-flex-around responsiveFlexFooter">
        <ul class="uk-list">
            @if($footerLinks != null)
            <h6 class="titleFont footerTitle"><span class="firstLetter">
                            F</span>ind us on</h6>

                @foreach($footerLinks as $one)
                    <li><a target="_blank" class="footerLinks" href="{{$one->route}}"> {{$one->name}} </a></li>
                @endforeach
            @endif
        </ul>
        <ul class="uk-list additionalLinks uk-margin-remove">
            @if($additionalLinks != null)
            <h6 class="titleFont footerTitle"><span class="firstLetter">
                            A</span>dditional links</h6>
                @foreach($additionalLinks as $one)
                    @if($one->name=='Author')
                        <li><a href="{{route($one->route)}}" class="footerLinks"> {{$one->name}} </a></li>
                    @elseif($one->name=='Documentation')
                        <li><a target="_blank" href="{{asset('assets/'.$one->route)}}" class="footerLinks"> {{$one->name}} </a></li>
                    @else
                    @endif
                @endforeach
            @endif
    </ul>
    </div>
    <p class="uk-text-center"> Copyright © Gabrijela Matović 2021 </p>
</div>
