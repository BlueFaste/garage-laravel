@extends('layouts.app')

@section('content')

    <div>
        <p><span class="text-success">title</span> : {{ $annoucement->title }}</p>
        <p><span class="text-success">content</span> : {{ $annoucement->content }}</p>
        <p><span class="text-success">price</span> : {{ $annoucement->price }}</p>
        <p><span class="text-success">user</span> : {{ $annoucement->user->name }}</p>
        @can('his-annoucement', $annoucement)
            <button class="btn btn-primary">Editer</button>
            <form method="post" action="{{ route('annoucement.delete', $annoucement) }}">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger" value="Supprimer"></input>

            </form>
        @endcan
        @can('enabled-annoucement')
        <!-- Rounded switch -->
            enable
            <label class="switch">
                <input type="checkbox" checked="{{$annoucement->enabled}}" name="comment-enabled">
                <span class="slider round"></span>
            </label>
            not enable
            <button class="btn btn-warning"><a href="">Changer l'état</a></button>
        @endcan
    </div>

    @include('annoucements.comments')


@endsection


<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
