@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>

                    <div class="panel-body">

                        <div class="row">
                            @forelse($articles as $article)

                                <div class="col-sm-6 col-md-4 article">
                                    <div class="thumbnail">
                                        <img src="{{$article->image_path}}">
                                        <div class="caption">
                                            <h3>{{$article->title}}</h3>
                                            <p class="txt">{{$article->content}}</p>
                                            <p><a href="{{route('article.show', ['id' => $article->id])}}" class="btn btn-primary" role="button">Voir l'article</a></p>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <p>Rien, aucun article n'a été trouvé</p>
                            @endforelse
                        </div>
                        <div class="text-center">
                            {{$articles->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection