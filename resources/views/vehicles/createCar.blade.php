<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Ajout d'un véhicule</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach        </ul>
    </div>
@endif

<form method='POST' action='{{route('vehicle.store')}}'>
    @csrf
    <label>Marque (id)</label>
    <select name='brand_id'>
        @foreach ($brands as $brand)
            <option value='{{$brand->id}}'>{{$brand->name}}</option>
        @endforeach
    </select><br/>
    <label for="name">Modèle</label><input type='text' name='name' id="name"/><br/>
    <label for="price">Prix</label><input type='text' name='price' id="price"/><br/>
    <label for="status">Statut</label><input type='text' name='status' id="status"/><br/>
    <label for="odometer">Km</label><input type='text' name='odometer' id="odometer"/><br/>
    <label for="type">Type</label><input type='text' name='type' id="type"/><br/>
    <button type='submit'>Enregistrer</button>
</form>
</body>
</html>
