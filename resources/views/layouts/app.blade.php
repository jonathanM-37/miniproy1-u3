<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inicio') - TiendaOnline E-Commerce</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('styles')
</head>
<body>
    <!-- Header y Navegación Principal -->
    <header class="site-header">
        <div class="container">
            <nav class="navbar">
                <!-- Logotipo -->
                <a href="{{ route('home') }}" class="brand">
                    <span class="brand-icon">🛍️</span>
                    <span>Tienda<span style="color: var(--primary);">Online</span></span>
                </a>

                <!-- Navegación de páginas públicas (para todos y anónimos) -->
                <ul class="nav-links">
                    <li>
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quienes-somos') }}" class="nav-link {{ request()->routeIs('quienes-somos') ? 'active' : '' }}">
                            Quiénes Somos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mision-vision') }}" class="nav-link {{ request()->routeIs('mision-vision') ? 'active' : '' }}">
                            Misión y Visión
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubicacion') }}" class="nav-link {{ request()->routeIs('ubicacion') ? 'active' : '' }}">
                            Ubicación
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacto') }}" class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}">
                            Contacto
                        </a>
                    </li>
                </ul>

                <!-- Acciones de Usuario (Invitado vs Autenticado) -->
                <div class="nav-actions">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            Registrarse
                        </a>
                    @else
                        <!-- Dashboard según rol -->
                        @if(Auth::user()->isGerente())
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm" title="CRUD de Usuarios">
                                👥 Usuarios
                            </a>
                        @endif

                        <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm">
                            📊 Mi Panel
                        </a>

                        <!-- Badge de Rol y Nombre de Usuario -->
                        <span class="badge {{ Auth::user()->role_badge_class }}">
                            {{ Auth::user()->role_label }}
                        </span>

                        <span style="font-weight: 600; font-size: 0.88rem; color: var(--text-main);">
                            {{ Auth::user()->name }}
                        </span>

                        <!-- Botón de Cerrar Sesión -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" title="Cerrar sesión">
                                🚪 Salir
                            </button>
                        </form>
                    @endguest
                </div>
            </nav>
        </div>
    </header>

    <!-- Contenedor de Mensajes Flash y Alertas -->
    <div class="container" style="margin-top: 1.5rem;">
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <span>⚠️</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(session('info') || session('status'))
            <div class="alert alert-info">
                <span>ℹ️</span>
                <div>{{ session('info') ?? session('status') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <span>⚠️</span>
                <div>
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul style="margin-top: 0.4rem; margin-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <!-- Contenido Dinámico de la Vista -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Corporativo -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="brand" style="color: white; margin-bottom: 1rem;">
                        <span class="brand-icon">🛍️</span>
                        <span>TiendaOnline</span>
                    </div>
                    <p style="line-height: 1.6; margin-bottom: 1.2rem; color: #94a3b8;">
                        Plataforma integral de comercio electrónico diseñada para brindar la mejor experiencia en compras, gestión operativa y administración integral con control de acceso por roles.
                    </p>
                    <div style="display: flex; gap: 0.5rem;">
                        <span class="badge badge-gerente">Gerente</span>
                        <span class="badge badge-empleado">Empleado</span>
                        <span class="badge badge-cliente">Cliente</span>
                    </div>
                </div>

                <div>
                    <h4 class="footer-title">Empresa</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('quienes-somos') }}">Quiénes Somos</a></li>
                        <li><a href="{{ route('mision-vision') }}">Misión y Visión</a></li>
                        <li><a href="{{ route('ubicacion') }}">Ubicación y Sucursales</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto y Soporte</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Acceso</h4>
                    <ul class="footer-links">
                        @guest
                            <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                            <li><a href="{{ route('register') }}">Crear Cuenta</a></li>
                        @else
                            <li><a href="{{ route('dashboard') }}">Mi Dashboard</a></li>
                            @if(Auth::user()->isGerente())
                                <li><a href="{{ route('usuarios.index') }}">CRUD de Usuarios</a></li>
                            @endif
                        @endguest
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Atención al Cliente</h4>
                    <p style="margin-bottom: 0.5rem; color: #cbd5e1;">📞 800-843-6320</p>
                    <p style="margin-bottom: 0.5rem; color: #cbd5e1;">✉️ soporte@tiendaonline.com</p>
                    <p style="color: #94a3b8; font-size: 0.85rem;">Lunes a Sábado: 8:00 AM - 8:00 PM</p>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    &copy; {{ date('Y') }} TiendaOnline E-Commerce. Todos los derechos reservados.
                </div>
                <div>
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
