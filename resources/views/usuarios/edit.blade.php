@extends('layouts.app')

@section('title', 'Editar Usuario - CRUD')

@section('content')
<div class="page-header">
    <div class="container">
        <span class="badge badge-gerente" style="margin-bottom: 0.5rem;">Módulo de Administración</span>
        <h1 class="page-title">Editar Usuario: {{ $user->name }}</h1>
        <p class="page-description">Actualiza la información del perfil o reasigna el nivel de acceso.</p>
    </div>
</div>

<div class="container-md" style="padding-bottom: 4rem;">
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Modificar Información</h2>
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.2rem;">
                    Usuario ID: #{{ $user->id }} • Registrado el {{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}
                </div>
            </div>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
                ← Volver al Listado
            </a>
        </div>

        <form action="{{ route('usuarios.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2">
                <!-- Nombre -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo <span class="required">*</span></label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico <span class="required">*</span></label>
                    <input type="email" name="email" id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" required>
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
                        @foreach($rolesDisponibles as $key => $label)
                            <option value="{{ $key }}" {{ old('role', $user->role) === $key ? 'selected' : '' }}>
                                {{ $label }} ({{ ucfirst($key) }})
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" name="phone" id="phone" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', $user->phone) }}" placeholder="+52 55 1234 5678">
                    @error('phone')
                        <div class="form-feedback-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" name="address" id="address" 
                       class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address', $user->address) }}">
                @error('address')
                    <div class="form-feedback-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="background: var(--bg-subtle); padding: 1.25rem; border-radius: var(--radius-md); margin-top: 1rem; margin-bottom: 1.5rem;">
                <div style="font-weight: 700; margin-bottom: 0.25rem;">🔑 Cambio de Contraseña (Opcional)</div>
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                    Deja estos campos vacíos si deseas conservar la contraseña actual del usuario.
                </div>

                <div class="grid grid-cols-2">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Mínimo 6 caracteres si se cambia">
                        @error('password')
                            <div class="form-feedback-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control" placeholder="Repite la nueva contraseña">
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
