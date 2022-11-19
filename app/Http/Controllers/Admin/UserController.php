<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\SendPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', '1')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fname_admin' => 'required',
            'lname_admin' => 'required',
            'dob' => 'required',
            'email_admin' => 'required|email:rfc,dns',
            'gender' => 'required',
            'contact_admin' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'status' => 'required',
            'roles' => 'required'
        ]);

        $user = new User();
        $user->fname = $request->fname_admin;
        $user->lname = $request->lname_admin;
        $user->dob = $request->dob;
        $user->email = $request->email_admin;
        $user->gender = $request->gender;
        $user->contact = $request->contact_admin;
        $user->status = $request->status;
        $pw = generatePass();
        $user->password = Hash::make($pw);

        $mailData = [
            'name' => $user->full_name,
            'email' => $user->email,
            'password' => $pw
        ];

        Mail::to($user->email)->send(new SendPassword($mailData));
        $user->save();
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fname_admin' => 'required',
            'lname_admin' => 'required',
            'dob' => 'required',
            'email_admin' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required',
            'contact_admin' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'status' => 'required',
            'roles' => 'required'
        ]);

        $user = User::find($id);
        $user->fname = $request->fname_admin;
        $user->lname = $request->lname_admin;
        $user->dob = $request->dob;
        $user->email = $request->email_admin;
        $user->gender = $request->gender;
        $user->contact = $request->contact_admin;
        $user->status = $request->status;

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->roles);
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(Request $request)
    {
        $service = User::find($request->delete_id);
        $service->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
