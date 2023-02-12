<?php

namespace App\Http\Controllers;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = Meja::all();
        return view('meja.index')->with('meja',$meja);
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
            'nomor_meja'=> ['required'],
            'status' => ['required']
        ]);

        try{
            $meja= new Meja;
            $meja->nomor_meja = $request->nomor_meja;
            $meja->status = $request->status;
            $meja->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Meja gagal disimpan');
        }
        return redirect('meja')->with('sukses','Meja berhasil disimpan');
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
        $meja = Meja::findOrFail($id);
        $request->validate([
            'status' => ['required']
        ]);

        try{
            $meja= meja::find($id);
            $meja->status = $request->status;
            $meja->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Meja Gagal Diedit');
        }
        return redirect('meja')->with('sukses','Meja Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try{
        //     $meja = Meja::find($id);
        //     $meja->delete();
        // }
        // catch(\Exception $e){
        //     return redirect()->back()->with('errors','Meja Gagal Dihapus');
        // }
        // return redirect()->back()->with('sukses','Meja Berhasil Dihapus');
    }
}
