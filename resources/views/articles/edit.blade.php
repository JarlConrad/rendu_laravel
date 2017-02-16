@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Contactez-moi</div>
                    @if(Auth::check())
                    <div class="panel-body">
                        {!! Form::open(['route' => ['article.update', $id], 'files' => true, 'method' => 'put', 'class'=>'register-form']) !!}
                        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                            {!! Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Titre de l\'article : ']) !!}
                            {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
                            {!! Form::textarea('content', $article->content, ['class' => 'form-control', 'placeholder' => 'Contenu de l\'article : ']) !!}
                            {!! $errors->first('content', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('image_path') ? 'has-error' : '' !!}">
                            {!! Form::label('image_path', 'Illustration de l\'article : ') !!}
                            {!! Form::file('image_path') !!}
                            <img src="{{ asset('/images/'.$article->image_path) }}" alt="">
                            {!! $errors->first('image_path', '<small class="help-block">:message</small>') !!}
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