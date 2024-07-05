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
        $municipes = Municipe::orderBy('nome')->paginate(30);
        return view('municipes.index', [
            'municipes' => $municipes
        ]);
    }
}
