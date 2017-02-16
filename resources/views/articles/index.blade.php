@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                            @forelse($articles as $article)
                                <div>
                                <h2>{{$article->title}}</h2>
                                <p>{{$article->content}}</p>
                                    <a href="{{route('article.show', ['id' => $article->id])}}">Voir l'article</a>
                                </div><br>
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