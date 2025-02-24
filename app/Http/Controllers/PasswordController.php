<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showExpiredForm()
    {
        $user = auth()->user();

        return view('auth.passwords.reset', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email', // Asegurarse de que el email sea válido
            'password' => 'required|min:8|confirmed', // Validar la contraseña y su confirmación
        ]);

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar que el email proporcionado coincida con el email del usuario autenticado
        // if ($request->email !== $user->email) {
        //     return redirect()->back()->withErrors([
        //         'email' => 'El email proporcionado no coincide con el email del usuario autenticado.',
        //     ]);
        // }

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.inicio-Usuario.index')->with('success', 'Contraseña actualizada correctamente.');
    }
}
