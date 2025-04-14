<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('pages.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'role' => 'required',
        ]);

        $userPass = bcrypt($request->password);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'role'=> $request->role,
            'password' => $userPass
        ]);

        return redirect()->route('users.index')->with('success','Berhasil Menambahkan Data User');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = User::find($id);
        return view('pages.users.edit', compact('userId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userUpdate = User::find($id);

        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'role'=> 'required'
        ]);

        if ($request->password > 0) {
            $userPass = bcrypt($request->password);

            $userUpdate->update([
                'name' => $request->name,
                'email'=> $request->email,
                'role'=> $request->role,
                'password'=> $userPass
            ]);
        } else {
            $userUpdate->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'role'=> $request->role,
            ]);
        }

        return redirect()->route('users.index')->with('success','Berhasil Mengubah Data User!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data User');
    }
}
