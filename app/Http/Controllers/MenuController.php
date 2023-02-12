<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::all();
        $kategori = Kategori::all();
        return view('menu.index')->with('menu',$menu)->with('kategori',$kategori);
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
            // 'nama' => 'required|unique:menu',
            'kategori' => 'required',
            'stok'=>'required|numeric',
            'harga' => 'required|numeric',
            'status' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,gif,svg|max:2048',
        ]);
        try{
            $menu = new Menu;
            $menu->nama = $request->nama;
            $menu->kategori_id = $request->kategori;
            $menu->stok = $request->stok;
            $menu->harga = $request->harga;
            $menu->status = $request->status;
            $filegambar = $request->file('gambar');
            $fileasli = $filegambar->getClientOriginalName();
            $uploadgambar =$filegambar->move(public_path().'/foto_menu/',$fileasli);
            $menu->gambar = $fileasli;
            $menu->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Menu Gagal dDsimpan');
        }
        return redirect('menu')->with('sukses','Menu Berhasil Disimpan');
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
        //
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
        $menu = Menu::findOrFail($id);
        $request->validate([
            'nama' => 'required|unique:menu,nama,'.$id,
            'kategori' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,gif,svg,png|max:2048',
            'stok'=>'required|numeric',
            'harga' => 'required|numeric',
            'status' => 'required',
        ]);

        try{
            $menu = Menu::findOrFail($id);
            $menu->nama = $request->nama;
            $menu->kategori_id = $request->kategori;
            $menu->stok = $request->stok;
            $menu->harga = $request->harga;
            $menu->status = $request->status;
                if ($request->hasFile('gambar')){
                    File::delete(public_path('foto_menu/'.$menu->gambar));
                    $filegambar = $request->file('gambar');
                    $fileasli = $filegambar->getClientOriginalName();
                    $uploadgambar =$filegambar->move(public_path().'/foto_menu/',$fileasli);
                    $menu->gambar = $fileasli;
                }

            $menu->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Menu Gagal Diedit');
        }
        return redirect('menu')->with('selesai','Menu Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $menu = Menu::findOrFail($id);
            File::delete(public_path('foto_menu/'.$menu->gambar));
            $menu->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Menu Gagal Dihapus');
        }
        return redirect()->back()->with('sukses','Menu Berhasil Dihapus');
    }

    public function hapus($id)
    {
        // try{
        //     $menu = Menu::findOrFail($id);
        //     File::delete(asset('foto_menu/'.$menu->gambar));
        //     $menu->gambar->delete();
        // }
        // catch(\Exception $e){
        //     return redirect()->back()->withErrors(['Gambar Gagal Dihapus']);
        // }
        // return redirect()->back()->with('sukses','Gambar Berhasil Dihapus');
    }
}
