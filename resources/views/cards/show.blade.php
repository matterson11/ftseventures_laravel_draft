@extends('layout')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    {{ $card -> title }}
                </h1>
                <ul>
                    @foreach($card->notes as $note)
                        <li class="list-group-item">
                            {{ $note->body }}
                            <a href="#">{{ $note->user->username }}</a>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <h3> Add New Note </h3>
                <form method="POST" action="/cards/{{ $card->id }}/notes">
                    <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" name="body">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Add Note</button>
                    </div>
                </form>

                @if(count($errors))
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
@stop