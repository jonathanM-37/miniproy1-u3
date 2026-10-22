<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcommerceChecklistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Páginas públicas y navegación de usuario anónimo.
     */
    public function test_anonymous_user_can_access_home_and_static_pages(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('TiendaOnline');
        $this->get(route('quienes-somos'))->assertOk()->assertSee('Quiénes Somos');
        $this->get(route('mision-vision'))->assertOk()->assertSee('Misión y Visión');
        $this->get(route('ubicacion'))->assertOk()->assertSee('Ubicación');
        $this->get(route('contacto'))->assertOk()->assertSee('Contáctanos');
    }

    /**
     * 2. Formulario de inicio de sesión.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertSee('Iniciar Sesión');
    }

    /**
     * 3. Validación de datos en inicio de sesión.
     */
    public function test_login_validation_requires_credentials(): void
    {
        $response = $this->post(route('login.post'), []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /**
     * 4. Redirección de login por rol: Gerente.
     */
    public function test_gerente_is_redirected_to_gerente_dashboard_on_login(): void
    {
        $gerente = User::factory()->gerente()->create([
            'email' => 'gerente_test@tienda.com',
            'password' => 'password123',
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'gerente_test@tienda.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($gerente);
        $response->assertRedirect(route('gerente.dashboard'));
    }

    /**
     * 5. Redirección de login por rol: Empleado.
     */
    public function test_empleado_is_redirected_to_empleado_dashboard_on_login(): void
    {
        $empleado = User::factory()->empleado()->create([
            'email' => 'empleado_test@tienda.com',
            'password' => 'password123',
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'empleado_test@tienda.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($empleado);
        $response->assertRedirect(route('empleado.dashboard'));
    }

    /**
     * 6. Redirección de login por rol: Cliente.
     */
    public function test_cliente_is_redirected_to_cliente_dashboard_on_login(): void
    {
        $cliente = User::factory()->cliente()->create([
            'email' => 'cliente_test@tienda.com',
            'password' => 'password123',
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'cliente_test@tienda.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($cliente);
        $response->assertRedirect(route('cliente.dashboard'));
    }

    /**
     * 7. Cerrar sesión.
     */
    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->cliente()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }

    /**
     * 8. Formulario y validación de registro de usuarios.
     */
    public function test_registration_validation_rules(): void
    {
        $response = $this->post(route('register.post'), [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => 'mismatch',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * 9. Registro asigna rol cliente y redirige a su dashboard.
     */
    public function test_user_can_register_and_defaults_to_cliente_role(): void
    {
        $response = $this->post(route('register.post'), [
            'name' => 'Nuevo Cliente de Prueba',
            'email' => 'nuevo_cliente@example.com',
            'password' => 'secreto123',
            'password_confirmation' => 'secreto123',
            'phone' => '+52 55 1111 2222',
            'address' => 'Av. Reforma 100, CDMX',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'nuevo_cliente@example.com',
            'role' => User::ROLE_CLIENTE,
        ]);

        $user = User::where('email', 'nuevo_cliente@example.com')->first();
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('cliente.dashboard'));
    }

    /**
     * 10. Control de acceso por roles en rutas protegidas.
     */
    public function test_clients_cannot_access_gerente_dashboard_or_crud(): void
    {
        $cliente = User::factory()->cliente()->create();

        $response = $this->actingAs($cliente)->get(route('gerente.dashboard'));
        $response->assertStatus(403);

        $crudResponse = $this->actingAs($cliente)->get(route('usuarios.index'));
        $crudResponse->assertStatus(403);
    }

    /**
     * 11. CRUD de Usuarios: Listar usuarios.
     */
    public function test_gerente_can_list_users(): void
    {
        $gerente = User::factory()->gerente()->create();
        $otroUsuario = User::factory()->cliente()->create(['name' => 'Usuario Observable']);

        $response = $this->actingAs($gerente)->get(route('usuarios.index'));

        $response->assertOk();
        $response->assertSee('Listado de Usuarios (CRUD)');
        $response->assertSee('Usuario Observable');
    }

    /**
     * 12. CRUD de Usuarios: Crear usuario con rol asignado.
     */
    public function test_gerente_can_create_user_with_role(): void
    {
        $gerente = User::factory()->gerente()->create();

        $response = $this->actingAs($gerente)->post(route('usuarios.store'), [
            'name' => 'Empleado Creado por Gerente',
            'email' => 'empleado_nuevo@tienda.com',
            'role' => User::ROLE_EMPLEADO,
            'password' => 'segura123',
            'password_confirmation' => 'segura123',
            'phone' => '555-4321',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'empleado_nuevo@tienda.com',
            'role' => User::ROLE_EMPLEADO,
        ]);

        $response->assertRedirect(route('usuarios.index'));
    }

    /**
     * 13. CRUD de Usuarios: Editar usuario.
     */
    public function test_gerente_can_update_user(): void
    {
        $gerente = User::factory()->gerente()->create();
        $targetUser = User::factory()->cliente()->create([
            'name' => 'Nombre Antiguo',
            'email' => 'antiguo@tienda.com',
        ]);

        $response = $this->actingAs($gerente)->put(route('usuarios.update', $targetUser), [
            'name' => 'Nombre Modificado',
            'email' => 'modificado@tienda.com',
            'role' => User::ROLE_EMPLEADO,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Nombre Modificado',
            'email' => 'modificado@tienda.com',
            'role' => User::ROLE_EMPLEADO,
        ]);

        $response->assertRedirect(route('usuarios.index'));
    }

    /**
     * 14. CRUD de Usuarios: Eliminar usuario.
     */
    public function test_gerente_can_delete_user(): void
    {
        $gerente = User::factory()->gerente()->create();
        $targetUser = User::factory()->cliente()->create();

        $response = $this->actingAs($gerente)->delete(route('usuarios.destroy', $targetUser));

        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
        $response->assertRedirect(route('usuarios.index'));
    }

    /**
     * 15. CRUD de Usuarios: Gerente no puede eliminarse a sí mismo.
     */
    public function test_gerente_cannot_delete_themselves(): void
    {
        $gerente = User::factory()->gerente()->create();

        $response = $this->actingAs($gerente)->delete(route('usuarios.destroy', $gerente));

        $this->assertDatabaseHas('users', ['id' => $gerente->id]);
        $response->assertRedirect(route('usuarios.index'));
    }
}
