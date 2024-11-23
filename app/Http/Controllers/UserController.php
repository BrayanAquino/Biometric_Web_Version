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
        'dni' => 'nullable|string|max:15',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'cellphone' => 'nullable|string|max:15',
        'hiring_date' => 'nullable|date',
        'state' => 'nullable|string|max:255',
        'rol_id' => 'required|exists:roles,id',
    ]);

    // Crear el usuario
    $user = User::create([
        'name' => $validatedData['name'],
        'lastname' => $validatedData['lastname'],
        'dni' => $validatedData['dni'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'cellphone' => $validatedData['cellphone'],
        'hiring_date' => $validatedData['hiring_date'],
        'state' => $validatedData['state'],
        'rol_id' => $validatedData['rol_id'],
    ]);

    // Guardar los horarios
    $schedules = [];
    foreach (['mañana', 'tarde', 'noche'] as $turno) {
        if ($request->boolean("turno_{$turno}")) {
            $schedules[] = [
                'shift' => $turno,
                'start_time' => $request->input("h_e_{$turno}"),
                'end_time' => $request->input("h_s_{$turno}"),
                'id_user' => $user->id, // Asegúrate de incluir el id del usuario
            ];
        }
    }
    
    // Guardar los horarios en la base de datos
    $user->schedules()->createMany($schedules);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
}

    public function edit($id)
    {
        $user = User::with('schedules')->findOrFail($id); // Cargar los horarios
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
            'dni' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'cellphone' => 'nullable|string|max:15',
            'hiring_date' => 'nullable|date',
            'state' => 'nullable|string|max:255',
            'rol_id' => 'required|exists:roles,id',
            'turno_mañana' => 'nullable|boolean',
            'h_e_mañana' => 'nullable|date_format:H:i|required_if:turno_mañana,true',
            'h_s_mañana' => 'nullable|date_format:H:i|required_if:turno_mañana,true',
            'turno_tarde' => 'nullable|boolean',
            'h_e_tarde' => 'nullable|date_format:H:i|required_if:turno_tarde,true',
            'h_s_tarde' => 'nullable|date_format:H:i|required_if:turno_tarde,true',
            'turno_noche' => 'nullable|boolean',
            'h_e_noche' => 'nullable|date_format:H:i|required_if:turno_noche,true',
            'h_s_noche' => 'nullable|date_format:H:i|required_if:turno_noche,true',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        // Actualizar horarios
        $schedules = [];
        foreach (['mañana', 'tarde', 'noche'] as $turno) {
            if ($request->boolean("turno_{$turno}")) {
                $schedules[] = [
                    'shift' => $turno,
                    'start_time' => $request->input("h_e_{$turno}"),
                    'end_time' => $request->input("h_s_{$turno}"),
                    'id_user' => $user->id,
                ];
            }
        }

        // Eliminar horarios existentes y crear nuevos
        $user->schedules()->delete(); // Eliminar horarios existentes
        $user->schedules()->createMany($schedules); // Crear nuevos horarios

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
