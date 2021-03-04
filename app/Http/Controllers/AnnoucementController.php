<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnoucementRequest;
use App\Http\Requests\EnabledRequest;
use App\Models\Annoucement;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mockery\Exception;

class AnnoucementController extends Controller
{
    public function index()
    {
        $annoucements = Annoucement::with('user')->where('enabled', '=', true)->get();
        return view('annoucements.index', ['annoucements' => $annoucements]);
    }

    public function show(Annoucement $annoucement)
    {
        try{
            $comments = Comment::with('user')->where('annoucement_id', '=', $annoucement->id)->where('enabled', '=', '1')->get();
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
            foreach ($comments as $comment){
                $comment->delete();
            }
            $annoucement->delete();

            return redirect()->route("annoucement.index");
        } catch (Exception $e){
            dd($e);
        }

    }

    public function displayUpdate( Annoucement $annoucement)
    {
//        if( Gate::allows('his-annoucement', $annoucement)){
        return view ('annoucements.update', ['annoucement' => $annoucement]);
//        } else{
//            abort(403);
//        }

    }

    public function update(CreateAnnoucementRequest $request, Annoucement $annoucement)
    {
        $annoucement->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
        ]);
        return redirect()->route("annoucement.show", $annoucement);
    }

    public function updateEnabled(EnabledRequest $request, Annoucement $annoucement)
    {
        $annoucement->update([
            'enabled'=> $request->get('enabled')
        ]);
        return redirect()->route("annoucement.index");
    }

    public function filter(Request $request){
        $filter= $request->get('filter');
        $annoucementsFilter = Annoucement::where('title','LIKE','%'.$filter.'%')->where('enabled', '=', true)->get();
        return view('annoucements.index', ['annoucements' => $annoucementsFilter]);
    }




}
