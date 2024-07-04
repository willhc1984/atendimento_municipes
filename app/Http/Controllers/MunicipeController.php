<?php

namespace App\Http\Controllers;

use App\Models\Municipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipeController extends Controller
{
    //Listar municipes
    public function index()
    {
        $municipes = Municipe::all();
        //dd($municipes);
        return view('municipes.index', [
            'municipes' => $municipes
        ]);
    }
}
