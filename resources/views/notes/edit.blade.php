@extends('layout')


@section('content')

    <div class="container">
        <h1>Edit note</h1>

        <form method="POST" action="/notes/{{ $note->id }}">
            {{ method_field('PATCH') }}
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="body">{{ $note->body }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>

@stop