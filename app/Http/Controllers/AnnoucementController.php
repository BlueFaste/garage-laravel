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






}
