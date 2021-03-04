<div>
    <p>Commentaires</p>
    <form action="{{ route('comment.store', $annoucement) }}" method="post" class="d-flex flex-column">
        @method('POST')
        @csrf
        <label for="content">Votre commentaire :</label>
        <textarea id="content" name="content" type="textarea" rows="6"></textarea>
        <input type="submit" class="btn btn-success" value="Ajouter un commentaire">
        @include('layouts.includes.form-errors')

    </form>

    <ul>
        @foreach($comments as $comment)
            <li class="my-2 d-flex">
                <span class="text-info">id</span> : {{ $comment->id }}, <span class="text-info">content</span>: {{ $comment->content }},
                <span class="text-info">user</span>: {{ $comment->user->name }}.
                @can('his-comment', $comment)
                    <button class="btn btn-primary"><a href="{{ route('comment.display.update', $comment) }}" class="text-white">Editer</a></button>
                    <form method="post" action="{{ route('comment.delete', $comment) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Supprimer"></input>

                    </form>
                @endcan
                @can('enabled-comment')
                    <form method="post" action=" {{ route('comment.update.enabled', $comment) }}" >
                        @method('PUT')
                        @csrf
                        <select name="enabled" id="enabled">
                            <option value="1" {{ $comment->enabled === 1 ? "selected='selected'" : '' }}>Enable</option>
                            <option value="0" {{ $comment->enabled === 0 ? "selected='selected'" : '' }}>disable</option>
                        </select>
                        <input type="submit" class="btn btn-warning" value="Changer l'état"/>
                        @include('layouts.includes.form-errors')
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
</div>
