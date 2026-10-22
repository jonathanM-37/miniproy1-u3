@extends('layouts.app')

@section('title', 'Gestión de Usuarios - CRUD')

@section('content')
<div class="page-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge badge-gerente" style="margin-bottom: 0.5rem;">Módulo de Administración</span>
                <h1 class="page-title">Listado de Usuarios (CRUD)</h1>
                <p class="page-description">Consulta, búsqueda, creación, modificación y eliminación de cuentas del sistema.</p>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('gerente.dashboard') }}" class="btn btn-secondary">
                    ← Volver al Dashboard
                </a>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    ➕ Crear Nuevo Usuario
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-bottom: 4rem;">
    <!-- Resumen de Contadores de Usuarios -->
    <div class="grid grid-cols-4" style="margin-bottom: 1.5rem;">
        <div class="card" style="padding: 1rem 1.25rem;">
            <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Total Registrados</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: var(--text-main);">{{ $totales['total'] }}</div>
        </div>
        <div class="card" style="padding: 1rem 1.25rem;">
            <div style="font-size: 0.8rem; color: #db2777; font-weight: 700; text-transform: uppercase;">Gerentes</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #db2777;">{{ $totales['gerentes'] }}</div>
        </div>
        <div class="card" style="padding: 1rem 1.25rem;">
            <div style="font-size: 0.8rem; color: #2563eb; font-weight: 700; text-transform: uppercase;">Empleados</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #2563eb;">{{ $totales['empleados'] }}</div>
        </div>
        <div class="card" style="padding: 1rem 1.25rem;">
            <div style="font-size: 0.8rem; color: #059669; font-weight: 700; text-transform: uppercase;">Clientes</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #059669;">{{ $totales['clientes'] }}</div>
        </div>
    </div>

    <!-- Barra de Filtros y Búsqueda -->
    <div class="card" style="margin-bottom: 1.5rem; padding: 1.25rem;">
        <form action="{{ route('usuarios.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
            <div style="flex: 2; min-width: 240px;">
                <label for="buscar" class="form-label" style="font-size: 0.8rem;">Buscar por nombre o correo:</label>
                <input type="text" name="buscar" id="buscar" value="{{ $busqueda }}" 
                       class="form-control" placeholder="Ej. Carlos o admin@tienda.com">
            </div>

            <div style="flex: 1; min-width: 180px;">
                <label for="rol" class="form-label" style="font-size: 0.8rem;">Filtrar por Nivel / Rol:</label>
                <select name="rol" id="rol" class="form-select">
                    <option value="">Todos los roles</option>
                    <option value="gerente" {{ $filtroRol === 'gerente' ? 'selected' : '' }}>Gerente</option>
                    <option value="empleado" {{ $filtroRol === 'empleado' ? 'selected' : '' }}>Empleado</option>
                    <option value="cliente" {{ $filtroRol === 'cliente' ? 'selected' : '' }}>Cliente</option>
                </select>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn btn-primary">
                    🔍 Filtrar
                </button>
                @if($busqueda || $filtroRol)
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" title="Limpiar filtros">
                        ✕ Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabla Blade de Listado de Usuarios -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1rem 1.5rem; background: var(--bg-subtle); border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-main);">
                Mostrando {{ $usuarios->count() }} de {{ $usuarios->total() }} usuarios
            </div>
            @if($busqueda || $filtroRol)
                <span class="badge badge-info">Filtro aplicado</span>
            @endif
        </div>

        <div class="table-responsive" style="border: none; border-radius: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Usuario</th>
                        <th>Correo Electrónico</th>
                        <th>Rol de Acceso</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                        <th style="text-align: right; width: 180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $u)
                        <tr>
                            <td><strong>#{{ $u->id }}</strong></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="avatar">
                                        {{ strtoupper(substr($u->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--text-main);">{{ $u->name }}</div>
                                        @if($u->id === Auth::id())
                                            <span style="font-size: 0.72rem; color: var(--primary); font-weight: 700;">(Tu sesión actual)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $u->email }}" style="color: var(--text-muted);">
                                    {{ $u->email }}
                                </a>
                            </td>
                            <td>
                                <span class="badge {{ $u->role_badge_class }}">
                                    {{ $u->role_label }}
                                </span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.88rem;">
                                {{ $u->phone ?? '—' }}
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                {{ $u->created_at ? $u->created_at->format('d/m/Y H:i') : '—' }}
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.4rem; justify-content: flex-end;">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('usuarios.edit', $u) }}" class="btn btn-secondary btn-sm" title="Editar datos del usuario">
                                        ✏️ Editar
                                    </a>

                                    <!-- Botón Eliminar con confirmación -->
                                    @if($u->id !== Auth::id())
                                        <form action="{{ route('usuarios.destroy', $u) }}" method="POST" 
                                              onsubmit="return confirm('¿Confirmas que deseas eliminar al usuario \'{{ $u->name }}\'? Esta acción no se puede deshacer.');" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar usuario">
                                                🗑️
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled title="No puedes eliminarte a ti mismo">
                                            🔒
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🔍</div>
                                <div style="font-weight: 700; font-size: 1.1rem; color: var(--text-main);">No se encontraron usuarios</div>
                                <p style="font-size: 0.9rem; margin-top: 0.25rem;">Intenta con otros términos de búsqueda o elimina los filtros.</p>
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm" style="margin-top: 1rem;">
                                    Ver Todos los Usuarios
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($usuarios->hasPages())
            <div style="padding: 1.25rem 1.5rem; border-top: 1px solid var(--border-color); background: white;">
                {{ $usuarios->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
