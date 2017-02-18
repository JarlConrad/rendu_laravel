@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Contactez nous</h1>

        {!! Form::open(['route'=>'contact.store']) !!}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('Name:') !!}
            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Entrez votre nom']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('Email:') !!}
            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Entrez votre Email']) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
            {!! Form::label('Message:') !!}
            {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Entrez votre message']) !!}
            <span class="text-danger">{{ $errors->first('message') }}</span>
        </div>

        <div class="form-group">
            <button class="btn btn-info">Contactez nous !</button>
        </div>

        {!! Form::close() !!}

    </div>
@endsection