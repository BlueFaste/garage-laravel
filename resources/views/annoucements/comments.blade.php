<div>
    <p>Commentaires</p>
    <div class="d-flex flex-column">
        <label for="comment">Votre commentaire :</label>
        <textarea id="comment" name="comment" type="textarea" rows="6"></textarea>
        <button class="btn btn-success">Ajouter un commentaire</button>

    </div>

    <ul>
        @foreach($comments as $comment)
            <li class="my-2">
                {{--            {{ $annoucement }}--}}
                <span class="text-info">id</span> : {{ $comment->id }}, <span class="text-info">content</span>: {{ $comment->content }},
                <span class="text-info">user</span>: {{ $comment->user->name }}.
                @can('his-comment', $comment)
                    <button class="btn btn-primary">Editer</button>
                    <button class="btn btn-danger">Supprimer</button>
                @endcan
                @can('enabled-comment')
                <!-- Rounded switch -->
                    enable
                    <label class="switch">
                        <input type="checkbox" checked="{{$comment->enabled}}" name="comment-enabled">
                        <span class="slider round"></span>
                    </label>
                    not enable
                    <button class="btn btn-warning"><a href="">Changer l'état</a></button>
                @endcan
            </li>
        @endforeach
    </ul>
</div>
