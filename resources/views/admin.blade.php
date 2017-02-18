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
                                <a href="{{route('article.show', ['id' => $article->id])}}"> {!! Form::open(['route' => ['article.destroy', $article], 'method' => 'delete']) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                                    {!! Form::close() !!} Voir les commentaires</a>
                            </div><br>
                            @include('components.share', [
                                  'url' => $url,
                                  'description' => 'Partagez !',
                                  'image' => 'http://placehold.it/300x300?text=Cool+link'
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
@endsection