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
                                    @if($article->user)
                                        <h3>Auteur : {{$article->user->name}}</h3>
                                    @endif
                                </div><br>
                        @if(Auth::check() && Auth::user()->isAdmin == true)
                            {!! Form::open(['route' => ['article.destroy', $id], 'method' => 'delete']) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection