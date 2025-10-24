<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'phone'    => 'nullable|string|max:20',
                'role'     => 'required|string',
                'status'   => 'required|string',
                'password' => 'required',
                'photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'address'  => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('photos', 'public');
            }

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return redirect()
                ->route('users.index')
                ->with('success', '✅ User has been successfully created.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to create user. Please try again.');
        }
    }

    public function show(User $user)
    {
        return view('pages.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'phone'    => 'nullable|string|max:20',
                'role'     => 'required|string',
                'status'   => 'required|string',
                'password' => 'nullable',
                'photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'address'  => 'nullable|string|max:255',
            ]);

            // Handle photo upload
            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                $validated['photo'] = $request->file('photo')->store('photos', 'public');
            }

            // Handle password update
            if ($request->filled('password')) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()
                ->route('users.index')
                ->with('success', '✅ User has been successfully updated.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to update user. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->delete();

            return redirect()
                ->route('users.index')
                ->with('success', '🗑️ User has been successfully deleted.');
        } catch (Exception $e) {
            return redirect()
                ->route('users.index')
                ->with('error', '❌ Failed to delete user. Please try again.');
        }
    }
}
