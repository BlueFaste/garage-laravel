@extends('layouts.app')

@section('content')
    <form action="{{ route('comment.update', $comment) }}" method="post" class="d-flex flex-column">
        @method('PUT')
        @csrf
        <label for="content">Votre commentaire :</label>
        <textarea id="content" name="content" type="textarea" rows="6">{{$comment->content}}</textarea>
        <input type="submit" class="btn btn-success" value="Modifier votre commentaire">
        @include('layouts.includes.form-errors')

    </form>

@endsection
