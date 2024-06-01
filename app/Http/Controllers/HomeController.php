<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\User;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public static function index() {
        $shows = Show::all(); 
    
        return view("index", compact('shows'));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('busqueda');

        
        $shows = Show::where('artista', 'like', '%'.$query.'%')->get();

        return view('index', compact('shows'));
    }
}
