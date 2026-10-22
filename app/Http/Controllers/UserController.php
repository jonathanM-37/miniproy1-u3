<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Muestra la lista paginada de usuarios con filtros de búsqueda y rol.
     * (Cumple con: Código para listar usuarios & Vista Blade para listar usuarios)
     */
    public function index(Request $request): View
    {
        $busqueda = $request->query('buscar');
        $filtroRol = $request->query('rol');

        $query = User::query();

        if (! empty($busqueda)) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('name', 'like', "%{$busqueda}%")
                    ->orWhere('email', 'like', "%{$busqueda}%")
                    ->orWhere('phone', 'like', "%{$busqueda}%");
            });
        }

        if (! empty($filtroRol) && in_array($filtroRol, [User::ROLE_CLIENTE, User::ROLE_EMPLEADO, User::ROLE_GERENTE], true)) {
            $query->where('role', $filtroRol);
        }

        $usuarios = $query->latest('id')->paginate(10)->withQueryString();

        $totales = [
            'total' => User::count(),
            'clientes' => User::where('role', User::ROLE_CLIENTE)->count(),
            'empleados' => User::where('role', User::ROLE_EMPLEADO)->count(),
            'gerentes' => User::where('role', User::ROLE_GERENTE)->count(),
        ];

        return view('usuarios.index', compact('usuarios', 'busqueda', 'filtroRol', 'totales'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create(): View
    {
        $rolesDisponibles = [
            User::ROLE_CLIENTE => 'Cliente',
            User::ROLE_EMPLEADO => 'Empleado',
            User::ROLE_GERENTE => 'Gerente',
        ];

        return view('usuarios.create', compact('rolesDisponibles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos con sus validaciones.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'role' => ['required', 'string', Rule::in([User::ROLE_CLIENTE, User::ROLE_EMPLEADO, User::ROLE_GERENTE])],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está registrado por otro usuario.',
            'role.required' => 'Debes seleccionar un rol de acceso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario "'.$validated['name'].'" creado exitosamente con el rol de '.ucfirst($validated['role']).'.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user): View
    {
        $rolesDisponibles = [
            User::ROLE_CLIENTE => 'Cliente',
            User::ROLE_EMPLEADO => 'Empleado',
            User::ROLE_GERENTE => 'Gerente',
        ];

        return view('usuarios.edit', compact('user', 'rolesDisponibles'));
    }

    /**
     * Actualiza la información del usuario en la base de datos.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in([User::ROLE_CLIENTE, User::ROLE_EMPLEADO, User::ROLE_GERENTE])],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya pertenece a otro usuario.',
            'password.min' => 'Si deseas cambiar la contraseña, debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $datosActualizar = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ];

        if (! empty($validated['password'])) {
            $datosActualizar['password'] = Hash::make($validated['password']);
        }

        $user->update($datosActualizar);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario "'.$user->name.'" actualizado correctamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user): RedirectResponse
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propia cuenta de gerente mientras estés en sesión.');
        }

        $nombre = $user->name;
        $user->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'El usuario "'.$nombre.'" fue eliminado del sistema.');
    }
}
