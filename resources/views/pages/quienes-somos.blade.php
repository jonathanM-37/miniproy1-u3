@extends('layouts.app')

@section('title', 'Quiénes Somos')

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="badge badge-info" style="margin-bottom: 0.5rem;">Conoce nuestra historia</span>
            <h1 class="page-title">Quiénes Somos</h1>
            <p class="page-description">Liderando la innovación en comercio electrónico y soluciones digitales de calidad.</p>
        </div>
    </div>

    <div class="container" style="padding-bottom: 4rem;">
        <div class="grid grid-cols-2" style="align-items: center; margin-bottom: 3.5rem;">
            <div>
                <span class="badge badge-cliente" style="margin-bottom: 0.75rem;">Trayectoria y Confianza</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-main);">
                    Más de una década conectando calidad con personas
                </h2>
                <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 1rem;">
                    <strong>TiendaOnline</strong> nació en 2015 con el objetivo de transformar las compras por internet en una experiencia ágil, transparente y accesible para todos. A lo largo de los años nos hemos consolidado como un referente en tecnología, accesorios y artículos para el hogar.
                </p>
                <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 1.5rem;">
                    Hoy contamos con centros de distribución inteligentes en las principales ciudades del país, un equipo operativo comprometido y una plataforma tecnológica robusta pensada para clientes, personal de despacho y directores.
                </p>
                <div style="display: flex; gap: 1.5rem;">
                    <div>
                        <div style="font-size: 1.8rem; font-weight: 800; color: var(--primary);">+50,000</div>
                        <div style="font-size: 0.85rem; color: var(--text-muted);">Clientes Satisfechos</div>
                    </div>
                    <div>
                        <div style="font-size: 1.8rem; font-weight: 800; color: var(--primary);">99.4%</div>
                        <div style="font-size: 0.85rem; color: var(--text-muted);">Envíos a Tiempo</div>
                    </div>
                    <div>
                        <div style="font-size: 1.8rem; font-weight: 800; color: var(--primary);">24/7</div>
                        <div style="font-size: 0.85rem; color: var(--text-muted);">Atención Personalizada</div>
                    </div>
                </div>
            </div>

            <div class="card" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; padding: 2.5rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🏢</div>
                <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 0.75rem;">Nuestro Compromiso Diario</h3>
                <p style="line-height: 1.7; opacity: 0.9; margin-bottom: 1.5rem;">
                    Cada pedido que procesamos representa la confianza de una persona o familia. Por eso, desde nuestros desarrolladores de software hasta nuestros operadores logísticos, trabajamos bajo un estándar riguroso de excelencia y calidez humana.
                </p>
                <div style="background: rgba(255, 255, 255, 0.15); border-radius: var(--radius-md); padding: 1rem;">
                    <div style="font-weight: 700; margin-bottom: 0.25rem;">💡 Arquitectura de Tres Niveles</div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">
                        Nuestra plataforma garantiza la separación segura entre clientes, operadores de despacho y gerentes administrativos.
                    </div>
                </div>
            </div>
        </div>

        <!-- Pilares Institucionales -->
        <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; text-align: center;">Nuestros Pilares</h3>
        <div class="grid grid-cols-3">
            <div class="card">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🤝</div>
                <h4 style="font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem;">Cercanía con el Cliente</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    Escuchamos activamente las sugerencias de nuestros compradores para optimizar continuamente la interfaz y el catálogo.
                </p>
            </div>
            <div class="card">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">⚡</div>
                <h4 style="font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem;">Velocidad y Precisión</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    Optimizamos la cadena de suministro para despachar en tiempo récord manteniendo la integridad del producto.
                </p>
            </div>
            <div class="card">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🛡️</div>
                <h4 style="font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem;">Seguridad y Privacidad</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    Protección absoluta de datos personales y credenciales bajo altos estándares de cifrado y cumplimiento legal.
                </p>
            </div>
        </div>
    </div>
@endsection
