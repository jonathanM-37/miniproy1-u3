@extends('layouts.app')

@section('title', 'Nuestra Ubicación')

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="badge badge-info" style="margin-bottom: 0.5rem;">Presencia Nacional</span>
            <h1 class="page-title">Ubicación y Centros de Operaciones</h1>
            <p class="page-description">Encuentra nuestras oficinas corporativas, tiendas físicas y centros de distribución logística.</p>
        </div>
    </div>

    <div class="container" style="padding-bottom: 4rem;">
        <!-- Visualizador de Mapa / Hub Central -->
        <div class="card" style="margin-bottom: 3rem; overflow: hidden; padding: 0;">
            <div style="background: linear-gradient(135deg, #1e293b, #0f172a); color: white; padding: 2.5rem; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">📍</div>
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">Sede Central y Hub Logístico</h3>
                <p style="color: #94a3b8; max-width: 600px; margin: 0 auto 1.5rem;">
                    Av. Insurgentes Sur 1234, Piso 8, Colonia Del Valle, Alcaldía Benito Juárez, Ciudad de México, C.P. 03100.
                </p>
                <div style="display: inline-flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                    <span class="badge badge-success">● Abierto Hoy: 8:00 AM - 8:00 PM</span>
                    <span class="badge badge-info">Punto de Entrega Rápida</span>
                    <span class="badge badge-warning">Atención a Mayoristas</span>
                </div>
            </div>

            <!-- Mapa Estilizado SVG / Canvas UI -->
            <div style="background: #f1f5f9; padding: 2.5rem; text-align: center; border-top: 1px solid var(--border-color);">
                <div style="max-width: 700px; margin: 0 auto; background: white; padding: 1.5rem; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); border: 1px solid var(--border-color);">
                    <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 1rem; text-align: left;">
                        <div>
                            <div style="font-weight: 700; color: var(--primary);">🚆 Metro Cercano</div>
                            <div style="color: var(--text-muted); font-size: 0.88rem;">Estación Insurgentes Sur (Línea 12) a 150m</div>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--primary);">🚗 Estacionamiento</div>
                            <div style="color: var(--text-muted); font-size: 0.88rem;">Gratuito 2 horas para clientes</div>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--primary);">📦 Recolección Pickup</div>
                            <div style="color: var(--text-muted); font-size: 0.88rem;">Ventanilla directa sin filas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sucursales Regionales -->
        <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem;">Nuestras Sucursales Principales</h3>
        <div class="grid grid-cols-3">
            <!-- CDMX -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span class="badge badge-cliente">Sede Principal</span>
                    <span style="font-size: 1.25rem;">🇲🇽</span>
                </div>
                <h4 style="font-weight: 700; font-size: 1.15rem; margin-bottom: 0.5rem;">Ciudad de México</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem;">
                    Av. Insurgentes Sur 1234, Benito Juárez<br>
                    <strong>Teléfono:</strong> (55) 5555-1234<br>
                    <strong>Email:</strong> cdmx@tiendaonline.com
                </p>
                <div style="font-size: 0.82rem; color: var(--primary); font-weight: 600;">
                    Horario: Lun - Sáb (8:00 - 20:00 hrs)
                </div>
            </div>

            <!-- Guadalajara -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span class="badge badge-empleado">Hub Occidente</span>
                    <span style="font-size: 1.25rem;">🇲🇽</span>
                </div>
                <h4 style="font-weight: 700; font-size: 1.15rem; margin-bottom: 0.5rem;">Guadalajara, Jalisco</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem;">
                    Av. Américas 1500, Providencia<br>
                    <strong>Teléfono:</strong> (33) 3333-5678<br>
                    <strong>Email:</strong> gdl@tiendaonline.com
                </p>
                <div style="font-size: 0.82rem; color: var(--primary); font-weight: 600;">
                    Horario: Lun - Sáb (9:00 - 19:00 hrs)
                </div>
            </div>

            <!-- Monterrey -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span class="badge badge-gerente">Hub Norte</span>
                    <span style="font-size: 1.25rem;">🇲🇽</span>
                </div>
                <h4 style="font-weight: 700; font-size: 1.15rem; margin-bottom: 0.5rem;">Monterrey, N.L.</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem;">
                    Calzada San Pedro 250, Del Valle<br>
                    <strong>Teléfono:</strong> (81) 8181-9012<br>
                    <strong>Email:</strong> mty@tiendaonline.com
                </p>
                <div style="font-size: 0.82rem; color: var(--primary); font-weight: 600;">
                    Horario: Lun - Sáb (9:00 - 19:00 hrs)
                </div>
            </div>
        </div>
    </div>
@endsection
