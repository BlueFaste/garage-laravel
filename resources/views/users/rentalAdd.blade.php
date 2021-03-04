@extends('layouts.app')

@section('content')
{{--	{{$id}}--}}
{{--	{{$vehicle}}--}}
{{--	{{now()}}--}}

	<form action="{{ route('user.rent.add', $id) }}" method="POST">
        @method('PUT')
		@csrf
		<label for="">Ajouter des jours à votre reservation :</label>
		<input type="number" name="numberDay">
		<input class="btn btn-success" type="submit" value="Ajouter des jours">
        <br>
        <label for="">Modifier la date de fin de réservation</label>
        <input type="date" name="newDate" value="{{date('Y-m-d', strtotime($vehicle->ended_at))}}" min="{{date('Y-m-d', strtotime(now()))}}">
        <input class="btn btn-primary" type="submit" value="Modifier la date de fin">


    </form>

@endsection
