@extends('layouts.layout')

@section('content')
    <div class="uk-container firstHeight">
        @if(!$notifications->isEmpty())
            @foreach($notifications as $one)
                @component('components.notification', ['one' => $one])
                @endcomponent
            @endforeach
        @else
            @component('components.noRecords', ['message' => 'You have not recieved any notification yet.'])
            @endcomponent
        @endif
    </div>

    <div id="modalNotification" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog uk-modal-body notificationModal">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div id="notification">
            </div>
        </div>
    </div>

@endsection
