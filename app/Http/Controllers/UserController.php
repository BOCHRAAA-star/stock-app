<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // 1. List all users for the admin
    public function index()
    {
        $users = User::with('site')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. Show the form to create a user
    public function create()
    {
        $sites = Site::orderBy('name')->get();
        return view('admin.users.create', compact('sites'));
    }

    // 3. Save the new user created by the admin
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role'     => ['required', 'in:admin,user'],
            'site_id'  => ['nullable', 'exists:sites,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'site_id'  => $request->site_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }
}
