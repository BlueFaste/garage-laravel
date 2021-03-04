@extends('layouts.app')

@section('content')
    <form method="post" action=" {{ route('annoucement.update', $annoucement) }}">
        @method('PUT')
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $annoucement->title }}">
        </div>
        <div>
            <label for="content">Content</label>
            <input type="text" id="content" name="content" value="{{ $annoucement->content }}">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="{{ $annoucement->price }}">
        </div>
        <input type="submit" class="btn btn-success" value="Mettre à jour l'annonce l'annonce">
        @include('layouts.includes.form-errors')
    </form>

@endsection
