<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get view
        return view('barang/index', [
            'data' => Barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang/add', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $validation = $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric',
            'foto_barang' => 'required|file|image|max:2024',
        ]);
        $validation['created_at'] = now();
        $validation['foto_barang'] = $request->file('foto_barang')->store('foto-barang');

        $create =  Barang::create($validation);
        if ($create) {
            return redirect('/barang')->with('succes', 'Penambahan Barang Berhasil');
        } else {
            return back()->with('gagal', 'Penambahan Barang Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'barang' => Barang::find($barang)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        // validation
        $validation = $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric',
            'foto_barang' => 'image|file|max:2024',
        ]);

        if ($request->file('foto_barang')) {
            if ($request->foto_lama) {
                Storage::delete($request->foto_lama);
            }
            $validation['foto_barang'] = $request->file('foto_barang')->store('foto-barang');
        }
        // dd($barang);
        $update = Barang::where('barang_id', $barang->barang_id)
            ->update($validation);
        if ($update) {
            return redirect('/barang')->with('succes', 'Penambahan Barang Berhasil');
        } else {
            return back()->with('gagal', 'Penambahan Barang Gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        // get data yang akan dihapus
        $data = Barang::find($barang)->first();
        // cek apakah memiliki foto barang
        if ($data->foto_barang) {
            // hapus foto dari penyimpanan
            Storage::delete($data->foto_barang);
        }
        // hapus data dari database
        if (Barang::destroy($barang->barang_id)) {
            return redirect('/barang')->with('succes', 'Penghapusan Barang Berhasil');
        } else {
            return back()->with('gagal', 'Penghapusan Barang Gagal');
        }
    }

    // // get barang 
    public function getBarang(Request $request)
    {
        $dataBarang = Barang::where('barang_id', $request->id_barang)
            ->get()->first();
        return  response()->json($dataBarang, 200);
    }
}
