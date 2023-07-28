<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;

class UsersACLRepository implements ACLRepository
{
    public function getUserID()
    {
        return auth()->user()->id;
    }

    /**
     * Get ACL rules list for user.
     */
    public function getRules(): array
    {
        if (auth()->user()->isAdmin || auth()->user()->can('documentador')) {
            return [
                ['disk' => 'Administrador', 'path' => '*', 'access' => 2],
                ['disk' => 'Normas', 'path' => '*', 'access' => 2],
                ['disk' => 'Documentos publicados', 'path' => '*', 'access' => 2],
                ['disk' => 'Documentos en aprobacion', 'path' => '*', 'access' => 2],
                ['disk' => 'Documentos obsoletos', 'path' => '*', 'access' => 2],
                ['disk' => 'Documentos versiones anteriores', 'path' => '*', 'access' => 2],
            ];
        }

        return [
            ['disk' => 'Administrador', 'path' => '*', 'access' => 1],  // Not Admin then only read
            ['disk' => 'Normas', 'path' => '*', 'access' => 1], // Not Admin then only read
            ['disk' => 'Documentos publicados', 'path' => '*', 'access' => 1],  // Not Admin then only read
            ['disk' => 'Documentos en aprobacion', 'path' => '*', 'access' => 1],   // Not Admin then only read
            ['disk' => 'Documentos obsoletos', 'path' => '*', 'access' => 1],   // Not Admin then only read
            ['disk' => 'Documentos versiones anteriores', 'path' => '*', 'access' => 1],    // Not Admin then only read
        ];
    }
}
