@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ route('article.index') }}">Retour</a></div>

                    <div class="panel-body">
                        <h1>{{$user->name}}</h1>
                        <p>Crée le : {{$user->created_at}}</p>
                        <p>Email : {{$user->email}}</p>
                        @forelse($user->articles as $article)
                            <h2>{{$article->title}}</h2>
                            <p><a href="{{route('article.show', ['id' => $article->id])}}" class="btn btn-primary" role="button">Voir l'article</a></p>
                        @empty
                            <p>Aucun article trouvé</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection