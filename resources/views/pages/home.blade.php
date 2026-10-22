@extends('layouts.app')

@section('title', 'Bienvenido a TiendaOnline')

@section('content')
    <!-- Hero Principal -->
    <section class="hero">
        <div class="container">
            <span class="badge badge-info" style="margin-bottom: 1rem; font-size: 0.8rem;">
                🚀 Primera Entrega • Sistema de E-Commerce Multi-Rol
            </span>
            <h1 class="hero-title">
                Tu tienda digital favorita con<br>
                <span style="background: linear-gradient(135deg, #4f46e5, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    experiencia moderna y segura
                </span>
            </h1>
            <p class="hero-subtitle">
                Accede a nuestro catálogo exclusivo, administra operaciones de despacho o gestiona usuarios y ventas según tu nivel de acceso asignado.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        🔑 Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">
                        ✨ Crear Cuenta Nueva
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        📊 Ir a mi Dashboard ({{ Auth::user()->role_label }})
                    </a>
                    @if(Auth::user()->isGerente())
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-lg">
                            👥 Administrar Usuarios (CRUD)
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </section>

    <!-- Tarjetas de Acceso Rápido para Pruebas / Demostración -->
    <section style="padding: 3rem 0; background: white; border-bottom: 1px solid var(--border-color);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span class="badge badge-warning" style="margin-bottom: 0.5rem;">Cuentas Pre-configuradas</span>
                <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main);">
                    Acceso Rápido por Rol para Evaluación
                </h2>
                <p style="color: var(--text-muted); max-width: 650px; margin: 0.35rem auto 0;">
                    El sistema incluye tres perfiles listos para probar la redirección y permisos solicitados en la lista de verificación:
                </p>
            </div>

            <div class="grid grid-cols-3">
                <!-- Gerente Card -->
                <div class="card" style="border-top: 4px solid #db2777;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge badge-gerente">Nivel: Gerente</span>
                        <span style="font-size: 1.5rem;">👔</span>
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Administrador / Gerente</h3>
                    <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1rem;">
                        Acceso a métricas globales, analíticas de ventas y al <strong>CRUD completo de Usuarios</strong>.
                    </p>
                    <div style="background: var(--bg-subtle); padding: 0.75rem; border-radius: var(--radius-sm); font-size: 0.85rem; font-family: monospace; margin-bottom: 1rem;">
                        <div><strong>Correo:</strong> admin@tienda.com</div>
                        <div><strong>Clave:</strong> password</div>
                    </div>
                    <a href="{{ route('login') }}?email=admin@tienda.com" class="btn btn-secondary btn-sm btn-block">
                        Probar como Gerente
                    </a>
                </div>

                <!-- Empleado Card -->
                <div class="card" style="border-top: 4px solid #2563eb;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge badge-empleado">Nivel: Empleado</span>
                        <span style="font-size: 1.5rem;">📦</span>
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Personal Operativo</h3>
                    <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1rem;">
                        Dashboard exclusivo para preparación de despachos, control de inventario y alertas de stock bajo.
                    </p>
                    <div style="background: var(--bg-subtle); padding: 0.75rem; border-radius: var(--radius-sm); font-size: 0.85rem; font-family: monospace; margin-bottom: 1rem;">
                        <div><strong>Correo:</strong> empleado@tienda.com</div>
                        <div><strong>Clave:</strong> password</div>
                    </div>
                    <a href="{{ route('login') }}?email=empleado@tienda.com" class="btn btn-secondary btn-sm btn-block">
                        Probar como Empleado
                    </a>
                </div>

                <!-- Cliente Card -->
                <div class="card" style="border-top: 4px solid #059669;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge badge-cliente">Nivel: Cliente</span>
                        <span style="font-size: 1.5rem;">🛒</span>
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Comprador / Cliente</h3>
                    <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1rem;">
                        Dashboard de cliente para compras, seguimiento de pedidos, cupones promocionales y perfil.
                    </p>
                    <div style="background: var(--bg-subtle); padding: 0.75rem; border-radius: var(--radius-sm); font-size: 0.85rem; font-family: monospace; margin-bottom: 1rem;">
                        <div><strong>Correo:</strong> cliente@tienda.com</div>
                        <div><strong>Clave:</strong> password</div>
                    </div>
                    <a href="{{ route('login') }}?email=cliente@tienda.com" class="btn btn-secondary btn-sm btn-block">
                        Probar como Cliente
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Catálogo Destacado de Productos -->
    <section style="padding: 4rem 0;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
                <div>
                    <span class="badge badge-info" style="margin-bottom: 0.5rem;">Catálogo 2026</span>
                    <h2 style="font-size: 1.85rem; font-weight: 800;">Productos Destacados</h2>
                    <p style="color: var(--text-muted);">Los artículos más valorados por nuestros clientes este mes</p>
                </div>
                <a href="{{ route('contacto') }}" class="btn btn-outline btn-sm">
                    Consultar Catálogo Mayorista
                </a>
            </div>

            <div class="grid grid-cols-4">
                <!-- Producto 1 -->
                <div class="card" style="padding: 1.25rem;">
                    <div style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); border-radius: var(--radius-md); height: 170px; display: flex; align-items: center; justify-content: center; font-size: 4rem; margin-bottom: 1rem;">
                        💻
                    </div>
                    <span class="badge badge-cliente" style="margin-bottom: 0.5rem; font-size: 0.7rem;">En Stock</span>
                    <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.35rem;">Laptop Ultra Slim Pro 15"</h4>
                    <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.75rem;">Intel Core i7, 16GB RAM, 512GB SSD NVMe</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">$18,499</span>
                        <button class="btn btn-primary btn-sm" onclick="alert('Inicia sesión o revisa tu dashboard de cliente para comprar.')">Comprar</button>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="card" style="padding: 1.25rem;">
                    <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: var(--radius-md); height: 170px; display: flex; align-items: center; justify-content: center; font-size: 4rem; margin-bottom: 1rem;">
                        🎧
                    </div>
                    <span class="badge badge-cliente" style="margin-bottom: 0.5rem; font-size: 0.7rem;">Más Vendido</span>
                    <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.35rem;">Auriculares Noise Cancelling</h4>
                    <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.75rem;">Audio Hi-Res, 40h de batería, Bluetooth 5.3</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">$2,399</span>
                        <button class="btn btn-primary btn-sm" onclick="alert('Inicia sesión o revisa tu dashboard de cliente para comprar.')">Comprar</button>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="card" style="padding: 1.25rem;">
                    <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: var(--radius-md); height: 170px; display: flex; align-items: center; justify-content: center; font-size: 4rem; margin-bottom: 1rem;">
                        ⌨️
                    </div>
                    <span class="badge badge-cliente" style="margin-bottom: 0.5rem; font-size: 0.7rem;">En Stock</span>
                    <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.35rem;">Teclado Mecánico RGB Pro</h4>
                    <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.75rem;">Switches ópticos rojos, conexión inalámbrica</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">$1,599</span>
                        <button class="btn btn-primary btn-sm" onclick="alert('Inicia sesión o revisa tu dashboard de cliente para comprar.')">Comprar</button>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="card" style="padding: 1.25rem;">
                    <div style="background: linear-gradient(135deg, #fce7f3, #fbcfe8); border-radius: var(--radius-md); height: 170px; display: flex; align-items: center; justify-content: center; font-size: 4rem; margin-bottom: 1rem;">
                        ⌚
                    </div>
                    <span class="badge badge-warning" style="margin-bottom: 0.5rem; font-size: 0.7rem;">Pocas Unidades</span>
                    <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.35rem;">Smartwatch Health Tracker V4</h4>
                    <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.75rem;">Monitor SpO2, GPS integrado, sumergible 50m</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">$3,150</span>
                        <button class="btn btn-primary btn-sm" onclick="alert('Inicia sesión o revisa tu dashboard de cliente para comprar.')">Comprar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios Corporativos -->
    <section style="background: white; padding: 4rem 0; border-top: 1px solid var(--border-color);">
        <div class="container">
            <div class="grid grid-cols-4">
                <div style="text-align: center; padding: 1rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🚚</div>
                    <h4 style="font-weight: 700; margin-bottom: 0.3rem;">Envíos Exprés</h4>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Entregas en 24 a 48 horas en todo el territorio nacional.</p>
                </div>
                <div style="text-align: center; padding: 1rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🔒</div>
                    <h4 style="font-weight: 700; margin-bottom: 0.3rem;">Pagos 100% Seguros</h4>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Cifrado bancario SSL de 256 bits y antifraude activo.</p>
                </div>
                <div style="text-align: center; padding: 1rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🔄</div>
                    <h4 style="font-weight: 700; margin-bottom: 0.3rem;">Garantía de 30 Días</h4>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Devoluciones sin complicaciones ni costos adicionales.</p>
                </div>
                <div style="text-align: center; padding: 1rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">💬</div>
                    <h4 style="font-weight: 700; margin-bottom: 0.3rem;">Soporte Técnico 24/7</h4>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Equipo humano listo para resolver cualquier duda.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
