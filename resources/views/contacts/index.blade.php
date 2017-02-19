@extends('layouts.app')

@section('content')

    <div class="container">
        @forelse($contacts as $contact)
            <div>
                <h2>{{$contact->user->name}}</h2>
                <h2>{{$contact->user->email}}</h2>
                <p>{{$contact->message}}</p>
                {!! Form::open(['route' => ['contact.destroy', $contact->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right']) !!}
                {!! Form::close() !!}
            </div><br>
        @empty
            <p>Rien, aucun message n'a été trouvé</p>
        @endforelse
        <div class="text-center">
            {{$contacts->links()}}
        </div>

    </div>
@endsection