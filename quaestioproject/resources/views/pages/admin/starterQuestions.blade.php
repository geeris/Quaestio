@extends('layouts.layoutAdmin')
@section('content')

    <div class="uk-overflow-auto uk-margin-remove firstHeight">
        <table class="uk-table uk-table-striped uk-margin-large-top">
            <thead>
            <tr>
                <th>Question</th>

                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <form action="{{route('starterQuestion.store')}}" method="post">
                    @csrf
                    <td>
                        <input class="uk-input" type="text" name="starterQuestion" />
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="errors">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <input class="fullLinkButton" type="submit" value="Add" />
                    </td>
                </form>
            </tr>

            @foreach($starterQuestions as $one)
                <tr>
                    <td>{{$one->text}}</td>

                    <td>
                        <form action="{{route('starterQuestion.edit', $one->id)}}" method="get">
                            @csrf
{{--                            @method('delete')--}}
                            <input class="fullLinkButton" type="submit" value="Edit" />
                        </form>
{{--                        <a class="uk-button uk-button-default" href="{{route('starterQuestion.update',$one->id)}}">Edit</a>--}}
                    </td>
                    <td>
                        <form action="{{route('starterQuestion.destroy', $one->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="fullLinkButton" type="submit" value="Delete" />
                        </form>
{{--                        <a class="uk-button uk-button-default" href="{{route('starterQuestion.destroy',$one->id)}}">Delete</a>--}}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>

@endsection
