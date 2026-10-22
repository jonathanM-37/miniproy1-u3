@extends('layouts.app')

@section('title', 'Dashboard Empleado')

@php
    /** @var \App\Models\User $user */
    $user = $user ?? auth()->user();
    $metricas = $metricas ?? [
        'pedidos_pendientes' => 0,
        'pedidos_hoy' => 0,
        'stock_bajo' => 0,
        'atenciones_activas' => 0,
    ];
    $pedidosPorDespachar = $pedidosPorDespachar ?? [];
    $alertasInventario = $alertasInventario ?? [];
@endphp

@section('content')
<div class="page-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge badge-empleado" style="margin-bottom: 0.5rem;">Nivel de Acceso: Empleado</span>
                <h1 class="page-title">Panel Operativo de Empleado</h1>
                <p class="page-description">Gestión de despachos, control de inventario y preparación de envíos.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" onclick="alert('Sistema sincronizado con escáner de bodega.')">
                    📦 Escanear Código de Paquete
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-bottom: 4rem;">
    <!-- Métricas Operativas -->
    <div class="grid grid-cols-4" style="margin-bottom: 2.5rem;">
        <div class="card" style="border-left: 4px solid var(--warning);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Pendientes de Despacho
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                {{ $metricas['pedidos_pendientes'] }}
            </div>
            <div style="font-size: 0.8rem; color: var(--warning); font-weight: 600; margin-top: 0.25rem;">
                ⚠️ Prioridad del turno actual
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--success);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Despachados Hoy
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                {{ $metricas['pedidos_hoy'] }}
            </div>
            <div style="font-size: 0.8rem; color: var(--success); font-weight: 600; margin-top: 0.25rem;">
                ✅ 98% en tiempo récord
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--danger);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Alertas de Stock Bajo
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                {{ $metricas['stock_bajo'] }}
            </div>
            <div style="font-size: 0.8rem; color: var(--danger); font-weight: 600; margin-top: 0.25rem;">
                Requiere solicitud a proveedor
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--info);">
            <div style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                Atenciones Activas
            </div>
            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin-top: 0.35rem;">
                {{ $metricas['atenciones_activas'] }}
            </div>
            <div style="font-size: 0.8rem; color: var(--info); font-weight: 600; margin-top: 0.25rem;">
                En cola de empaque
            </div>
        </div>
    </div>

    <!-- Pedidos por Despachar -->
    <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 2.5rem;">
        <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 1.15rem; font-weight: 700;">🚚 Pedidos en Cola para Empaque y Despacho</h3>
            <span class="badge badge-warning">Cola de Bodega</span>
        </div>

        <div class="table-responsive" style="border: none; border-radius: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>N° Guía</th>
                        <th>Destinatario</th>
                        <th>Artículos</th>
                        <th>Destino</th>
                        <th>Prioridad</th>
                        <th>Acción Operativa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidosPorDespachar as $pedido)
                        <tr>
                            <td><strong style="color: var(--primary);">{{ $pedido['id'] }}</strong></td>
                            <td>{{ $pedido['cliente'] }}</td>
                            <td>{{ $pedido['items'] }} item(s)</td>
                            <td>📍 {{ $pedido['destino'] }}</td>
                            <td>
                                @if($pedido['prioridad'] === 'Alta')
                                    <span class="badge badge-warning" style="background: #fef2f2; color: #dc2626; border-color: #fecaca;">Alta</span>
                                @elseif($pedido['prioridad'] === 'Media')
                                    <span class="badge badge-warning">Media</span>
                                @else
                                    <span class="badge badge-info">Normal</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="marcarDespachado(this, '{{ $pedido['id'] }}')">
                                    Marcar Despachado
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                No hay pedidos pendientes de empaque.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Alertas de Stock Bajo -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 1.15rem; font-weight: 700;">⚠️ Control de Inventario: Alertas Críticas</h3>
            <span class="badge badge-danger">Reponer Stock</span>
        </div>

        <div class="table-responsive" style="border: none; border-radius: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>SKU / Código</th>
                        <th>En Bodega</th>
                        <th>Nivel Mínimo Requerido</th>
                        <th>Estado de Stock</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alertasInventario as $item)
                        <tr>
                            <td><strong>{{ $item['producto'] }}</strong></td>
                            <td><code>{{ $item['sku'] }}</code></td>
                            <td style="color: var(--danger); font-weight: 700;">{{ $item['disponibles'] }} unidades</td>
                            <td>{{ $item['minimo'] }} unidades</td>
                            <td>
                                <span class="badge badge-warning">Crítico</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline btn-sm" onclick="solicitarSurtido('{{ $item['sku'] }}')">
                                    Solicitar Surtido
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                Todos los niveles de stock se encuentran dentro de los parámetros normales.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function marcarDespachado(btn, pedidoId) {
        btn.innerText = '✅ Despachado';
        btn.disabled = true;
        alert('El pedido ' + pedidoId + ' fue marcado como despachado correctamente.');
    }

    function solicitarSurtido(sku) {
        alert('Se generó la solicitud de reposición al proveedor para el producto: ' + sku);
    }
</script>
@endsection
