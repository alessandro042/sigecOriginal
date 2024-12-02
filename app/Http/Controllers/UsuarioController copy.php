<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

Log::info('Este es un mensaje de prueba');

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::latest()->paginate();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        Log::info('Este es un mensaje de prueba  2');
        try {
            Log::info('Este es un mensaje de prueba  3');
            Log::info('Datos recibidos: ' . json_encode($request->all()));

    
            $request->validate([
                'nombre_completo' => 'required',
                'username' => 'required|unique:usuarios,username',
                'password' => 'required',
                'id_rol' => 'required|not_in:0',
                'email' => 'required|unique:usuarios,email',
            ]);
    
        
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $data['status'] = 1;
            Log::info('Este es un mensaje de prueba 3');
            
            $usuario = Usuario::create($data);
    
        
            return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput(); 
        } catch (QueryException $e) {
            Log::error('Error al insertar el usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al crear el usuario. Intenta de nuevo.');
        } catch (\Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error inesperado. Intenta de nuevo.');
        }
    }

    public function edit(Usuario $usuario)
    {
        
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_completo' => 'required',
            'username' => 'required|unique:usuarios,username,' . $usuario->id,
            'email' => 'required|unique:usuarios,email,' . $usuario->id,
            'id_rol' => 'required|not_in:0',
        ]);

        $data = $request->all();
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index');
    }
}
