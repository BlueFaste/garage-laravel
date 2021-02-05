@extends('layouts.app')

@section('content')
    <div class="d-flex">

        <div class="col-lg-3">
            <div class="card mb-5" style="width: 18rem;">
                <img class="card-img-top" src="https://cdn.pixabay.com/photo/2012/11/02/13/02/car-63930_1280.jpg"
                     alt="Card image cap">
                <div class="card-body">
                    <p><span>{{ $vehicle->name }}</span> <span>{{ $vehicle->brand->name }}</span> {{$vehicle->type}}</p>
                    <p>{{ $vehicle->odometer }} Km - {{ $vehicle->price }} €/jour</p>
                    @if(count($userVehicle)>0)
                    <p class="bg-warning">La voiture n'est pas disponible :</p>
                    @foreach($userVehicle as $uv)
                        <p class="text-danger">----------------</p>
                        <p class="bg-warning"> du {{$uv->started_at}}</p>
                        <p class="bg-warning">au {{$uv->ended_at}}</p>
                    @endforeach
                    @else
                        <p class="bg-success text-white">La voiture est disponible sur n'importe quelle date</p>

                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            @if(\Illuminate\Support\Facades\Auth::id())
                <div class="card mb-5" style="width: 18rem;">
                    <div class="card-body">
                        Votre porte monnaie : {{$user->wallet}} €
                    </div>
                </div>
            @endif
            <div class="card mb-5" style="width: 18rem;">
                <form method="POST" action=" {{ route('vehicle.price') }}">
                    @csrf
                    <label for="dateStart">date de debut de la location</label>
                    @if(!$dateStart)
                        <input type="date" min="{{ date('Y-m-d') }}" name="dateStart" id="dateStart" required> <br/>
                    @else
                        <input type="date" min="{{ date('Y-m-d') }}" name="dateStart" id="dateStart"
                               value="{{$dateStart}}" required> <br/>
                    @endif
                    <label for="nbDay">Durée de la location</label>
                    @if(!$nbDay)
                        <input type="number" name="nbDay" id="nbDay" min="1" required> jours
                    @else
                        <input type="number" name="nbDay" id="nbDay" min="1" value="{{$nbDay}}" required> jours
                    @endif
                    <input type="hidden" value="{{ $vehicle->id }}" name="idVehicle">
                    <button type="submit" class="btn btn-info" value="Calculer la location">Calculer la
                        location
                    </button>
                </form>
            </div>
        </div>

        @if ($price)
            <div class="col-lg-3">
                <div class="card mb-5" style="width: 18rem;">
                    @if($available)
                        prix total : {{$price}} €
                        @if (\Illuminate\Support\Facades\Auth::id() && $price < $user->wallet)
                            <p>Vous pouvez loyer ce vehicle a partir du {{$dateStart}} pour {{ $nbDay }} jours</p>

                            <form method="post" action="{{ route('vehicles.paye') }}">
                                @csrf
                                <input type="hidden" value="{{$vehicle->id}}" name="idVehicle">
                                <input type="hidden" value="{{$nbDay}}" name="nbDay">
                                <input type="hidden" value="{{$dateStart}}" name="dateStart">
                                <input type="submit" class="btn badge-success"
                                       value="Loyer le vehicule : {{ $vehicle->name }} ">
                            </form>
                        @else
                            <p class="btn btn-danger">Vous ne pouvez pas louer ce vehicule</p>
                        @endif
                    @else
                        <p class="bg-danger text-white">La voiture n'est pas disponible sur cet interval de date</p>
                    @endif
                </div>
            </div>
        @endif

    </div>

@endsection
