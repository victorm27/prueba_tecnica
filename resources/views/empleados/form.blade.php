@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mt-4 mb-5">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ isset($empleado) ? 'Editar' : 'Crear' }} Empleado</h2>
                </div>
                <div class="card-body">
                    <p class="mb-3"><span class="text-danger">*</span> <strong>Los campos marcados con * son obligatorios.</strong></p>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ isset($empleado) ? route('empleados.update', $empleado->id) : route('empleados.store') }}" autocomplete="off">
                        @csrf
                        @if(isset($empleado))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre ?? '') }}" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$" placeholder="Nombre completo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $empleado->email ?? '') }}" required placeholder="ejemplo@correo.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sexo <span class="text-danger">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" {{ old('sexo', $empleado->sexo ?? '') == 'M' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="sexoM">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" {{ old('sexo', $empleado->sexo ?? '') == 'F' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="sexoF">Femenino</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Área <span class="text-danger">*</span></label>
                            <select name="area_id" class="form-select" required>
                                <option value="">--Seleccione área--</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_id', $empleado->area_id ?? '') == $area->id ? 'selected' : '' }}>{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción <span class="text-danger">*</span></label>
                            <textarea name="descripcion" class="form-control" required placeholder="Describe la experiencia del empleado">{{ old('descripcion', $empleado->descripcion ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="boletin" id="boletin" value="1" {{ old('boletin', $empleado->boletin ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="boletin">Deseo recibir Boletín Informativo</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles <span class="text-danger">*</span></label>
                            <ul class="list-group">
                                @foreach($roles as $rol)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]" id="rol{{ $rol->id }}" value="{{ $rol->id }}" {{ (isset($empleado) && $empleado->roles->contains($rol->id)) || (is_array(old('roles')) && in_array($rol->id, old('roles', []))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rol{{ $rol->id }}">{{ $rol->nombre }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success px-4">Guardar</button>
                            <a href="{{ route('empleados.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
