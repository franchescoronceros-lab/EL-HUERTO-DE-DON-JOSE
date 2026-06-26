<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Gestiona el intento de autenticación del usuario.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validar estrictamente los datos de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirección estratégica según el rol del usuario
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Si es mozo (waiter), lo enviamos a la gestión de pedidos/mesas
            return redirect()->intended(route('waiter.dashboard'));
        }

        // 3. Si falla, regresar con un mensaje de error genérico (por seguridad)
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión de forma segura.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidar y regenerar el token CSRF de la sesión actual
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}