@include('welcome');

{{--{{$user}}--}}
<ul>
    <li>id :{{$user->id}}</li>
    <li>name :{{$user->name}}</li>
    <li>email :{{$user->email}}</li>
    <li>wallet :{{$user->wallet}}</li>
    <li>score :{{$user->score}}</li>

</ul>

<form method='POST' action='{{route('user.monney')}}'>
    @csrf
    <label for="addWallet">Ajouter de la moulla au porte-feuille</label>
    <input type="number" id="addWallet" name="monney"/>
    <input type="submit" value="Plus de moulaga " class="btn btn-danger">
</form>


