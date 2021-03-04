<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnoucementRequest;
use App\Models\Annoucement;
use App\Models\Comment;
use Mockery\Exception;

class AnnoucementController extends Controller
{
    public function index()
    {
        $annoucements = Annoucement::with('user')->where('enabled', '=', true)->get();

//        dd($annoucements);

        return view('annoucements.index', ['annoucements' => $annoucements]);
    }

    public function show(Annoucement $annoucement)
    {
        try{
//            $annoucement = Annoucement::findOrFail($annoucement);
            $comments = Comment::with('user')->where('annoucement_id', '=', $annoucement->id)->get();
//            dd($comments);

            return view('annoucements.show', ['annoucement' => $annoucement, 'comments'=> $comments]);


        } catch (Exception $e){
            dd($e);
        }
    }

    public function displayStore(){
        return view ('annoucements.store');
    }

    public function store(CreateAnnoucementRequest $request){
        $user =$request->user();
//        dd($user->id);
//        dd($request->get('title'), $request->get('content'), $request->get('price'));
        $annoucement = new Annoucement([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
            'enabled' => true
        ]);

        $user->annoucements()->save($annoucement);
        return redirect()->route("annoucement.index");
    }

    public function delete(Annoucement $annoucement)
    {
        try{
            $comments = Comment::where('annoucement_id', '=', $annoucement->id)->get();
//            dd($comments);
            foreach ($comments as $comment){
                $comment->delete();
            }
            $annoucement->delete();

            return redirect()->route("annoucement.index");

        } catch (Exception $e){
            dd($e);
        }

    }

    public function displayUpdate(Annoucement $annoucement)
    {
        return view ('annoucements.update', ['annoucement' => $annoucement]);
    }

    public function update(CreateAnnoucementRequest $request, Annoucement $annoucement)
    {
//        dd($request->get('title'), $request->get('content'), $request->get('price'));
        $annoucement->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
        ]);

        return redirect()->route("annoucement.show", $annoucement);
    }





}
