<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iso9001\LockedPlanTrabajo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LockedPlanTrabajoController extends Controller
{
    public function getLockedToPlanTrabajo(Request $request)
    {
        if ($request->ajax()) {
            $usuario = User::getCurrentUser();
            // $numero_bloqueo = LockedPlanTrabajo::count();
            // $hora_actual = Carbon::now();
            // if ($numero_bloqueo == 0) {
            //     LockedPlanTrabajo::create([
            //         'locked_to' => Carbon::now(),
            //         'locked_by' => $usuario->id,
            //     ]);
            //     $bloqueo = LockedPlanTrabajo::first();
            //     return response()->json(['success' => true, 'datos' => $bloqueo, 'hora_actual' => $hora_actual]);
            // } else {
            //     $bloqueo = LockedPlanTrabajo::first();
            //     $permission = $hora_actual->diffInSeconds($bloqueo->locked_to) > 5;
            //     if ($permission) {
            //         return response()->json(['success' => $permission]);
            //     } else {
            //         return response()->json(['error' => !$permission]);
            //     }
            // }
            $numero_bloqueo = LockedPlanTrabajo::count();
            if ($numero_bloqueo == 0) {
                LockedPlanTrabajo::create([
                    'locked_to' => Carbon::now(),
                    'blocked' => '0',
                    'locked_by' => $usuario->id,
                ]);
            }
            $bloqueo = LockedPlanTrabajo::first();
            if (intval($bloqueo->blocked) == 0) {
                $bloqueo->update([
                    'locked_by' => intval($request->user_id),
                ]);
            }
            if (intval($bloqueo->blocked) == 1 && intval($bloqueo->locked_by) == $usuario->id) {
                return response()->json(['success' => true]);
            } else {
                if (intval($bloqueo->blocked) == 0 && intval($bloqueo->locked_by) == $usuario->id) {
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['error' => true, 'locked_by' => User::select('name', 'email')->where('id', '=', intval($bloqueo->locked_by))->first()]);
                }
            }
        }
    }

    public function setLockedToPlanTrabajo(Request $request)
    {
        if ($request->ajax()) {
            $numero_bloqueo = LockedPlanTrabajo::count();
            if ($numero_bloqueo == 1) {
                $bloqueo = LockedPlanTrabajo::first();
                $bloqueo->update([
                    'locked_to' => Carbon::now(),
                    'blocked' => '1',
                    'locked_by' => User::getCurrentUser()->id,
                ]);
            }

            return response()->json(['success' => 'Bloqueo']);
        }
    }

    public function isLockedToPlanTrabajo(Request $request)
    {
        if ($request->ajax()) {
            $numero_bloqueo = LockedPlanTrabajo::count();
            if ($numero_bloqueo == 1) {
                $usuario = User::getCurrentUser();
                $bloqueo = LockedPlanTrabajo::first();
                if (intval($bloqueo->blocked) == 1 && intval($bloqueo->locked_by) == $usuario->id) {
                    return response()->json(['blocked_by_self' => true]);
                } elseif (intval($bloqueo->blocked) == 1 && intval($bloqueo->locked_by) != $usuario->id) {
                    return response()->json(['blocked' => true]);
                } else {
                    return response()->json(['blocked' => false]);
                }
            }
        }
    }

    public function removeLockedToPlanTrabajo(Request $request)
    {
        if ($request->ajax()) {
            $numero_bloqueo = LockedPlanTrabajo::count();
            if ($numero_bloqueo == 1) {
                $bloqueo = LockedPlanTrabajo::first();
                $bloqueo->update([
                    'locked_to' => Carbon::now(),
                    'blocked' => '0',
                    'locked_by' => 0,
                ]);
            }

            return response()->json(['success' => 'Removido']);
        }
    }
}
