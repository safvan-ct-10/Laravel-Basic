<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Http\Controllers\Controller;
use App\Jobs\SendUserEmailJob;
use App\Mail\UserCreatedMail;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        // if(cache()->has('users')) {
        //     $users = cache()->get('users');
        // }
        // else {
        //     $users = User::withoutGlobalScope('active')->latest()->paginate(10);
        //     cache()->put('users', $users, 60);
        // }

        User::withoutGlobalScope('active')->withTrashed()->where('is_open', 0)->update(['is_open' => 1]);
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
        $countries = Country::orderby('name', 'asc')->get();
        return view('admin.users.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'country_id' => $request->country_id,
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

        Mail::to('isafvanct@gmail.com')
            ->cc('safvanctsfn@gmail.com', 'test@gmail.com') // Carbon Copy
            ->bcc('abc.gmail.com') // Blind Carbon Copy
            ->send(new UserCreatedMail($data));

        cache()->forget('users');

        return redirect()->route('admin.users')->with('success', 'User Created Successfully');
    }

    public function edit($id)
    {
        $countries = Country::orderby('name', 'asc')->get();
        $user = User::withoutGlobalScope('active')->withTrashed()->find(decrypt($id));
        return view('admin.users.edit', compact('user', 'countries'));
    }

    public function update(Request $request)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($request->id));

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'country_id' => $request->country_id,
            'is_active' => $request->is_active,
            'is_open' => 0
        ];

        if ($request->has('password') && !is_null($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        UserCreateEvent::dispatch($data);
        SendUserEmailJob::dispatch($data);

        cache()->forget('users');

        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function delete($id)
    {
        $user = User::withoutGlobalScope('active')->findOrFail(decrypt($id));
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User Trashed Successfully');
    }

    public function recoverUser($id)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($id));
        $user->restore();
        return redirect()->route('admin.users.trashed')->with('success', 'User Recovered Successfully');
    }

    public function forceDelete($id)
    {
        $user = User::withoutGlobalScope('active')->withTrashed()->findOrFail(decrypt($id));
        $user->forceDelete();
        return redirect()->route('admin.users')->with('success', 'User Deleted Permenently');
    }
}
