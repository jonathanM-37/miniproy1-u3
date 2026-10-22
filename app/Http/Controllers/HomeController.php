<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página principal de la tienda (accesible para todos).
     */
    public function index(): View
    {
        return view('pages.home');
    }

    /**
     * Sección estática: Quiénes somos.
     */
    public function quienesSomos(): View
    {
        return view('pages.quienes-somos');
    }

    /**
     * Sección estática: Misión y Visión.
     */
    public function misionVision(): View
    {
        return view('pages.mision-vision');
    }

    /**
     * Sección estática: Ubicación y sucursales.
     */
    public function ubicacion(): View
    {
        return view('pages.ubicacion');
    }

    /**
     * Sección estática: Contáctanos.
     */
    public function contacto(): View
    {
        return view('pages.contacto');
    }

    /**
     * Procesar formulario de contacto.
     */
    public function enviarContacto(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|max:2000',
        ]);

        return redirect()->route('contacto')
            ->with('success', '¡Gracias por comunicarte con nosotros, '.e($validated['nombre']).'! Hemos recibido tu mensaje.');
    }
}
