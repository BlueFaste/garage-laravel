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

    public function displayUpdate(Comment $comment)
    {
        return view ('annoucements.comments.update',['comment'=>$comment]);
    }

    public function update(CreateCommentRequest $request ,Comment $comment)
    {
//        dd($request->get('content'));
        $comment->update([
            'content' => $request->get('content'),
        ]);
        return back();

    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
