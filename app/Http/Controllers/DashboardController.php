<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Enrutador central del dashboard según el rol del usuario autenticado.
     */
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        return match ($user->role) {
            User::ROLE_GERENTE => redirect()->route('gerente.dashboard'),
            User::ROLE_EMPLEADO => redirect()->route('empleado.dashboard'),
            default => redirect()->route('cliente.dashboard'),
        };
    }

    /**
     * Dashboard específico para el Cliente.
     */
    public function cliente(Request $request): View
    {
        $user = $request->user();

        // Datos e-commerce para la experiencia del cliente
        $comprasRecientes = [
            [
                'id' => 'PED-9042',
                'fecha' => 'Hoy, 09:30 AM',
                'producto' => 'Laptop Ultra Slim Pro 15"',
                'total' => '$18,499.00',
                'estado' => 'En preparación',
                'badge' => 'badge-info',
            ],
            [
                'id' => 'PED-8891',
                'fecha' => '14 Oct 2026',
                'producto' => 'Auriculares Inalámbricos Noise-Cancelling',
                'total' => '$2,399.00',
                'estado' => 'Entregado',
                'badge' => 'badge-success',
            ],
            [
                'id' => 'PED-8410',
                'fecha' => '02 Oct 2026',
                'producto' => 'Teclado Mecánico RGB Bluetooth',
                'total' => '$1,599.00',
                'estado' => 'Entregado',
                'badge' => 'badge-success',
            ],
        ];

        $ofertas = [
            [
                'titulo' => 'Descuento Exclusivo de Bienvenida',
                'descripcion' => '15% de descuento en tu próxima compra usando el código TIENDA15',
                'codigo' => 'TIENDA15',
                'expira' => '31 Oct 2026',
            ],
            [
                'titulo' => 'Envío Gratis Nacional',
                'descripcion' => 'Aplica en todas las compras mayores a $999.00 MXN',
                'codigo' => 'ENVIOGRATIS',
                'expira' => 'Permanente',
            ],
        ];

        return view('dashboard.cliente', compact('user', 'comprasRecientes', 'ofertas'));
    }

    /**
     * Dashboard específico para el Empleado.
     */
    public function empleado(Request $request): View
    {
        $user = $request->user();

        $metricas = [
            'pedidos_pendientes' => 12,
            'pedidos_hoy' => 45,
            'stock_bajo' => 6,
            'atenciones_activas' => 8,
        ];

        $pedidosPorDespachar = [
            ['id' => 'PED-9042', 'cliente' => 'Mariana Ruiz', 'items' => 2, 'prioridad' => 'Alta', 'destino' => 'CDMX'],
            ['id' => 'PED-9041', 'cliente' => 'Roberto Sánchez', 'items' => 5, 'prioridad' => 'Media', 'destino' => 'Guadalajara'],
            ['id' => 'PED-9040', 'cliente' => 'Carla Mendoza', 'items' => 1, 'prioridad' => 'Normal', 'destino' => 'Monterrey'],
            ['id' => 'PED-9039', 'cliente' => 'Fernando Mora', 'items' => 3, 'prioridad' => 'Alta', 'destino' => 'Puebla'],
        ];

        $alertasInventario = [
            ['producto' => 'Monitor Gamer 27" 165Hz', 'sku' => 'MON-GM-27', 'disponibles' => 2, 'minimo' => 10],
            ['producto' => 'SSD NVMe PCIe 4.0 1TB', 'sku' => 'SSD-NVME-1T', 'disponibles' => 3, 'minimo' => 15],
            ['producto' => 'Mouse Ergonómico Vertical', 'sku' => 'MOU-ERG-V1', 'disponibles' => 1, 'minimo' => 8],
        ];

        return view('dashboard.empleado', compact('user', 'metricas', 'pedidosPorDespachar', 'alertasInventario'));
    }

    /**
     * Dashboard específico para el Gerente.
     */
    public function gerente(Request $request): View
    {
        $user = $request->user();

        $totalUsuarios = User::count();
        $totalClientes = User::where('role', User::ROLE_CLIENTE)->count();
        $totalEmpleados = User::where('role', User::ROLE_EMPLEADO)->count();
        $totalGerentes = User::where('role', User::ROLE_GERENTE)->count();

        $ultimosUsuarios = User::latest()->take(5)->get();

        $kpis = [
            'ventas_mes' => '$328,450.00',
            'crecimiento_mes' => '+14.8%',
            'ordenes_mes' => 642,
            'ticket_promedio' => '$511.60',
        ];

        return view('dashboard.gerente', compact(
            'user',
            'totalUsuarios',
            'totalClientes',
            'totalEmpleados',
            'totalGerentes',
            'ultimosUsuarios',
            'kpis'
        ));
    }
}
