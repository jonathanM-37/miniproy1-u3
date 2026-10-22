@extends('layouts.app')

@section('title', 'Misión y Visión')

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="badge badge-info" style="margin-bottom: 0.5rem;">Dirección Estratégica</span>
            <h1 class="page-title">Misión, Visión y Valores</h1>
            <p class="page-description">Los principios que guían nuestras decisiones, desarrollo tecnológico y servicio a la comunidad.</p>
        </div>
    </div>

    <div class="container" style="padding-bottom: 4rem;">
        <div class="grid grid-cols-2" style="margin-bottom: 3rem;">
            <!-- Misión -->
            <div class="card" style="border-top: 4px solid var(--primary); padding: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="background: var(--primary-light); color: var(--primary); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        🎯
                    </div>
                    <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--text-main);">Nuestra Misión</h2>
                </div>
                <p style="color: var(--text-muted); line-height: 1.8; font-size: 1.05rem;">
                    Proveer a nuestros clientes una experiencia de compra en línea intuitiva, confiable y segura, ofreciendo productos de vanguardia con los mejores tiempos de entrega y una atención cercana y resolutiva, impulsada por tecnología moderna y talento comprometido.
                </p>
                <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid var(--border-color); font-size: 0.88rem; color: var(--text-muted);">
                    <strong>Foco central:</strong> Satisfacción total del cliente, eficiencia logística y transparencia.
                </div>
            </div>

            <!-- Visión -->
            <div class="card" style="border-top: 4px solid var(--secondary); padding: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="background: #e0f2fe; color: var(--secondary); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        🔭
                    </div>
                    <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--text-main);">Nuestra Visión 2030</h2>
                </div>
                <p style="color: var(--text-muted); line-height: 1.8; font-size: 1.05rem;">
                    Consolidarnos como el e-commerce líder y más confiable de la región, reconocido por la personalización de nuestros servicios, la automatización ética de la cadena logística y un impacto positivo en las comunidades donde operamos.
                </p>
                <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid var(--border-color); font-size: 0.88rem; color: var(--text-muted);">
                    <strong>Aspiración:</strong> Redefinir el estándar de entrega y trazabilidad en el comercio digital.
                </div>
            </div>
        </div>

        <!-- Valores Corporativos -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <span class="badge badge-warning" style="margin-bottom: 0.5rem;">Cultura de Excelencia</span>
            <h3 style="font-size: 1.75rem; font-weight: 800;">Valores que Vivimos a Diario</h3>
        </div>

        <div class="grid grid-cols-4">
            <div class="card" style="text-align: center;">
                <div style="font-size: 2.25rem; margin-bottom: 0.5rem;">💎</div>
                <h4 style="font-weight: 700; font-size: 1.05rem; margin-bottom: 0.4rem;">Integridad</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem; line-height: 1.6;">
                    Actuamos con honestidad, transparencia y cumplimiento irrestricto de nuestras promesas.
                </p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.25rem; margin-bottom: 0.5rem;">🚀</div>
                <h4 style="font-weight: 700; font-size: 1.05rem; margin-bottom: 0.4rem;">Innovación Continua</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem; line-height: 1.6;">
                    Adoptamos tecnologías ágiles para resolver con rapidez las necesidades del mercado.
                </p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.25rem; margin-bottom: 0.5rem;">🌟</div>
                <h4 style="font-weight: 700; font-size: 1.05rem; margin-bottom: 0.4rem;">Calidad Superior</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem; line-height: 1.6;">
                    Inspección meticulosa en cada artículo y proceso logístico antes del envío final.
                </p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.25rem; margin-bottom: 0.5rem;">🌱</div>
                <h4 style="font-weight: 700; font-size: 1.05rem; margin-bottom: 0.4rem;">Responsabilidad</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem; line-height: 1.6;">
                    Compromiso con la sustentabilidad y empaques ecológicos 100% reciclables.
                </p>
            </div>
        </div>
    </div>
@endsection
