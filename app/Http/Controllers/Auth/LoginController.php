<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    //protected $redirectTo = '/home';
    /*en el home cambiar el diseño para que pueda redirigir a la pagina de inicio de la aplicacion*/

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
 
    protected function authenticated(Request $request, $user)
    {
        // Agrega un mensaje de éxito a la sesión
        $message = '¡Bienvenido de nuevo, ' . $user->nombre_completo . '!';
        
        // Redirige al cliente con una respuesta JSON
        return response()->json([
            'redirect' => $this->redirectPath(),
            'success' => $message
        ]);
    }
    

    protected function sendFailedLoginResponse(Request $request)
    {
        // Agrega un mensaje de error a la sesión
        $message = 'Credenciales incorrectas. Inténtalo de nuevo.';

        return response()->json([
            'error' => $message
        ], 422); // 422 Unprocessable Entity para indicar un error de validación
    }
}
