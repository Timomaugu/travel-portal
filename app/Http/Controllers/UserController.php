<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '<>', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    public function create() {
        $roles = Role::pluck('name','name')->all();
        $departments = Department::all();
        return view('users.create', compact(['roles', 'departments']));
    }

    public function store(Request $request) {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'], 
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'regex:/^(2547|07|01)\d{8}$/', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required'
        ]);

        $user = User::create([
            'f_name' => $request->fname,
            'l_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'department_id' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success','User Created Successfully');
    }

    public function show($id) {
        dd($id);
        $user = User::findOrFail($id);
        $departments = Department::all();
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('users.view', [
            'user' => $user,
            'departments' => $departments,
            'userRoles' => $userRoles
        ]);
    }

    public function edit(User $user) {
        $departments = Department::all();
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('users.edit', [
            'user' => $user,
            'departments' => $departments,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user) {
        $request->validate([  
            'fname' => ['required', 'string', 'max:255'], 
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(2547|07|01)\d{8}$/'],
            'roles' => 'required'
          ]);

          $data = [
            'f_name' => $request->fname,
            'l_name' => $request->lname,
            'phone' => $request->phone,
            'department_id' => $request->department,
        ];
        
        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        $user->update($data);

        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'User Updated Successfully');

    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('error', 'User Deleted Successfully');
    }

}
