<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $menuUsers = 'active';
        return view('users.index_user', compact('menuUsers', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuUsers = 'active';
        return view('users.form_user', compact('menuUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed|min:6'
            ]);

            //insert data
            User::create([
                'name' => $request->name,
                'emails' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with(['success'=> 'User berhasil disimpan']);
        } catch(Exception $e){
            return redirect()->back()->with(['failed'=> 'Ada kesalahan system!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuUsers = 'active';
        $edit = User::find($id);

        return view('users.form_edit_user', compact('edit', 'menuUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);

            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;

            if($request->password != ""){
                $user->password = Hash::make($request->password);
            }

            $user->update();

            return redirect()->route('users.index')->with(['success'=> 'User berhasil diupdate']);
        } catch(Exception $e){
            return redirect()->route('users.index')->with(['failed'=> 'User gagal diupdate. error: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user){
            $user->delete();
            return redirect()->back()->with(['success'=> 'User berhasil dihapus']);
        } else {
            return redirect()->back()->with(['failed'=> 'User not found']);
        }
    }
}
