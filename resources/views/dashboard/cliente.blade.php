@extends('layouts.app')

@section('title', 'Dashboard Cliente')

@php
    /** @var \App\Models\User $user */
    $user = $user ?? auth()->user();
    $comprasRecientes = $comprasRecientes ?? [];
    $ofertas = $ofertas ?? [];
@endphp

@section('content')
<div class="page-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge badge-cliente" style="margin-bottom: 0.5rem;">Nivel de Acceso: Cliente</span>
                <h1 class="page-title">¡Hola, {{ $user->name }}! 👋</h1>
                <p class="page-description">Bienvenido a tu panel de compras, pedidos y beneficios exclusivos.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    🛍️ Ir al Catálogo de Productos
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-bottom: 4rem;">
    <!-- Tarjetas de Resumen para el Cliente -->
    <div class="grid grid-cols-4" style="margin-bottom: 2.5rem;">
        <div class="card" style="border-left: 4px solid var(--primary);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Pedidos en Curso
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                1
            </div>
            <div style="font-size: 0.8rem; color: var(--success); font-weight: 600; margin-top: 0.25rem;">
                🚚 En camino a tu dirección
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--secondary);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Puntos Fidelidad
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                850
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Equivalente a $85.00 MXN
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--warning);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Cupones Activos
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                2
            </div>
            <div style="font-size: 0.8rem; color: var(--warning); font-weight: 600; margin-top: 0.25rem;">
                Hasta 15% de descuento
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--success);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Compras Totales
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                3
            </div>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                Cliente frecuente desde 2026
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3">
        <!-- Tabla de Pedidos Recientes -->
        <div style="grid-column: span 2;">
            <div class="card" style="padding: 0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 1.15rem; font-weight: 700;">📦 Mis Compras y Pedidos Recientes</h3>
                    <span style="font-size: 0.82rem; color: var(--text-muted);">Actualizado hace unos momentos</span>
                </div>

                <div class="table-responsive" style="border: none; border-radius: 0;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N° Pedido</th>
                                <th>Artículo</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comprasRecientes as $compra)
                                <tr>
                                    <td><strong style="color: var(--primary);">{{ $compra['id'] }}</strong></td>
                                    <td>{{ $compra['producto'] }}</td>
                                    <td style="color: var(--text-muted); font-size: 0.85rem;">{{ $compra['fecha'] }}</td>
                                    <td><strong>{{ $compra['total'] }}</strong></td>
                                    <td>
                                        <span class="badge {{ $compra['badge'] }}">
                                            {{ $compra['estado'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="verDetalleCompra('{{ $compra['id'] }}')">
                                            Ver Detalle
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                        Aún no has realizado ninguna compra.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Columna de Cupones y Datos del Cliente -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Cupones -->
            <div class="card">
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem;">
                    🎟️ Mis Cupones Disponibles
                </h3>
                @forelse($ofertas as $oferta)
                    <div style="background: var(--bg-subtle); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 0.75rem; border: 1px dashed var(--border-color);">
                        <div style="font-weight: 700; font-size: 0.95rem; margin-bottom: 0.25rem;">{{ $oferta['titulo'] }}</div>
                        <div style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.5rem;">{{ $oferta['descripcion'] }}</div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <code style="background: white; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 700; color: var(--primary);">{{ $oferta['codigo'] }}</code>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">Vence: {{ $oferta['expira'] }}</span>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 0.9rem;">No hay cupones activos en este momento.</p>
                @endforelse
            </div>

            <!-- Datos de Perfil -->
            <div class="card">
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.75rem;">
                    👤 Mis Datos Registrados
                </h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 0.4rem;">
                    <strong>Correo:</strong> {{ $user->email }}
                </p>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 0.4rem;">
                    <strong>Teléfono:</strong> {{ $user->phone ?? 'No especificado' }}
                </p>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 1rem;">
                    <strong>Dirección:</strong> {{ $user->address ?? 'No especificada' }}
                </p>
                <a href="{{ route('contacto') }}" class="btn btn-secondary btn-sm btn-block">
                    💬 Solicitar Asistencia o Modificación
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function verDetalleCompra(pedidoId) {
        alert('Detalle de compra ' + pedidoId + ': Factura y comprobante disponibles para descarga.');
    }
</script>
@endsection
