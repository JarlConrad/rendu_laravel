<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@extends('layouts.app')

@section('content')
    <div class="container un_article">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ route('article.index') }}">Retour</a></div>
                    <div class="panel-body">
                            <!-- Affichage de l'article -->

                                <div>
                                    @if($article->image_path != null)
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <h2>{{$article->title}}</h2>
                                                <p>{{$article->content}}</p>
                                                <h3>Auteur : {{$article->user->name}}</h3>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <h4>Partage :</h4>
                                                        @include('components.share', [
                                                        'url' => request()->fullUrl(),
                                                       ])
                                                    </div>
                                                    <div class="col-xs-8 zone_like">
                                                        @forelse($article->likes as $like)
                                                            @if($loop->last)
                                                                <div class="col-md-6 likes">{{$loop->count}} J'aimes</div>
                                                            @endif
                                                        @empty
                                                            <div class="col-md-6 likes">Aucun J'aimes</div>
                                                        @endforelse

                                                        @if(Auth::check())


                                                            @if($a_aime == true)
                                                                {!! Form::open(['route' => ['like.destroy', $le_like], 'method' => 'delete']) !!}
                                                                    {{ Form::hidden('article_id', $article->id) }}
                                                                    {!! Form::submit('Je n\'aime plus', ['class' => 'btn btn-info pull-right col-md-6']) !!}
                                                                {!! Form::close() !!}
                                                            @else
                                                                {!! Form::open(['route' => 'like.store', 'method' => 'post', 'class'=>'register-form']) !!}
                                                                    {{ Form::hidden('article_id', $article->id) }}
                                                                    {!! Form::submit('J\'aime', ['class' => 'btn btn-info pull-right col-md-6']) !!}
                                                                {!! Form::close() !!}
                                                            @endif


                                                        @else
                                                            <p>Vous devez être connécté pour aimer</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Supression et edition de l'article (Si co et apartient) -->
                                                <ul class="boutons">
                                                    @if(Auth::check() && (Auth::user()->id == $article->user_id || Auth::user()->isAdmin == true))
                                                        <li>
                                                            {!! Form::open(['route' => ['article.edit', $id], 'method' => 'get']) !!}
                                                            {!! Form::submit('Editer', ['class' => 'btn btn-info ']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                        <li>
                                                            {!! Form::open(['route' => ['article.destroy', $id], 'method' => 'delete']) !!}
                                                            {!! Form::submit('Supprimer cette article', ['class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <img class="img_article" src="../images/articles/{{$article->image_path}}" alt="">
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-xs-12 ss_img_art">
                                                <h2>{{$article->title}}</h2>
                                                <p>{{$article->content}}</p>
                                                <h3>Auteur : {{$article->user->name}}</h3>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6">
                                                        <h4>Partage :</h4>
                                                        @include('components.share', [
                                                        'url' => request()->fullUrl(),
                                                       ])
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 zone_like">
                                                        @forelse($article->likes as $like)
                                                            @if($loop->last)
                                                                <div class="col-md-6 likes">{{$loop->count}} J'aimes</div>
                                                            @endif
                                                        @empty
                                                            <div class="col-md-6 likes">Aucun J'aimes</div>
                                                        @endforelse

                                                        @if(Auth::check())


                                                            @if($a_aime == true)
                                                                {!! Form::open(['route' => ['like.destroy', $le_like], 'method' => 'delete']) !!}
                                                                {{ Form::hidden('article_id', $article->id) }}
                                                                {!! Form::submit('Je n\'aime plus', ['class' => 'btn btn-info pull-right']) !!}
                                                                {!! Form::close() !!}
                                                            @else
                                                                {!! Form::open(['route' => 'like.store', 'method' => 'post', 'class'=>'register-form']) !!}
                                                                {{ Form::hidden('article_id', $article->id) }}
                                                                {!! Form::submit('J\'aime', ['class' => 'btn btn-info pull-right']) !!}
                                                                {!! Form::close() !!}
                                                            @endif


                                                        @else
                                                            <p>Vous devez être connécté pour aimer</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Supression et edition de l'article (Si co et apartient) -->
                                                <ul class="boutons">
                                                    @if(Auth::check() && (Auth::user()->id == $article->user_id || Auth::user()->isAdmin == true))
                                                        <li>
                                                            {!! Form::open(['route' => ['article.edit', $id], 'method' => 'get']) !!}
                                                            {!! Form::submit('Editer', ['class' => 'btn btn-info ']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                        <li>
                                                            {!! Form::open(['route' => ['article.destroy', $id], 'method' => 'delete']) !!}
                                                            {!! Form::submit('Supprimer cette article', ['class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                </div><br>


                    <!-- Création commentaire de l'article (Si co) -->
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

                    <!--Liste de commentaire -->

                        @forelse($article->comments as $comment)
                            <div class="row un_commentaire">
                                @if($comment->comment_img != null)
                                    <div class="col-xs-6">
                                        <h4>{{$comment->user->name}}</h4>
                                        <p>{{$comment->comment}}</p><br>
                                    </div>
                                    <div class="col-xs-3">
                                        <img class="img_comment" src="../images/comments/{{$comment->comment_img}}" alt="">
                                    </div>
                                    <ul class="col-xs-3 boutons">
                                        @if(Auth::check() && $comment->user_id == Auth::user()->id)
                                            <li>
                                                {!! Form::open(['route' => ['commentaire.edit', $comment->id], 'method' => 'get']) !!}
                                                {!! Form::submit('Editer', ['class' => 'btn btn-info pull-right']) !!}
                                                {!! Form::close() !!}
                                            </li>
                                            <li>
                                                {!! Form::open(['route' => ['commentaire.destroy', $comment->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                                                {!! Form::close() !!}
                                            </li>
                                        @endif
                                    </ul>
                                @else
                                    <div class="col-xs-9">
                                        <h4>{{$comment->user->name}}</h4>
                                        <p>{{$comment->comment}}</p><br>
                                    </div>
                                    <ul class="col-xs-3 boutons">
                                        @if(Auth::check() && $comment->user_id == Auth::user()->id)
                                            <li>
                                                {!! Form::open(['route' => ['commentaire.edit', $comment->id], 'method' => 'get']) !!}
                                                    {!! Form::submit('Editer', ['class' => 'btn btn-info pull-right']) !!}
                                                {!! Form::close() !!}
                                            </li>
                                            <li>
                                                {!! Form::open(['route' => ['commentaire.destroy', $comment->id], 'method' => 'delete']) !!}
                                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                                                {!! Form::close() !!}
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>

                        @empty
                            <p>Aucun commentaire</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection