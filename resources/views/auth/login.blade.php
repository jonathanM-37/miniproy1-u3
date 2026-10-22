@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container-sm">
    <div class="auth-box">
        <div class="auth-header">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🔐</div>
            <h1 class="auth-title">Iniciar Sesión</h1>
            <p class="auth-subtitle">Ingresa tus credenciales para acceder a tu panel de usuario</p>
        </div>

        <!-- Credenciales Rápidas de Prueba para la Evaluación -->
        <div class="quick-credentials">
            <div class="quick-credentials-title">⚡ Clic para Autocompletar Cuenta de Prueba:</div>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="quick-btn" onclick="fillLogin('admin@tienda.com', 'password')">
                    👔 Gerente (Admin)
                </button>
                <button type="button" class="quick-btn" onclick="fillLogin('empleado@tienda.com', 'password')">
                    📦 Empleado
                </button>
                <button type="button" class="quick-btn" onclick="fillLogin('cliente@tienda.com', 'password')">
                    🛒 Cliente
                </button>
            </div>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico <span class="required">*</span></label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', request()->query('email')) }}" 
                       required autofocus placeholder="tu@email.com">
                @error('email')
                    <div class="form-feedback-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                    <label for="password" class="form-label" style="margin-bottom: 0;">Contraseña <span class="required">*</span></label>
                </div>
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror"
                       required placeholder="Ingresa tu contraseña">
                @error('password')
                    <div class="form-feedback-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer; color: var(--text-muted);">
                    <input type="checkbox" name="remember" id="remember" style="cursor: pointer;">
                    Recordar mi sesión
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 1rem;">
                🚀 Entrar al Sistema
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); font-size: 0.9rem; color: var(--text-muted);">
            ¿Aún no tienes cuenta? 
            <a href="{{ route('register') }}" style="font-weight: 700; color: var(--primary);">
                Regístrate aquí gratis
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function fillLogin(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endsection
