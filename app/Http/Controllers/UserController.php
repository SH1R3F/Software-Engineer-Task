<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $validated = $request->validate([
            'avatar'    => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'username'  => ['required', 'alphadash', Rule::unique('users')],
            'email'     => ['required', 'email', Rule::unique('users')],
            'password'  => ['required', 'min:6'],
        ]);

        // Upload avatar
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar')->store('avatars', ['disk' => 'public']);
            $validated['photo'] = "storage/$photo";
        }

        // Update user
        User::create($validated);

        // Return response
        return redirect()->route('users.index')->with('status', 'User updated successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validate Request
        $validated = $request->validate([
            'avatar'    => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'username'  => ['required', 'alphadash', Rule::unique('users')->ignore($user)],
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password'  => ['nullable', 'min:6'],
        ]);

        // Upload avatar
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar')->store('avatars', ['disk' => 'public']);
            $validated['photo'] = "storage/$photo";
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        // Update user
        $user->update($validated);

        // Return response
        return redirect()->route('users.index')->with('status', 'User created successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted successfully');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Restore a trashed resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('users.trashed')->with('status', 'User restored successfully');
    }
}
