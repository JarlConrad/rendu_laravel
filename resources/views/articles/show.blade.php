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
                                <div>
                                    <h2>{{$article->title}}</h2>
                                    <p>{{$article->content}}</p>
                                    @if($article->user)
                                        <h3>Auteur : {{$article->user->name}}</h3>
                                    @endif
                                </div><br>
                        @else
                            <p>Alors, on a pas de compte ?</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection