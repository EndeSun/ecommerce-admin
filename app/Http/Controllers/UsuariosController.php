<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function getUsuarios(){
        $arrayUsers = User::where('rol', '!=', 'clients')->get();
        return view('usuarios/usuarios', ['arrayUsers' => $arrayUsers]);
    }

    public function getUsuariosRol(){
        $arrayUsers = User::where('rol', '!=', 'clients')->get();
        return view('usuarios/rol', ['arrayUsers' => $arrayUsers]);
    }
    public function getUsuariosInformes(){
        return view('usuarios/usuarios_informes');
    }
}
