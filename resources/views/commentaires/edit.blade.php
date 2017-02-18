@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Contactez-moi</div>
                    @if(Auth::check())
                        <div class="panel-body">
                            {!! Form::open(['route' => ['commentaire.update', $id], 'files' => true, 'method' => 'put', 'class'=>'register-form']) !!}
                                <div class="form-group {!! $errors->has('comment') ? 'has-error' : '' !!}">
                                    {!! Form::textarea('comment', $commentaire->comment, ['class' => 'form-control', 'placeholder' => 'Votre commentaire : ']) !!}
                                    {!! $errors->first('comment', '<small class="help-block">:message</small>') !!}
                                </div>
                            <div class="form-group {!! $errors->has('comment_img') ? 'has-error' : '' !!}">
                                {!! Form::label('comment_img', 'Illustration du commentaire : ') !!}
                                {!! Form::file('comment_img') !!}
                                <img src="{{ asset('/images/comments'.$commentaire->comment_img) }}" alt="">
                                {!! $errors->first('comment_img', '<small class="help-block">:message</small>') !!}
                            </div>
                            {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection