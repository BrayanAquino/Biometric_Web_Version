<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get()->map(function($user) {
            $user->formatted_hiring_date = Carbon::parse($user->hiring_date)->format('d-m-Y');
            return $user;
        });
        return view('usuarios.usuarios', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.crear_usuarios', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'cellphone' => 'nullable|string|max:15',
            'hiring_date' => 'nullable|date',
            'state' => 'nullable|string|max:255',
            'rol_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), 
            'cellphone' => $validatedData['cellphone'],
            'hiring_date' => $validatedData['hiring_date'],
            'state' => $validatedData['state'],
            'rol_id' => $validatedData['rol_id'],
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        // Formatear la fecha de contratación
        $user->formatted_hiring_date = Carbon::parse($user->hiring_date)->format('d-m-Y');
        return view('usuarios.editar_usuarios', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'cellphone' => 'nullable|string|max:15',
            'hiring_date' => 'nullable|date',
            'state' => 'nullable|string|max:255',
            'rol_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'cellphone' => $validatedData['cellphone'],
            'hiring_date' => $validatedData['hiring_date'],
            'state' => $validatedData['state'],
            'rol_id' => $validatedData['rol_id'],
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
