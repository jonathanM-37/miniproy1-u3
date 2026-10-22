@extends('layouts.app')

@section('title', 'Dashboard Gerente / Administración')

@php
    /** @var \App\Models\User $user */
    $user = $user ?? auth()->user();
    $totalUsuarios = $totalUsuarios ?? 0;
    $totalClientes = $totalClientes ?? 0;
    $totalEmpleados = $totalEmpleados ?? 0;
    $totalGerentes = $totalGerentes ?? 0;
    $ultimosUsuarios = $ultimosUsuarios ?? collect();
    $kpis = $kpis ?? ['ventas_mes' => '$0.00', 'crecimiento_mes' => '+0%', 'ordenes_mes' => 0, 'ticket_promedio' => '$0.00'];
@endphp

@section('content')
<div class="page-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge badge-gerente" style="margin-bottom: 0.5rem;">Nivel de Acceso: Gerente General</span>
                <h1 class="page-title">Panel Ejecutivo de Administración</h1>
                <p class="page-description">Supervisión integral de usuarios, ventas, métricas financieras y roles del sistema.</p>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                    👥 Gestionar Usuarios (CRUD)
                </a>
                <a href="{{ route('usuarios.create') }}" class="btn btn-secondary">
                    ➕ Nuevo Usuario
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-bottom: 4rem;">
    <!-- Banner Destacado del Módulo CRUD Solicitado -->
    <div class="card" style="background: linear-gradient(135deg, #1e1b4b, #312e81); color: white; margin-bottom: 2.5rem; padding: 2rem; border: none;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <span class="badge" style="background: rgba(255,255,255,0.2); color: white; margin-bottom: 0.5rem;">
                    Requerimiento Clave: CRUD de Usuarios
                </span>
                <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">
                    Control Centralizado de Cuentas y Accesos
                </h2>
                <p style="color: #cbd5e1; max-width: 650px; line-height: 1.6; font-size: 0.95rem;">
                    Como Gerente tienes permisos para <strong>Listar</strong>, <strong>Crear</strong>, <strong>Editar</strong> y <strong>Eliminar</strong> usuarios en los tres niveles de acceso (Cliente, Empleado y Gerente).
                </p>
            </div>
            <div>
                <a href="{{ route('usuarios.index') }}" class="btn btn-lg" style="background: white; color: #1e1b4b; font-weight: 700; box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                    🚀 Abrir Listado de Usuarios Blade
                </a>
            </div>
        </div>
    </div>

    <!-- Indicadores de Usuarios por Rol -->
    <div class="grid grid-cols-4" style="margin-bottom: 2.5rem;">
        <div class="card" style="border-top: 4px solid var(--primary);">
            <div style="color: var(--text-muted); font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">
                Usuarios Totales
            </div>
            <div style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                {{ $totalUsuarios }}
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Registrados en base de datos
            </div>
        </div>

        <div class="card" style="border-top: 4px solid #db2777;">
            <div style="color: var(--text-muted); font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">
                Gerentes / Admins
            </div>
            <div style="font-size: 2.25rem; font-weight: 800; color: #db2777; margin-top: 0.35rem;">
                {{ $totalGerentes }}
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Acceso total al sistema
            </div>
        </div>

        <div class="card" style="border-top: 4px solid #2563eb;">
            <div style="color: var(--text-muted); font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">
                Empleados Operativos
            </div>
            <div style="font-size: 2.25rem; font-weight: 800; color: #2563eb; margin-top: 0.35rem;">
                {{ $totalEmpleados }}
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Manejo de stock y pedidos
            </div>
        </div>

        <div class="card" style="border-top: 4px solid #059669;">
            <div style="color: var(--text-muted); font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">
                Clientes Registrados
            </div>
            <div style="font-size: 2.25rem; font-weight: 800; color: #059669; margin-top: 0.35rem;">
                {{ $totalClientes }}
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Compradores activos
            </div>
        </div>
    </div>

    <!-- KPIs Financieros y Últimos Usuarios -->
    <div class="grid grid-cols-3">
        <!-- KPIs Financieros -->
        <div class="card">
            <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1.25rem;">
                📈 Métricas Comerciales del Mes
            </h3>

            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div style="background: var(--bg-subtle); padding: 1rem; border-radius: var(--radius-md);">
                    <div style="font-size: 0.85rem; color: var(--text-muted);">Ventas Brutas</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: var(--primary);">{{ $kpis['ventas_mes'] }}</div>
                    <div style="font-size: 0.8rem; color: var(--success); font-weight: 600;">{{ $kpis['crecimiento_mes'] }} vs mes anterior</div>
                </div>

                <div style="background: var(--bg-subtle); padding: 1rem; border-radius: var(--radius-md);">
                    <div style="font-size: 0.85rem; color: var(--text-muted);">Órdenes Procesadas</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: var(--text-main);">{{ $kpis['ordenes_mes'] }} pedidos</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">Ticket Promedio: {{ $kpis['ticket_promedio'] }}</div>
                </div>
            </div>

            <div style="margin-top: 1.5rem; text-align: center;">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline btn-sm btn-block">
                    Ver Todos los Usuarios Registrados
                </a>
            </div>
        </div>

        <!-- Tabla de Últimos Usuarios Registrados -->
        <div style="grid-column: span 2;">
            <div class="card" style="padding: 0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 1.15rem; font-weight: 700;">👥 Últimos Usuarios Registrados</h3>
                    <a href="{{ route('usuarios.index') }}" style="font-size: 0.88rem; font-weight: 600;">
                        Ver lista completa →
                    </a>
                </div>

                <div class="table-responsive" style="border: none; border-radius: 0;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Rol Asignado</th>
                                <th>Fecha Registro</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimosUsuarios as $u)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div class="avatar">
                                                {{ strtoupper(substr($u->name, 0, 2)) }}
                                            </div>
                                            <strong>{{ $u->name }}</strong>
                                        </div>
                                    </td>
                                    <td style="color: var(--text-muted);">{{ $u->email }}</td>
                                    <td>
                                        <span class="badge {{ $u->role_badge_class }}">
                                            {{ $u->role_label }}
                                        </span>
                                    </td>
                                    <td style="color: var(--text-muted); font-size: 0.85rem;">
                                        {{ $u->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('usuarios.edit', $u) }}" class="btn btn-secondary btn-sm">
                                            ✏️ Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
