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
<form method='get' action='vehicles'>
    <label>Marque (id)</label>
    <select name='brand_id'>
        @foreach ($brands as $brand)
            <option value='{{$brand->id}}'>{{$brand->name}}</option>
        @endforeach
    </select><br/>
    <label>Modèle</label><input type='text' name='name'/><br/>
    <label>Prix</label><input type='text' name='price'/><br/>
    <label>Statut</label><input type='text' name='status'/><br/>
    <label>Km</label><input type='text' name='odometer'/><br/>
    <label>Type</label><input type='text' name='type'/><br/>
    <button type='submit'>Enregistrer</button>
</form>

</body>
</html>
