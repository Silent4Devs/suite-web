<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Asegúrate de importar el modelo User

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
            'email' => 'required|email|exists:users,email', // Asegurarse de que el email sea válido y exista en la base de datos
            'password' => 'required|min:8|confirmed', // Validar la contraseña y su confirmación
        ]);

        // Buscar al usuario por su email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'El correo electrónico no existe.'])->withInput();
        }

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.inicio-Usuario.index')->with('success', 'Contraseña actualizada correctamente.');
    }
}
