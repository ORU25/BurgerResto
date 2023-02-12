<?php

namespace App\Http\Controllers;


use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\DetailPesanan;
use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        $detail_pesanan = DetailPesanan::all();
        $meja = Meja::all();
        $menu = Menu::all();
        return view('pesanan.index')->with('pesanan',$pesanan)->with('detail_pesanan',$detail_pesanan)->with('meja',$meja)->with('menu',$menu);
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
            'nomor_meja' => 'required',
            'menu' => 'required',
            'jumlah' => 'required',

        ]);
        try{
            $total_harga = 0;

            $pesanan = new Pesanan;
            $pesanan->user_id = \Auth::user()->id;
            $pesanan->meja_id = $request->nomor_meja;
            $pesanan->save();

            $menus = $request->input('menu');
            $jumlah = $request->input('jumlah');

            foreach( $menus as $key => $menu){
                
                    $detailpesanan = new DetailPesanan;
                    $detailpesanan->pesanan_id = $pesanan->id;
                    $detailpesanan->menu_id = $menu;
                    $detailpesanan->jumlah = $jumlah[$key];
                    $detailpesanan->status = "proses";
                    $detailpesanan->save();

                    $current_menu = Menu::find($menu);
                    $current_menu->stok -= $jumlah[$key];
                    $current_menu->save();
                    
                    $total_harga += $current_menu->harga * $jumlah[$key];

                
            }

            $meja = Meja::where('nomor_meja', $request->nomor_meja)->first();
            $meja->status = "used";
            $meja->save();

            $pembayaran = new Pembayaran;
            $pembayaran->pesanan_id = $pesanan->id;
            $pembayaran->total_harga = $total_harga;
            $pembayaran->status = "unpaid";
            $pembayaran->save();




            

        }catch(\Exception $e){
            return redirect()->back()->with('errors','Pesanan Gagal dDsimpan');
        }
        return redirect('pesanan')->with('sukses','Pesanan Berhasil Disimpan');
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
    public function update($id)
    {   
        $detailpesanan = DetailPesanan::find($id);
        if($detailpesanan->status == "proses"){
            $detailpesanan->status = "done";
            $detailpesanan->save();
        }elseif($detailpesanan->status == "done"){
            $detailpesanan->status = "proses";
            $detailpesanan->save();
        }
        return redirect('pesanan');
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

    
}

