<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pembayaran = Pembayaran::all();
        $pembayaran = Pembayaran::orderBy('status', 'asc')->orderBy('pesanan_id', 'desc')->get();
        return view('pembayaran.index')->with('pembayaran',$pembayaran);
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
        //
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
        $pembayaran = Pembayaran::findOrFail($id);
        $request->validate([
            'status' => ['required']
        ]);

        try{
            $pembayaran= Pembayaran::find($id);
            $pembayaran->status = $request->status;
            $pembayaran->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with('errors','Pembayaran Gagal Diedit');
        }
        return redirect('pembayaran')->with('sukses','Pembayaran Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function struk($id){
        $pembayaran = Pembayaran::findOrFail($id);
        return view('struk')->with('pembayaran',$pembayaran);
    }
}
