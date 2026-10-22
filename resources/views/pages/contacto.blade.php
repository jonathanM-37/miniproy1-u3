@extends('layouts.app')

@section('title', 'Contáctanos')

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="badge badge-info" style="margin-bottom: 0.5rem;">Canales de Atención</span>
            <h1 class="page-title">Contáctanos</h1>
            <p class="page-description">Estamos a tu disposición para dudas sobre pedidos, cotizaciones mayoristas o soporte técnico.</p>
        </div>
    </div>

    <div class="container" style="padding-bottom: 4rem;">
        <div class="grid grid-cols-2">
            <!-- Formulario de Contacto -->
            <div class="card">
                <h3 style="font-size: 1.35rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--text-main);">
                    Envíanos un Mensaje
                </h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                    Completa el formulario y un asesor responderá en menos de 2 horas hábiles.
                </p>

                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nombre" class="form-label">Tu Nombre Completo <span class="required">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', Auth::user()?->name) }}" required placeholder="Ej. Juan Pérez">
                        @error('nombre')
                            <div class="form-feedback-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico <span class="required">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', Auth::user()?->email) }}" required placeholder="tu@email.com">
                        @error('email')
                            <div class="form-feedback-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="asunto" class="form-label">Asunto <span class="required">*</span></label>
                        <select name="asunto" id="asunto" class="form-select @error('asunto') is-invalid @enderror" required>
                            <option value="">Selecciona una opción...</option>
                            <option value="Consulta sobre un pedido" {{ old('asunto') == 'Consulta sobre un pedido' ? 'selected' : '' }}>Consulta sobre un pedido</option>
                            <option value="Cotización al por mayor" {{ old('asunto') == 'Cotización al por mayor' ? 'selected' : '' }}>Cotización al por mayor</option>
                            <option value="Soporte técnico y devoluciones" {{ old('asunto') == 'Soporte técnico y devoluciones' ? 'selected' : '' }}>Soporte técnico y devoluciones</option>
                            <option value="Facturación y pagos" {{ old('asunto') == 'Facturación y pagos' ? 'selected' : '' }}>Facturación y pagos</option>
                            <option value="Otro asunto" {{ old('asunto') == 'Otro asunto' ? 'selected' : '' }}>Otro asunto</option>
                        </select>
                        @error('asunto')
                            <div class="form-feedback-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mensaje" class="form-label">Mensaje o Detalle <span class="required">*</span></label>
                        <textarea name="mensaje" id="mensaje" rows="4" class="form-control @error('mensaje') is-invalid @enderror" 
                                  required placeholder="Escribe aquí tu consulta con el mayor detalle posible...">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <div class="form-feedback-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        📨 Enviar Mensaje
                    </button>
                </form>
            </div>

            <!-- Canales Directos de Atención -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div class="card" style="border-left: 4px solid var(--primary);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                        <span style="font-size: 2rem;">💬</span>
                        <div>
                            <h4 style="font-weight: 700; font-size: 1.1rem;">WhatsApp Corporativo</h4>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">Atención inmediata de 8:00 AM a 8:00 PM</p>
                        </div>
                    </div>
                    <div style="font-size: 1.1rem; font-weight: 700; color: var(--primary);">+52 55 9876 5432</div>
                </div>

                <div class="card" style="border-left: 4px solid var(--secondary);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                        <span style="font-size: 2rem;">✉️</span>
                        <div>
                            <h4 style="font-weight: 700; font-size: 1.1rem;">Correo Electrónico</h4>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">Respuestas detalladas y cotizaciones</p>
                        </div>
                    </div>
                    <div style="font-size: 1.1rem; font-weight: 700; color: var(--secondary);">contacto@tiendaonline.com</div>
                </div>

                <div class="card" style="border-left: 4px solid var(--success);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                        <span style="font-size: 2rem;">📞</span>
                        <div>
                            <h4 style="font-weight: 700; font-size: 1.1rem;">Línea Gratuita 800</h4>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">Sin costo desde cualquier teléfono de México</p>
                        </div>
                    </div>
                    <div style="font-size: 1.1rem; font-weight: 700; color: var(--success);">800-843-6320</div>
                </div>

                <div class="card" style="background: var(--bg-subtle);">
                    <h4 style="font-weight: 700; margin-bottom: 0.5rem;">⏱️ Horarios de Operación</h4>
                    <ul style="list-style: none; color: var(--text-muted); font-size: 0.88rem; line-height: 1.8;">
                        <li><strong>Lunes a Viernes:</strong> 8:00 hrs a 20:00 hrs</li>
                        <li><strong>Sábados:</strong> 9:00 hrs a 15:00 hrs</li>
                        <li><strong>Domingos y Días Festivos:</strong> Guardia de soporte vía correo</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
