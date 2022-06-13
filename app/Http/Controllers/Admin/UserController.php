<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(): View
    {
        $users = User::unblocked()->get();

        return view('admin.user.list', compact('users'));
    }

    public function blockedList(): View
    {
        $users = User::blocked()->get();

        return view('admin.user.blockedlist', compact('users'));
    }

    public function edit(User $user, Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $blocked = $request->get('blocked', false);
            $data = $request->validate([
                'name' => 'required|between:2,100',
                'role_id' => 'required',
            ]);
            $user->update($data);

            $user->settings = json_encode(['settings' => ['canRead' => 1]]);
            //blocked
            $user->blocked = $blocked;
            $user->save();

            //roles
            $user->roles()->detach();
            $roles = Role::find($request->get('role_id'));

            foreach ($roles as $role) {
                $user->roles()->attach($role);
            }

            return redirect($blocked ? route('admin.user.blocked') : route('admin.user'))
                ->with('success', 'User updated successfully!');
        }

        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required|between:2,100',
                'password' => 'required',
                'role_id' => 'required',
            ]);
            $data['password'] = Hash::make($data['password']);
            /** @var User $user */
            $user = User::create($data);
            $roles = Role::find($request->get('role_id'));

            foreach ($roles as $role) {
                $user->roles()->attach($role);
            }

            return redirect(route('admin.user'))
                ->with('success', 'User created successfully!');
        }

        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function block(User $user): RedirectResponse
    {
        $user->blocked = true;
        $user->save();

        return redirect(route('admin.user'))
            ->with('success', 'User blocked successfully!');
    }

    public function unblock(User $user): RedirectResponse
    {
        $user->blocked = false;
        $user->save();

        return redirect(route('admin.user'))
            ->with('success', 'User unblocked successfully!');
    }
}
