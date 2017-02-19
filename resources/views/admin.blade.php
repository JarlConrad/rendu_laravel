@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    <div class="panel-body">

                        @forelse($articles as $article)
                            <div>
                                <h2>{{$article->title}}</h2>
                                <ul class="nav nav-tabs">
                                    <li  class="active"><a data-toggle="tab" href="#home">Commentaire : </a> </li>
                                    @forelse($article->comments as $comment)
                                        <li><a data-toggle="tab" href="#{{$comment->id}}">{{$comment->user->name}}</a></li>
                                    @empty
                                        <p>Aucun Commentaire</p>
                                    @endforelse
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                    </div>
                                    @forelse($article->comments as $comment)
                                        <div id="{{$comment->id}}" class="tab-pane fade">
                                            {!! Form::open(['route' => ['commentaire.destroy', $comment->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Supprimer le commentaire', ['class' => 'button_de_co btn btn-danger pull-right']) !!}
                                            {!! Form::close() !!}
                                            <h3>{{$comment->user->name }}</h3>
                                            <p>{{$comment->comment}}</p>

                                        </div>
                                    @empty
                                        <p>Aucun commentaire</p>
                                    @endforelse
                                </div>
                                    {!! Form::open(['route' => ['article.show', $article->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Voir l\'article ', ['class' => 'button_de_co btn btn-info pull-right']) !!}
                                    {!! Form::close() !!}

                                    {!! Form::open(['route' => ['admin.destroy', $article], 'method' => 'delete']) !!}
                                        {!! Form::submit('Supprimer l\'article', ['class' => 'button_de_co btn btn-danger pull-right']) !!}
                                    {!! Form::close() !!}
                            </div><br>
                            @include('components.share', [
                                     'url' => request()->fullUrl(),
                                    ])
                        @empty
                            <p>Rien, aucun article n'a été trouvé</p>
                        @endforelse
                        <div class="text-center">
                            {{$articles->links()}}
                        </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection