@extends('layouts.app')

@section('content')

    <div>
{{--        {{$rent}}--}}
        <ul>
        @foreach($rent as $loc)
            <li>vehicle : {{$loc->name}}, date: {{$loc->pivot->started_at}} to {{$loc->pivot->ended_at}}
                @if(strtotime('now') < strtotime($loc->pivot->ended_at))
                    <button class="btn btn-info"><a href="{{ route('user.rent.display.add', $loc->pivot->id) }}" class="text-white">Allonger la reservation</a></button>
                @endif
            </li>
        @endforeach

        </ul>
    </div>
@endsection
