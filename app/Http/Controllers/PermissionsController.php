<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\EvidencePermission;
use Illuminate\Support\Facades\Auth;
class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('evidences')->where('user_id', Auth::id())->get();
        return view('permisos.permisos', compact('permissions'));
    }

    public function create()
    {
        if (Auth::check()) {
            $idRol = Auth::user()->rol_id;
        } else {
            // Usuario no autenticado
        }
        return view('permisos.crearpermiso', compact('idRol'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validar los datos
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason_permission' => 'required|string',
            'status_permission' => 'required|string',
            'evidence_permission' => 'nullable|file|mimes:pdf,jpg,png|max:30720', // Ajusta el tamaño máximo según tus necesidades
        ]);


        // Crear el permiso
        $permission = Permission::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason_permission' => $request->reason_permission,
            'status_permission' => $request->status_permission,
            'user_id' => Auth::id(), // Asigna el usuario autenticado
        ]);

        // Manejar la subida del archivo
        if ($request->hasFile('evidence_permission')) {
            // Guarda el archivo en storage/app/public/permisos
            $evidencePath = $request->file('evidence_permission')->store('permisos', 'public');

            // Crear la evidencia asociada al permiso
            $permission->evidences()->create([
                'evidence_permission' => $evidencePath, // Guarda la ruta del archivo
            ]);
        }

        return redirect()->route('permisos.index')->with('success', 'Permiso registrado correctamente.');
    }

    public function show($id)
    {
        // Obtener el permiso por ID junto con las evidencias
        $permission = Permission::with('evidences')->findOrFail($id);

        // Retornar la vista con el permiso
        return view('permisos.detalles', compact('permission'));
    }

    public function downloadEvidence($id)
    {
        // Obtener el permiso por ID junto con las evidencias
        $permission = Permission::with('evidences')->findOrFail($id);

        // Verificar si hay evidencias
        if ($permission->evidences->isEmpty()) {
            return redirect()->route('permisos.index')->with('error', 'No hay evidencias para descargar.');
        }

        // Suponiendo que solo hay una evidencia para simplificar
        $evidence = $permission->evidences->first();

        // Obtener la ruta del archivo
        $filePath = storage_path('app/public/' . $evidence->evidence_permission);

        // Verificar si el archivo existe
        if (!file_exists($filePath)) {
            return redirect()->route('permisos.index')->with('error', 'El archivo no existe.');
        }

        // Retornar el archivo como descarga
        return response()->download($filePath);
    }

    public function edit($id)
    {
        // Obtener el permiso por ID
        $permission = Permission::with('evidences')->findOrFail($id);

        // Retornar la vista de edición con el permiso
        return view('permisos.editar', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason_permission' => 'required|string',
            'status_permission' => 'required|string',
            'evidence_permission' => 'nullable|file|mimes:pdf,jpg,png|max:30720', // Ajusta el tamaño máximo según tus necesidades
        ]);

        // Obtener el permiso por ID
        $permission = Permission::findOrFail($id);

        // Actualizar los datos del permiso
        $permission->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason_permission' => $request->reason_permission,
            'status_permission' => $request->status_permission,
        ]);

        // Manejar la subida del archivo si se proporciona uno
        if ($request->hasFile('evidence_permission')) {
            // Guarda el archivo en storage/app/public/permisos
            $evidencePath = $request->file('evidence_permission')->store('permisos', 'public');

            // Si ya hay evidencias, actualizarlas o crear una nueva
            if ($permission->evidences()->exists()) {
                // Actualizar la evidencia existente (si solo hay una)
                $permission->evidences()->first()->update([
                    'evidence_permission' => $evidencePath, // Guarda la nueva ruta del archivo
                ]);
            } else {
                // Crear la evidencia asociada al permiso
                $permission->evidences()->create([
                    'evidence_permission' => $evidencePath, // Guarda la ruta del archivo
                ]);
            }
        }

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }
}
