<?php

namespace App\Http\Controllers\Api\Tenant\User;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\TbTenantUserModel;
use Illuminate\Support\Facades\DB;

class TbTenantUserController extends TbTenantBaseController
{
    public function tbRegister(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = TbTenantUserModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $this->tbSendResponse(['user' => $user], 'User correcto.');
        } catch (\Exception $e) {
            return $this->tbSendError(__('es.Tenant.errors.generic_error'), ['error' => $e->getMessage()]);
        }
    }

    public function tbDeleteUser(Request $request, $id)
    {
        $user = TbTenantUserModel::find($id);

        if (!$user) {
            return $this->tbSendError('Usuario no encontrado.', ['error' => 'ID del usuario mal']);
        }

        $user->delete();

        return $this->tbSendResponse([], 'Usuario eliminado corectamente.');
    }
}
