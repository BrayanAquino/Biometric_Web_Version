<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
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
        $request->merge([
            'h_e_mañana' => $this->formatTime($request->input('h_e_mañana')),
            'h_s_mañana' => $this->formatTime($request->input('h_s_mañana')),
            'h_e_tarde' => $this->formatTime($request->input('h_e_tarde')),
            'h_s_tarde' => $this->formatTime($request->input('h_s_tarde')),
            'h_e_noche' => $this->formatTime($request->input('h_e_noche')),
            'h_s_noche' => $this->formatTime($request->input('h_s_noche')),
            'turno_mañana' => $request->has('turno_mañana'),
            'turno_tarde' => $request->has('turno_tarde'),
            'turno_noche' => $request->has('turno_noche'),
        ]);
        // dd($request->all());

        // Validar los datos después de formatear
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
            'turno_tarde' => 'nullable|boolean',
            'turno_noche' => 'nullable|boolean',
            'h_e_mañana' => 'nullable|date_format:H:i|required_if:turno_mañana,true',
            'h_s_mañana' => 'nullable|date_format:H:i|required_if:turno_mañana,true',
            'h_e_tarde' => 'nullable|date_format:H:i|required_if:turno_tarde,true',
            'h_s_tarde' => 'nullable|date_format:H:i|required_if:turno_tarde,true',
            'h_e_noche' => 'nullable|date_format:H:i|required_if:turno_noche,true',
            'h_s_noche' => 'nullable|date_format:H:i|required_if:turno_noche,true',
        ]);
        // dd($validatedData);
        $user = User::with('schedules')->findOrFail($id);
        $user->update($validatedData);

        $scheduleM = Schedule::where('id_user', 1)->where('shift','mañana')->get();
        $scheduleT = Schedule::where('id_user', 1)->where('shift','tarde')->get();
        $scheduleN = Schedule::where('id_user', 1)->where('shift','noche')->get();

        if ($scheduleM->isNotEmpty()) {
            if ($validatedData['turno_mañana'] == true) {
                $scheduleM->first()->update(['start_time' => $validatedData['h_e_mañana'], 'end_time' => $validatedData['h_s_mañana']]);
            } else {
                $scheduleM->first()->delete();
            }
        }else{
            if($validatedData['turno_mañana'] == true){
                Schedule::create(attributes: ['shift' =>'mañana','start_time' => $validatedData['h_e_mañana'], 'end_time' => $validatedData['h_s_mañana'], 'id_user' => $user->id]);
            }
        }

        if ($scheduleT->isNotEmpty()) {
            if($validatedData['turno_tarde'] ==true){
                $scheduleT->first()->update(['start_time' => $validatedData['h_e_tarde'], 'end_time' => $validatedData['h_s_tarde']]);
            }else{
                $scheduleT->first()->delete();
            }
        }else{
            if($validatedData['turno_tarde'] == true){
                Schedule::create(attributes: ['shift' =>'tarde','start_time' => $validatedData['h_e_tarde'], 'end_time' => $validatedData['h_s_tarde'], 'id_user' => $user->id]);
            }
        }

        if ($scheduleN->isNotEmpty()) {
            if($validatedData['turno_noche'] ==true){
                $scheduleN->first()->update(['start_time' => $validatedData['h_e_noche'], 'end_time' => $validatedData['h_s_noche']]);
            }else{
                $scheduleN->first()->delete();
            }
        }else{
            if($validatedData['turno_noche'] == true){
                Schedule::create(attributes: ['shift' =>'noche','start_time' => $validatedData['h_e_noche'], 'end_time' => $validatedData['h_s_noche'], 'id_user' => $user->id]);
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');

    }

    // Método para formatear las horas al formato H:i
    private function formatTime($time)
    {
        if (!$time) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($time)->format('H:i');
        } catch (\Exception $e) {
            return null;
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
