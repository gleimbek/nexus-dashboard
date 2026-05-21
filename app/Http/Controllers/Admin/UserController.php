<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

	public function destroy(User $user)
	{
		$user->delete();

		return redirect()->route('admin.users');
	}
	
	public function edit(User $user)
	{
		return view('admin.users.edit', compact('user'));
	}

	public function update(Request $request, User $user)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
		]);

		$user->update([
			'name' => $request->name,
			'email' => $request->email,
		]);

		return redirect()->route('admin.users');
	}
}
