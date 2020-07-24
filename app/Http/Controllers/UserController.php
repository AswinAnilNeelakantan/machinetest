<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNull('approved_at')->get();
        $all = User::where('admin','=',0)->get();

        return view('users', compact('users','all'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['approved_at' => now()]);

        return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }

    public function activate($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['status' => 1 ]);

        return redirect()->route('admin.users.index')->withMessage('User activated successfully');
    }

    public function deactivate($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['status' => 0]);
        $user->update(['approved_at' => NULL]);

        return redirect()->route('admin.users.index')->withMessage('User deactivated successfully');
    }



}



