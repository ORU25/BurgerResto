<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\DetailPembayaran;
use App\Models\Menu;
use Error;
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
        $rules = [
            
            'tunai' => 'required|numeric|min:'.$pembayaran->total_harga,
            
        ];
       
        $messages = [
            'tunai.required' => 'Nilai tunai harus diisi',
            'tunai.numeric' => 'Nilai tunai harus berupa angka',
            'tunai.min' => 'Nilai tunai harus lebih besar atau sama dengan total harga yaitu Rp ' . $pembayaran->total_harga,
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // logika jika validasi gagal
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            try{
                $pembayaran= Pembayaran::find($id);
                $pembayaran->status = "paid";
                $detail_pembayaran = new DetailPembayaran;
                $detail_pembayaran->pembayaran_id = $pembayaran->id;
                $detail_pembayaran->tunai = $request->tunai;
                $detail_pembayaran->kembalian = $request->tunai - $pembayaran->total_harga;
                $detail_pembayaran->save();
                $pembayaran->save();
            }
            catch(\Exception $e){
                return redirect()->back()->with('errors','Pembayaran Gagal');
            }
            return view('struk_pembayaran')->with('pembayaran',$pembayaran);
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
        //
    }

    
    public function struk_pembayaran($id){
        $pembayaran = Pembayaran::findOrFail($id);
        return view('struk_pembayaran')->with('pembayaran',$pembayaran);
    }
}
