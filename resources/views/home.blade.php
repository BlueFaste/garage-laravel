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
<h1> les utilisateurs</h1>

<ul>
    @foreach($users as $user)
        <li>#{{$user->id}} {{$user->name}} (score: {{$user->score}}, porte-monnaie: {{$user->wallet}},
            role: {{$user->role}}, actif: {{$user->enabled}})
        </li>
    @endforeach
</ul>

<h1>Les marques</h1>
<ul>
    @foreach($brands as $brand)
        <li> #{{$brand->id}} {{$brand->name}} (premium: {{$brand->premium}});
            <ul>
                @foreach($brand->vehicles as $vehicle)
                    <li>#{{$vehicle->id}} {{$vehicle->name}} (type: {{$vehicle->type}}, km: {{$vehicle->odometer}},
                        statut: {{$vehicle->status}})
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach

</ul>

</body>
</html>
