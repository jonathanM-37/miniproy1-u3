@extends('layouts.app')

@section('title', 'Crear Usuario - CRUD')

@section('content')
<div class="page-header">
    <div class="container">
        <span class="badge badge-gerente" style="margin-bottom: 0.5rem;">Módulo de Administración</span>
        <h1 class="page-title">Crear Nuevo Usuario</h1>
        <p class="page-description">Registra un nuevo usuario en el sistema y asígnale su nivel de acceso (Cliente, Empleado o Gerente).</p>
    </div>
</div>

<div class="container-md" style="padding-bottom: 4rem;">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Datos de la Cuenta</h2>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
                ← Cancelar y Volver
            </a>
        </div>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2">
                <!-- Nombre -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo <span class="required">*</span></label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required autofocus placeholder="Ej. Roberto Méndez">
                    @error('name')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico <span class="required">*</span></label>
                    <input type="email" name="email" id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required placeholder="usuario@tienda.com">
                    @error('email')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2">
                <!-- Rol de Acceso -->
                <div class="form-group">
                    <label for="role" class="form-label">Nivel de Acceso (Rol) <span class="required">*</span></label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">Selecciona el rol correspondiente...</option>
                        @foreach($rolesDisponibles as $key => $label)
                            <option value="{{ $key }}" {{ old('role') === $key ? 'selected' : '' }}>
                                {{ $label }} ({{ ucfirst($key) }})
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint">Determina a qué dashboard y permisos tendrá acceso el usuario.</div>
                    @error('role')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone" class="form-label">Teléfono (Opcional)</label>
                    <input type="text" name="phone" id="phone" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone') }}" placeholder="+52 55 1234 5678">
                    @error('phone')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Dirección (Opcional)</label>
                <input type="text" name="address" id="address" 
                       class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address') }}" placeholder="Calle, número, colonia, ciudad">
                @error('address')
                    <div class="form-feedback-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-2">
                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña <span class="required">*</span></label>
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           required placeholder="Mínimo 6 caracteres">
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

            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Guardar y Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
