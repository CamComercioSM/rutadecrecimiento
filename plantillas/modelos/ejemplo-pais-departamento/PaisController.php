<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return response()->json($paises);
    }

    public function show($id)
    {
        $pais = Pais::findOrFail($id);
        return response()->json($pais);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pais_id' => 'required|unique:paises',
            'nombre' => 'required|string|max:100',
        ]);

        $pais = new Pais();
        $pais->pais_id = $request->input('pais_id');
        $pais->nombre = $request->input('nombre');
        $pais->save(); // Se guardan los datos y se aplican las auditorías automáticamente

        return response()->json($pais, 201);
    }

    public function update(Request $request, $id)
    {
        $pais = Pais::findOrFail($id);

        $request->validate([
            'nombre' => 'string|max:100',
        ]);

        $pais->nombre = $request->input('nombre', $pais->nombre);
        $pais->save(); // Se aplican las auditorías automáticamente

        return response()->json($pais);
    }

    public function destroy($id)
    {
        $pais = Pais::findOrFail($id);
        $pais->delete(); // Se aplican las auditorías automáticamente

        return response()->json(['message' => 'País eliminado correctamente.']);
    }
}
