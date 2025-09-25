@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Listado de Empleados</h1>
        <a href="{{ route('empleados.create') }}" class="btn btn-success shadow"><i class="bi bi-person-plus"></i> Nuevo Empleado</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif
    <div class="table-responsive rounded shadow">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Área</th>
                    <th scope="col">Boletín</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td class="text-muted">{{ $empleado->id }}</td>
                    <td>
                        <span class="fw-semibold">{{ $empleado->nombre }}</span>
                    </td>
                    <td>{{ $empleado->email }}</td>
                    <td>
                        <span class="badge {{ $empleado->sexo == 'M' ? 'bg-info' : 'bg-femenino' }}">{{ $empleado->sexo == 'M' ? 'Masculino' : 'Femenino' }}</span>
                    </td>
                    <td>
                        @php
                            $areaColors = [
                                'Administración' => 'bg-area-admin',
                                'Recursos Humanos' => 'bg-area-rh',
                                'Desarrollo' => 'bg-area-dev',
                                'Ventas' => 'bg-area-ventas',
                                'Sistemas' => 'bg-area-sistemas',
                                'Contabilidad' => 'bg-area-conta',
                                'Marketing' => 'bg-area-marketing',
                            ];
                            $areaNombre = $empleado->area->nombre ?? '';
                            $badgeClass = $areaColors[$areaNombre] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $areaNombre }}</span>
                    </td>
                    <td>
                        @if($empleado->boletin)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                    <td>{{ $empleado->descripcion }}</td>
                    <td>
                        @foreach($empleado->roles as $rol)
                            <span class="badge bg-primary me-1">{{ $rol->nombre }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Editar">✏️</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar este empleado?')">🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('styles')
<style>
    .bg-femenino { background-color: #ff69b4 !important; color: #fff !important; }
    .bg-area-admin { background-color: #6c757d !important; color: #fff !important; }
    .bg-area-rh { background-color: #20c997 !important; color: #fff !important; }
    .bg-area-dev { background-color: #198754 !important; color: #fff !important; }
    .bg-area-ventas { background-color: #ffc107 !important; color: #212529 !important; }
    .bg-area-sistemas { background-color: #0d6efd !important; color: #fff !important; }
    .bg-area-conta { background-color: #fd7e14 !important; color: #fff !important; }
    .bg-area-marketing { background-color: #6610f2 !important; color: #fff !important; }
</style>
@endpush
@endsection
