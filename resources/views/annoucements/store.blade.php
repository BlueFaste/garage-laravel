@extends('layouts.app')

@section('content')
    <form method="post" action=" {{ route('annoucement.store') }}">
        @method('POST')
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="content">Content</label>
            <input type="text" id="content" name="content">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" id="price" name="price">
        </div>
        <input type="submit" class="btn btn-success" value="Créer l'annonce">
        @include('layouts.includes.form-errors')
    </form>

@endsection
