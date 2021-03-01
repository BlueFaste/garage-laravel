<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAgeRequest;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show()
    {
        return view('forms.form');
    }

    public function verification(FormAgeRequest $request){
        var_dump($request->get('username'));
        if($request->get('username') && $request->get('email') && $request->get('sex') && $request->get('age')){
            var_dump('ok');
        } else{
            var_dump('no');
        }
    }
}
