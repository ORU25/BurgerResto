<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $user = User::all();
        return view('user.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=> 'required | string | unique:users',
            'email'=> 'required | email | unique:users',
            'hp' => ['required'],
            'password' => ['required','string','min:5'],
            'role'=> ['required'],
        ]);

        try{
            $user=new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->hp = $request->hp;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','User gagal disimpan');
        }
        return redirect('user')->with('sukses','user berhasil disimpan');
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
        $user = User::findOrFail($id);
        $request->validate([
            'username' => ['required','string','unique:users,username,'.$id],
            'email' => ['required','email','unique:users,email,'.$id],
            'hp' => 'required',
            'role' => 'required',
        ]);

        try{
            $user = User::find($id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->hp = $request->hp;
            if($request->password <> ''){
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role;
            $user->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','User Gagal Diedit');
        }
        return redirect('user')->with('sukses','User Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->id == $id) {
            return redirect()->back()->with('errors','User Sedang Tidak Dapat Dihapus');
        }else{
            try{
                $user = User::find($id);
                $user->delete();
            }
            catch(\Exception $e){
                return redirect()->back()->with('errors','User Gagal Dihapus');
            }
            return redirect()->back()->with('sukses','User Berhasil Dihapus');
        }
    }
}
