<?php

namespace App\Helpers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class BitacoraHelper
{
    public static function registrarAcciones($accion, $seccion, $id_registro)
    {

        // $id_registro = 0;
        // $id_usuario = 200;
        Bitacora::create([
            'id_usuario' => Auth::id(),
            'id_accion' => $accion,
            'id_seccion' => $seccion,
            'id_registro' => $id_registro,
        ]);
    }
}


     // $id_usuario = Auth::id();
    // Obtener el ID del usuario autenticado
