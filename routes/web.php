<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - TiendaOnline E-Commerce
|--------------------------------------------------------------------------
| Aquí se registran todas las rutas web para la aplicación.
| Cumple con los requerimientos de la Lista de Verificación:
| - Página principal del sitio
| - Navegación de usuario anónimo (estáticas: Quiénes somos, Ubicación, Misión/Visión, Contacto)
| - Formulario y verificación de login
| - Formulario y registro de usuarios
| - Dashboards específicos según nivel de acceso (Cliente, Empleado, Gerente)
| - CRUD de Usuarios (Listado, Creación, Edición y Eliminación)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTAS PÚBLICAS Y NAVEGACIÓN ANÓNIMA
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('quienes-somos');
Route::get('/mision-vision', [HomeController::class, 'misionVision'])->name('mision-vision');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [HomeController::class, 'enviarContacto'])->name('contacto.enviar');

// ==========================================
// 2. RUTAS DE INVITADOS (LOGIN Y REGISTRO)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.post');
});

// ==========================================
// 3. RUTAS PROTEGIDAS (AUTENTICADOS)
// ==========================================
Route::middleware('auth')->group(function () {
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Enrutador inteligente de Dashboard general hacia el rol correspondiente
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ------------------------------------------
    // DASHBOARD: CLIENTE
    // ------------------------------------------
    Route::middleware('role:cliente,gerente')->group(function () {
        Route::get('/cliente/dashboard', [DashboardController::class, 'cliente'])->name('cliente.dashboard');
    });

    // ------------------------------------------
    // DASHBOARD: EMPLEADO
    // ------------------------------------------
    Route::middleware('role:empleado,gerente')->group(function () {
        Route::get('/empleado/dashboard', [DashboardController::class, 'empleado'])->name('empleado.dashboard');
    });

    // ------------------------------------------
    // DASHBOARD Y GESTIÓN: GERENTE (ADMINISTRADOR)
    // ------------------------------------------
    Route::middleware('role:gerente')->group(function () {
        Route::get('/gerente/dashboard', [DashboardController::class, 'gerente'])->name('gerente.dashboard');

        // CRUD COMPLETO DE USUARIOS
        Route::prefix('gerente/usuarios')->name('usuarios.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index'); // Código y vista para listar usuarios
            Route::get('/crear', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/editar', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
    });
});
