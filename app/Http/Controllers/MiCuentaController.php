<?php

namespace App\Http\Controllers;

use App\Models\Show_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiCuentaController extends Controller
{
    public function micuenta(Request $request){

        $user = User::find(Auth::user()->id);
        $entradas = Show_User::where('user_id', $user->id)->get();

        return view('micuenta', compact('user', 'entradas'));
    }
}
