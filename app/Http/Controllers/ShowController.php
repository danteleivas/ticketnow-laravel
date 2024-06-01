<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function mostrar($id){
    
        $show = Show::find($id);
        $place = Place::find($show->place_id);
        return view('show.show', compact('show', 'place'));
    }

}
