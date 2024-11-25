<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IP;

class IpController extends Controller
{
    public function index()
    {
        $ips = IP::all();
        return view('ips.ip', compact('ips'));
    }

    public function create()
    {
        return view('ips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ip' => 'required|ip|unique:i_p_s,ip_address', 
        ]);

        try {
            // Crear la nueva IP en la base de datos
            IP::create([
                'ip_address' => $request->ip, // Guardar la IP
            ]);

            // Redirigir con un mensaje de éxito
            return redirect()->route('ip.index')->with('success', 'IP registrada correctamente.');
        } catch (\Exception $e) {
            // Manejar errores
            return back()->with('error', 'Error al registrar la IP: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $ip = IP::findOrFail($id); 
            return view('ips.editar', compact('ip'));
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage(); // Devuelve detalles del error
        }
    }
    
    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ip' => 'required|ip|unique:i_p_s,ip_address', 
        ]);

        try {
            
            $ip = IP::findOrFail($id);
            $ip->update([
                'ip_address' => $request->ip,
            ]);

            return redirect()->route('ip.index')->with('success', 'IP actualizada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la IP: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            // Buscar la IP por ID
            $ip = IP::findOrFail($id);

            // Eliminar la IP
            $ip->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->route('ip.index')->with('success', 'IP eliminada correctamente.');
        } catch (\Exception $e) {
            // Manejar errores
            return back()->with('error', 'Error al eliminar la IP: ' . $e->getMessage());
        }
    }

}
