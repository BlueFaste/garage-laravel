@extends('layouts.app')

@section('content')
    <button class="btn btn-primary"><a href="{{ route('annoucement.display.store') }}" class="text-white">Ajouter une annonce</a></button>
    <ul>
        @foreach($annoucements as $annoucement)
            <li class="my-2">
                {{--            {{ $annoucement }}--}}
                <span class="text-info">id</span> : {{ $annoucement->id }}, <span class="text-info">title</span>: {{ $annoucement->title }}, <span class="text-info">content</span>: {{ $annoucement->content }},
                <span class="text-info">price</span>: {{ $annoucement->price }}, <span class="text-info">user</span>: {{ $annoucement->user->name }}
                <a href="{{ route('annoucement.show', $annoucement) }}"><button class="btn btn-success"> Voir l'article</button></a>
            </li>
        @endforeach
    </ul>
@endsection
