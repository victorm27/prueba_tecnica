<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with(['area', 'roles'])->get();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $areas = Area::query()->select('id', 'nombre')->distinct('nombre')->get();
        $roles = Rol::all();
        return view('empleados.form', compact('areas', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u',
            'email' => 'required|email',
            'sexo' => 'required|in:M,F',
            'area_id' => 'required|exists:areas,id',
            'descripcion' => 'required|string|min:10',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'boletin' => 'nullable|in:1',
        ]);
        $empleado = Empleado::create([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'sexo' => $validated['sexo'],
            'area_id' => $validated['area_id'],
            'boletin' => !empty($validated['boletin']) ? 1 : 0,
            'descripcion' => $validated['descripcion'],
        ]);
        $empleado->roles()->sync($validated['roles']);
        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empleado = Empleado::with(['area', 'roles'])->findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empleado = Empleado::with('roles')->findOrFail($id);
        $areas = Area::all();
        $roles = Rol::all();
        return view('empleados.form', compact('empleado', 'areas', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/u',
            'email' => 'required|email',
            'sexo' => 'required|in:M,F',
            'area_id' => 'required|exists:areas,id',
            'descripcion' => 'required|string|min:10',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'boletin' => 'nullable|in:1',
        ]);
        $empleado = Empleado::findOrFail($id);
        $empleado->update([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'sexo' => $validated['sexo'],
            'area_id' => $validated['area_id'],
            'boletin' => !empty($validated['boletin']) ? 1 : 0,
            'descripcion' => $validated['descripcion'],
        ]);
        $empleado->roles()->sync($validated['roles']);
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->roles()->detach();
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
