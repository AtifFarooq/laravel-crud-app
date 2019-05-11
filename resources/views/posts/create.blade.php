@extends('layouts.app')

@section('content')
    <h1>Create New Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textArea('body', '', ['class' => 'form-control', 'placeholder' => 'Post body text'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection()