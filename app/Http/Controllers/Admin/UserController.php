<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id','desc')->paginate(10);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000', 

        ]);
        if ($validation) {
            $file = $request->file('profile_picture');
            $filename = time().'.'.$file->extension();
            $path = $file->storeAs('uploads',$filename,'public');
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'profile_picture' => $filename,
            ]);

            return redirect()->route('admin.user.index')->with('success','User Created Successfully');
        }
    }
    public function show($id){
        $user = User::findOrFail($id);
        return view('admin.user.show',compact('user'));
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));

    }
    public function update(Request $request, $id){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000', 
        ]);
        $user = User::findOrFail($id);
        $file = $request->file('profile_picture');
        $filename = time().'.'.$file->extension();
        $file->storeAs('uploads',$filename,'public');
        $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'profile_picture' => $filename,
        ]);
        return redirect()->route('admin.user.index')->with('message','user is updated.');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('message','user is deleted successfully');
    }
}
