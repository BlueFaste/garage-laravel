@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('form.verification') }}">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="">username</label>
            <input  class="form-control" type="text" name="username" required>
        <label for="">email</label>
            <input  class="form-control" type="email" name="email" required>
        <label for="">sexe</label>
            <input  class="form-control" type="radio" value="M" name="sex">M
            <input  class="form-control" type="radio" value="W" name="sex">W
        <label for="">age</label>
            <input  class="form-control" type="date" name="age" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer le formulaire</button>
        @include('layouts.includes.form-errors')
    </form>
@endsection
