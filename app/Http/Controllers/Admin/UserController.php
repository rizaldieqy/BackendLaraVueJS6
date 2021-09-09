<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->when(request()->q, function($users){
            $users = $users->where('name', 'like', '%'.request()->q. '%');
        })->paginate(10);

        return view('admin.user.index', compact('users'));
    }


    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        if($user){
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }


    public function edit(User $user){
        return view('admin.user.edit', compact('user'));
    }


    public function update(Request $request, User $user){
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'required|confirmed'
        ]);

        if($request->password == ""){
            $user = User::findOrFail($user->id);
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email
            ]);
        }else{
            $user = User::findOrFail($user->id);
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
            ]);

            if($user){
                return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Tersimpan']);
            }else{
                return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Tersimpan']);
            }
        }
    }


    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        if($user){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
