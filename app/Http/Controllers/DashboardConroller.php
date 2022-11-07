<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardConroller extends Controller
{
    public function index()
    {

        // grafik pendapatan 
        $data = Service::grafikLabelTahunan();
        $tanggal = [];
        $jumlah = [];
        foreach ($data as  $value) {
            $tanggal[] = date("M Y", strtotime($value->tgl_service));
            $jumlah[] =  (int)$value->jumlah;
        };
        // grafik penjualan barang 
        $dataBarang = Service::grafikPenjualanBarang();
        $tanggalBarang = [];
        $jumlahBarangTerjual = [];
        foreach ($dataBarang as  $value1) {

            $tanggalBarang[] = $value1->jasa;
            $jumlahBarangTerjual[] =  (int)$value1->jumlah;
        }
        // dd(Service::all());
        return view('dashboard', [
            'data_barang' => Barang::barangTerjual(),
            'jumlahBarang' => Barang::count(),
            'serviceBulanIni' => Service::whereYear('tgl_service', '=', date('Y'))
                ->whereMonth('tgl_service', '=', date('m'))
                ->count(),
            'serviceDiproses' => Service::where('status_service', 'proses_pengerjaan')
                ->count(),
            'jumlahPendapatan' => Service::whereYear('tgl_service', '=', date('Y'))
                ->whereMonth('tgl_service', '=', date('m'))
                ->sum('total_bayar'),
            'grafik' => [
                'label' => json_encode($tanggal),
                'jumlah' => json_encode($jumlah, JSON_NUMERIC_CHECK)
            ],
            'grafikBarang' => [
                'label' => json_encode($tanggalBarang),
                'jumlah' => json_encode($jumlahBarangTerjual, JSON_NUMERIC_CHECK)
            ]
        ]);
    }

    // ganti barang 
    public function getGrafikBarang(Request $request)
    {
        $data = Service::grafikPenjualanBaranByIdg($request->id_barang);
        $tanggalBarang = [];
        $jumlahBarangTerjual = [];
        foreach ($data as  $value1) {
            $tanggalBarang[] = date("M Y", strtotime($value1->tgl_service));
            $jumlahBarangTerjual[] =  (int)$value1->jumlah;
        }

        return  [
            'label' => $tanggalBarang,
            'jumlah' => $jumlahBarangTerjual
        ];
    }
}
