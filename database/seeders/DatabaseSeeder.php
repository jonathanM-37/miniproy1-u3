<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gerente principal
        User::firstOrCreate(
            ['email' => 'admin@tienda.com'],
            [
                'name' => 'Carlos Administrador',
                'password' => 'password',
                'role' => User::ROLE_GERENTE,
                'phone' => '+52 55 1234 5678',
                'address' => 'Av. Insurgentes Sur 123, CDMX',
                'email_verified_at' => now(),
            ]
        );

        // Empleado principal
        User::firstOrCreate(
            ['email' => 'empleado@tienda.com'],
            [
                'name' => 'Juan Empleado',
                'password' => 'password',
                'role' => User::ROLE_EMPLEADO,
                'phone' => '+52 55 8765 4321',
                'address' => 'Calle Reforma 456, Guadalajara',
                'email_verified_at' => now(),
            ]
        );

        // Cliente principal
        User::firstOrCreate(
            ['email' => 'cliente@tienda.com'],
            [
                'name' => 'María Cliente',
                'password' => 'password',
                'role' => User::ROLE_CLIENTE,
                'phone' => '+52 81 2345 6789',
                'address' => 'Blvd. Constitución 789, Monterrey',
                'email_verified_at' => now(),
            ]
        );

        // Usuarios adicionales para demostración y paginación en el CRUD
        User::factory()->count(4)->cliente()->create();
        User::factory()->count(2)->empleado()->create();
    }
}
