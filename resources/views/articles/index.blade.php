@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if(Auth::check())
                            <h1>MDR t'es bien co ma couille</h1>
                            @forelse($articles as $article)
                                <div>
                                <h2>{{$article->title}}</h2>
                                <p>{{$article->content}}</p>
                                </div><br>
                            @empty
                                <p>Rien, aucun article n'a été trouvé</p>
                            @endforelse
                            <div class="text-center">
                                {{$articles->links()}}
                            </div>
                        @else
                            <p>Alors, on a pas de compte ?</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection