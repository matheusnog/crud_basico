<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Input;

class InputsController extends Controller
{
    public function create(){
        return view('inputs.create');
    }

    public function list(){
        $input = Input::all();
        return view('inputs.list', ['input' => $input]);
    }

    public function show($id){
        $input = Input::find($id);
        return view('inputs.show', ['input' => $input]);
    }
}
