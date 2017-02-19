@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Contactez nous</h1>

        {!! Form::open(['route'=>'contact.store']) !!}
        {{ Form::hidden('user_id', Auth::user()->id) }}
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