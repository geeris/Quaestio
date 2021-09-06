@extends('layouts.layoutAdmin')
@section('content')

    <div class="uk-overflow-auto uk-margin-remove firstHeight">
        <p class="uk-margin-left uk-margin-large-top uk-margin-bottom">Number of registered users: {{count($users)}}</p>

        <table class="uk-table uk-table-striped ">
        <thead>
        <tr>
            <th>Username</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Full name</th>
            <th>Age</th>
            <th>Country</th>
            <th>Gender</th>
            <th>Description</th>
            <th>Reported</th>
            <th>Deleted</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $one)
        <tr>
            <td>{{$one->username}}</td>
            <td>{{$one->email}}</td>
            <td>{{$one->role}}</td>

            <td>{{$one->firstname}}{{$one->lastname}}</td>
            <td>{{$one->age}}</td>
            <td> {{$one->country}}</td>
            <td>{{$one->gender}}</td>
            <td>{{$one->description}}</td>
            <td>@if($one->isReported) Yes @else No @endif </td>
            <td>@if($one->isDeleted) Yes @else No @endif</td>
            <td>{{date("F j, Y, g:i a",$one->createdAt)}}</td>
            <td>@if($one->updatedAt != null){{date("F j, Y, g:i a",$one->updatedAt)}}@endif</td>
            <td>
                <form action="{{route('user.destroy', $one->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input class="fullLinkButton" type="submit" value="Delete" />
                </form>
{{--                <a class="uk-button uk-button-default" href="{{route('user.destroy',$one->id)}}">Delete</a>--}}
            </td>
            <td>
                <form action="{{route('reportUser', ["id" => $one->id])}}" method="post">
                    @csrf
                    @method('put')
                    <input class="fullLinkButton" type="submit" value="Report" />
                </form>

            </td>
        </tr>

        @endforeach

        </tbody>
    </table>
    </div>

@endsection
