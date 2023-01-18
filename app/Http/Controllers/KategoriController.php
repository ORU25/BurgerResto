<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index')->with('kategori',$kategori);
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
            'nama_kategori'=> ['required','string','unique:kategori']
        ]);

        try{
            $kategori= new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Kategori gagal disimpan');
        }
        return redirect('kategori')->with('sukses','Kategori berhasil disimpan');
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
        $kategori = Kategori::findOrFail($id);
        $request->validate([
            'nama_kategori' => ['required','string','unique:kategori,nama_kategori,'.$id],
        ]);

        try{
            $kategori= Kategori::find($id);
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Kategori Gagal Diedit');
        }
        return redirect('kategori')->with('selesai','Kategori Berhasil Diedit');
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
            $kategori = Kategori::find($id);
            $kategori->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Kategori Gagal Dihapus');
        }
        return redirect()->back()->with('sukses','Kategori Berhasil Dihapus');
    }
}
