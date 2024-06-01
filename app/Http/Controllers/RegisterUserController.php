<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterUserController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(Request $request){
        
        $request->validate([
            'nombre' => ['required', 'max:100', 'min:3', 'string'],
            'apellido' => ['required', 'max:100', 'min:3', 'string'],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
                       
        ]);
       
        $user = User::create([

            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password'=> Hash::make($request->password),

        ]);
        
        
        return redirect()->route('login')->with('success', 'Te has registrado correctamente!');
       

    }

    


}
