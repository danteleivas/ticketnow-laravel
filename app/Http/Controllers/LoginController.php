<?php

namespace App\Http\Controllers;

use App\Mail\MailController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function login()
    {
        
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->admin){
                return redirect()->route('admin');
            }
            
            return redirect()->intended(route('home'));
        }
 
        return back()->withErrors(['credenciales' => 'Las credenciales ingresadas son incorrectas']);

        /*$user = User::where('email', $credentials['email'])->first();

        if ($user) {
            $verificar_password = Hash::check($credentials['password'], $user->password);

            if ($verificar_password) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->with('error', 'La contraseña es incorrecta');
            }
        } else {
            return redirect()->back()->with('error', 'El email no se encuentra registrado en el sistema.');
        }*/
    }

    public function logout(Request $request)
    {
        Auth::logout();

        
        return redirect()->route('home');
    }
}
