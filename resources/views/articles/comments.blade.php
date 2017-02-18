@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        @forelse($article->comments as $comment)
                            <h4>{{$comment->user->name}}</h4>
                            <p>{{$comment->comment}}</p><br>
                        @empty
                            Aucun commetaires
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection