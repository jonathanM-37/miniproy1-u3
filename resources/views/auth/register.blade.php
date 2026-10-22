@extends('layouts.app')

@section('title', 'Crear Cuenta de Cliente')

@section('content')
<div class="container-md">
    <div class="auth-box">
        <div class="auth-header">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📝</div>
            <h1 class="auth-title">Crear Cuenta Nueva</h1>
            <p class="auth-subtitle">Regístrate para comprar en TiendaOnline y acceder a tu panel de cliente</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2">
                <!-- Nombre -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo <span class="required">*</span></label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required autofocus placeholder="Ej. Ana Gómez Martínez">
                    @error('name')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico <span class="required">*</span></label>
                    <input type="email" name="email" id="email" 
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required placeholder="ana.gomez@email.com">
                    @error('email')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2">
                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone" class="form-label">Teléfono de Contacto (Opcional)</label>
                    <input type="text" name="phone" id="phone" 
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}" placeholder="+52 55 1234 5678">
                    @error('phone')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="form-group">
                    <label for="address" class="form-label">Dirección de Entrega (Opcional)</label>
                    <input type="text" name="address" id="address" 
                           class="form-control @error('address') is-invalid @enderror"
                           value="{{ old('address') }}" placeholder="Calle, número, colonia, CP">
                    @error('address')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2">
                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña <span class="required">*</span></label>
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror"
                           required placeholder="Mínimo 6 caracteres">
                    <div class="form-hint">Mínimo 6 caracteres alfanuméricos</div>
                    @error('password')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña <span class="required">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="form-control" required placeholder="Repite la contraseña">
                </div>
            </div>

            <div style="background: var(--bg-subtle); padding: 0.85rem; border-radius: var(--radius-md); font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                🛡️ <strong>Nivel de acceso asignado:</strong> Al registrarte en esta sección obtendrás automáticamente una cuenta de <strong>Cliente</strong> con acceso directo al catálogo, seguimiento de pedidos y ofertas exclusivas.
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">
                ✨ Completar Registro
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); font-size: 0.9rem; color: var(--text-muted);">
            ¿Ya tienes una cuenta registrada? 
            <a href="{{ route('login') }}" style="font-weight: 700; color: var(--primary);">
                Inicia sesión aquí
            </a>
        </div>
    </div>
</div>
@endsection
