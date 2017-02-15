@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        {{Auth::user()->name}}<br>
                        {{Auth::user()->created_at}}<br>
                        {{Auth::user()->email}}
                        @forelse(Auth::user()->articles as $article)
                            <h2>{{$article->title}}</h2>
                        @empty
                            <p>Aucun article recencé</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection