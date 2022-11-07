<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Service::all();
        return view('service/index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'barang_service' => 'required',
            'kondisi_awal_barang' => 'required',
        ]);

        $simpan = Service::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'barang_service' => $request->barang_service,
            'kondisi_awal_barang' => $request->kondisi_awal_barang,
            'tgl_service' => date('Y-m-d'),
            'status_service' => 'proses_pengerjaan',
            'created_at' => now()
        ]);

        if ($simpan) {
            return redirect('/service')->with('succes', "Data Berhasil Disimpan");
        } else {
            return back()->with('gagal', "Data Gagal Disimpan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service.detail', [
            'data' => $service,
            'detail_service' => DB::table('detail_service')
                ->where('id_service', $service->id_service)
                ->get(),
            'total_bayar' => DB::table('detail_service')
                ->where('id_service', $service->id_service)
                ->sum('total_harga')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('service/edit', [
            'data' => $service,
            'detail_service' => DB::table('detail_service')
                ->where('id_service', $service->id_service)
                ->get(),
            'total_bayar' => DB::table('detail_service')
                ->where('id_service', $service->id_service)
                ->sum('total_harga'),
            'barang' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'barang_service' => 'required',
            'kondisi_awal_barang' => 'required',
            'tgl_service' => 'required',
            'status_service' => 'required',
            'total_bayar' => 'required'
        ]);
        $update = Service::where('id_service', $service->id_service)
            ->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat_pelanggan' => $request->alamat_pelanggan,
                'barang_service' => $request->barang_service,
                'kondisi_awal_barang' => $request->kondisi_awal_barang,
                'tgl_service' => $request->tgl_service,
                'status_service' => $request->status_service,
                'total_bayar' => $request->total_bayar,
                'updated_at' => now()
            ]);
        if ($update) {
            return redirect('/service')->with('succes', "Data Berhasil Disimpan");
        } else {
            return back()->with('gagal', "Data Gagal Disimpan");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $hapus = Service::destroy($service->id_service);
        if ($hapus) {
            return redirect('/service')->with('succes', "Data Berhasil dihapus");
        } else {
            return back()->with('gagal', "Data Gagal Disimpan");
        }
    }

    public function tambahJasa(Request $request)
    {
        $validation =  $request->validate([
            'jasa' => 'required',
            'harga_satuan' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'id_service' => 'required'
        ]);
        if ($request->barang_id !== null) {
            $validation['id_barang'] = $request->barang_id;
            $dataBarang = Barang::where('barang_id', $request->barang_id)
                ->get()->first();
            if ($dataBarang->stok_barang < $request->jumlah) {
                return back()->with('gagal', "Stok barang tidak mencukupi");
            }
            $sisaStok = $dataBarang->stok_barang - $request->jumlah;
        }
        $tambahJasa = DB::table('detail_service')
            ->insert($validation);
        if ($tambahJasa) {
            if ($request->barang_id !== null) {
                $update = Barang::where('barang_id', $request->barang_id)
                    ->update([
                        'stok_barang' => $sisaStok
                    ]);
                if ($update) {
                    return redirect('/service/' . $request->id_service . '/edit')->with('succes', "Data Berhasil ditambah");
                }
            }
            return redirect('/service/' . $request->id_service . '/edit')->with('succes', "Data Berhasil ditambah");
        } else {
            return back()->with('gagal', "Data Gagal Disimpan");
        }
    }

    public function hapusJasa(Request $request)
    {
        $dataDetailService = DB::table('detail_service')
            ->where('id_detail_service', $request->id_service_detail)
            ->get()->first();
        $hapus_jasa = DB::table('detail_service')
            ->where('id_detail_service', $request->id_service_detail)
            ->delete();
        if ($hapus_jasa) {
            if ($dataDetailService->id_barang !== null) {
                $dataBarang = Barang::where('barang_id', $dataDetailService->id_barang)
                    ->get()->first();
                $sisaStok = $dataBarang->stok_barang + $dataDetailService->jumlah;
                $update = Barang::where('barang_id', $dataBarang->barang_id)
                    ->update([
                        'stok_barang' => $sisaStok
                    ]);
                if ($update) {
                    return redirect('/service/' . $request->id_service . '/edit')->with('succes', "Data Berhasil ditambah");
                }
            }
            return redirect('/service/' . $request->id_service . '/edit')->with('succes', "Data Berhasil dihapus");
        } else {
            return back()->with('gagal', "Data Gagal Disimpan");
        }
    }

    public function cetakInvoice(Request $request, $id)
    {
        // dd($id);
        return view('service.cetakInvoice', [
            'data' => Service::findOrFail($id),
            'detail_service' => DB::table('detail_service')
                ->where('id_service', $id)
                ->get(),
            'total_bayar' => DB::table('detail_service')
                ->where('id_service', $id)
                ->sum('total_harga')
        ]);
    }
}
