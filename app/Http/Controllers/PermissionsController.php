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
        return view('permisos.permisos');
    }

    public function create()
    {
        return view('permisos.crearpermiso');
    }

    public function store(Request $request)
    {

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason_permission' => 'required|string',
            'status_permission' => 'required|string|in:Pendiente,Aprobado,Rechazado',
            'evidence_permission' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $permission = Permission::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason_permission' => $request->reason_permission,
            'status_permission' => $request->status_permission,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('evidence_permission')) {
            $path = $request->file('evidence_permission')->store('evidences', 'public');

            EvidencePermission::create([
                'evidence_permission' => $path,
                'permission_id' => $permission->id,
            ]);
        }

        return redirect()->route('permisos.index')->with('success', 'Permiso registrado correctamente');
    }
}
