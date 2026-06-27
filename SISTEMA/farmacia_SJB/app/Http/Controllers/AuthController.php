<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        // Si el usuario ya está autenticado, redirigir a su dashboard correspondiente
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('waiter.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Procesa el intento de autenticación.
     */
    public function login(Request $request)
    {
        // 1. Validar estrictamente los datos de entrada
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Intentar autenticar contra la base de datos
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            
            // 3. Mitigación de seguridad: Regenerar ID de sesión para prevenir fijación de sesión
            $request->session()->regenerate();

            // 4. Redirección semántica basada en el rol del usuario (Admin / Waiter)
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            if (Auth::user()->role === 'waiter') {
                return redirect()->intended(route('waiter.dashboard'));
            }
        }

        // 5. Fallo de autenticación: retornar con error específico
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }

    /**
     * Cierra la sesión del usuario de forma segura (Destrucción total).
     */
    public function logout(Request $request)
    {
        // 1. Desautenticar al usuario en el framework
        Auth::logout();

        // 2. Invalidar la sesión del servidor para borrar los datos
        $request->session()->invalidate();

        // 3. Regenerar el token CSRF para mitigar ataques de reutilización de formularios
        $request->session()->regenerateToken();

        // 4. Redirección segura a la pantalla de login
        return redirect()->route('login');
    }
}