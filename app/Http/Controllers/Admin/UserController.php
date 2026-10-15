<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('status', "Updated {$user->name}.");
    }

    public function destroy(Request $request, User $user)
    {
        // An admin deleting their own account from here would lock themselves out mid-session.
        if ($request->user()->is($user)) {
            return redirect()->route('admin.users')->with('status', 'You can\'t delete your own account from this page.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users')->with('status', "Deleted {$name}.");
    }
}
