@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                                <div>
                                    <h2>{{$article->title}}</h2>
                                    <p>{{$article->content}}</p>
                                    <img src="../images/{{$article->image_path}}" alt="">
                                    @if($article->user)
                                        <h3>Auteur : {{$article->user->name}}</h3>
                                    @endif
                                </div><br>
                        @if(Auth::check() && Auth::user()->isAdmin == true)
                            {!! Form::open(['route' => ['article.destroy', $id], 'method' => 'delete']) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                            {!! Form::close() !!}
                        @endif

                        @if(Auth::check())
                            <div class="panel-body">
                                {!! Form::open(['route' => 'like.store', 'method' => 'post', 'class'=>'register-form']) !!}
                                {{ Form::hidden('article_id', $article->id) }}
                                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                                {!! Form::close() !!}
                            </div>
                        @else
                            <p>Vous devez être connécté pour aimer</p>
                        @endif

                        @if(Auth::check())
                            <div class="panel-body">
                                {!! Form::open(['route' => 'commentaire.store', 'files' => true, 'method' => 'post', 'class'=>'register-form']) !!}
                                <div class="form-group {!! $errors->has('comment') ? 'has-error' : '' !!}">
                                    {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Votre commentaire : ']) !!}
                                    {!! $errors->first('comment', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-group {!! $errors->has('comment_img') ? 'has-error' : '' !!}">
                                    {!! Form::label('comment_img', 'Illustration du commentaire : ') !!}
                                    {!! Form::file('comment_img') !!}
                                    {!! $errors->first('comment_img', '<small class="help-block">:message</small>') !!}
                                </div>
                                {{ Form::hidden('article_id', $article->id) }}
                                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                                {!! Form::close() !!}
                            </div>
                        @else
                            <p>Vous devez être connécté pour écrire un commentaire</p>
                        @endif

                        @forelse($article->comments as $comment)
                            <h4>{{$comment->user->name}}</h4>
                            <p>{{$comment->comment}}</p><br>
                            @if($comment->user_id == Auth::user()->id)
                            {!! Form::open(['route' => ['commentaire.edit', $comment->id], 'method' => 'get']) !!}
                                {!! Form::submit('Editer', ['class' => 'btn btn-info pull-right']) !!}
                            {!! Form::close() !!}
                                {!! Form::open(['route' => ['commentaire.destroy', $comment->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-info pull-right']) !!}
                                {!! Form::close() !!}
                            @endif
                        @empty
                            Rien
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection