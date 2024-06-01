<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $places = Place::all();
        $shows = Show::all();


        return view('admin.admin')->with([
            'places' => $places,
            'shows' => $shows,
        ]);
    }

    public function showStore(Request $request)
    {

        $credentials = $request->validate([
            'artista' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'place_id' => 'required',
            'imagen' => 'required',
            'precio' => 'required',

        ]);
        $show = new Show();
        $show->artista = $request->artista;
        $show->fecha = $request->fecha;
        $show->hora = $request->hora;

        $show->place_id = $request->place_id;


        $place = Place::where('id', $request->place_id)->first();
        $show->disponibilidad_campo = $place['capacidad_campo'];
        $show->disponibilidad_vip = $place['capacidad_vip'];
        $show->disponibilidad_platea = $place['capacidad_platea'];


        $show->precio = $request->precio;

        if ($request->hasFile('imagen')) {
            $imagen = $request->imagen;
            $extension = $imagen->getClientOriginalName();
            $imagenNombre = time() . '.' . $extension;
            $pathFile = 'images/recitales/';
            $imagen->move($pathFile, $imagenNombre);
            $show->imagen = $pathFile . $imagenNombre;

            $show->save();

            return back()->with('successShow', 'Has agregado el evento correctamente!');
        }
    }

    public function placeStore(Request $request)
    {
        $credentials = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'capacidad_vip' => 'required',
            'capacidad_campo' => 'required',
            'capacidad_platea' => 'required',

        ]);
        $place = new Place();
        $place->nombre = $request->nombre;
        $place->direccion = $request->direccion;
        $place->capacidad_vip = $request->capacidad_vip;
        $place->capacidad_campo = $request->capacidad_campo;
        $place->capacidad_platea = $request->capacidad_platea;

        $placeQuery = Place::where('nombre', $request->nombre)->first();
        if ($placeQuery) {
            return back()->withErrors(['error' => 'Este lugar ya existe.']);
        }
        $place->save();
        return back()->with('successPlace', 'Has agregado el lugar correctamente!');


        //return redirect()->route('admin')->with('success', 'El lugar se ha añadido correctamente!');




    }

    public function showEdit(string $id)
    {

        $show = Show::where('id', $id)->first();
        $places = Place::all();
        return view('admin.showEdit')->with([
            'places' => $places,
            'show' => $show,
        ]);
    }

    public function showUpdate(Request $request, string $id)
    {
        $credentials = $request->validate([
            'artista' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'place_id' => 'required',
            'imagen' => 'required',
            'precio' => 'required',

        ]);

        $show = Show::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $imagen = $request->imagen;
            $extension = $imagen->getClientOriginalName();
            $imagenNombre = time() . '.' . $extension;
            $pathFile = 'images/recitales/';
            $imagen->move($pathFile, $imagenNombre);
            
            if (File::exists($show->imagen)) {
                File::delete($show->imagen);
            }
            
        }


        $show->update([
            'artista' => $request->artista,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'place_id' => $request->place_id,
            'imagen' => $pathFile.$imagenNombre,
            'precio' => $request->precio
        ]);

        return redirect()->route('admin')->with('successUpdate', 'Has actualizado el evento correctamente!');
    }

    public function showDelete($id)
    {

        $show = Show::findOrFail($id);
        
        if (File::exists($show->imagen)) {

            File::delete($show->imagen);
        }
        
        $show->showUsers()->each(function ($showUser) {
            if (Storage::exists($showUser->qr_ruta)) {
                Storage::delete($showUser->qr_ruta);
            }
            $showUser->delete();
        });
    

        $show->delete();
        return redirect()->route('admin')->with('successUpdate', 'Has eliminado el evento correctamente!');
    }
}
