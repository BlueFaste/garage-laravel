<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Annoucement;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request,  Annoucement $annoucement)
    {
//        dd($annoucement);
        $user =$request->user();
        $comment = new Comment([
            'content' => $request->get('content'),
            'annoucement_id' => $annoucement->id,
            'enabled' => true
        ]);

        $user->comments()->save($comment);
        return back();
    }
}
