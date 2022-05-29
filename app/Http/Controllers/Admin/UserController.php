<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withoutGlobalScope('active')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function trashed()
    {
        $users = User::withoutGlobalScope('active')->onlyTrashed()->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'is_active' => $request->is_active,
        ];

        //User::create($data);

        // CHECK EMAIL EXIST THEN SAVE
        // User::firstOrCreate([
        //     'email' => $request->email,
        // ], $data);

        // CHECK EMAIL EXIST THEN UPDATE ELSE SAVE
        User::updateOrCreate([
            'email' => $request->email,
        ], $data);

        return  redirect()->route('admin.users')->with('success', 'User Created Successfully');
    }

    public function edit($id)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->find(decrypt($id));
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($request->id));

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'is_active' => $request->is_active,
        ];

        if($request->has('password') && !is_null($request->password)) {
           $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return  redirect()->route('admin.users')->with('success', 'User Updated Successfully');
    }

    public function delete($id)
    {
        $user = User::withoutGlobalScope('active')->findOrFail(decrypt($id));
        $user->delete();
        return  redirect()->route('admin.users')->with('success', 'User Trashed Successfully');
    }

    public function recoverUser($id)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($id));
        $user->restore();
        return  redirect()->route('admin.users.trashed')->with('success', 'User Recovered Successfully');
    }

    public function forceDelete($id)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($id));
        $user->forceDelete();
        return  redirect()->route('admin.users')->with('success', 'User Deleted Permenently');
    }
}
