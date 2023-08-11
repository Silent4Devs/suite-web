<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

class TeamMembersController extends Controller
{
    public function index()
    {
        $team = Team::where('owner_id', auth()->user()->id)->first();
        $users = User::getAll()->where('team_id', $team->id);

        return view('admin.team-members.index', compact('team', 'users'));
    }

    public function invite(Request $request)
    {
        $request->validate(['email' => 'email']);
        $team = Team::where('owner_id', auth()->user()->id)->first();
        $url = URL::signedRoute('register', ['team' => $team->id]);
        $message = new \App\Notifications\TeamMemberInvite($url);
        Notification::route('mail', $request->input('email'))->notify($message);

        return redirect()->back()->with('message', 'Invite sent.');
    }
}
