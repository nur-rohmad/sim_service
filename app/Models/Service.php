<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service_table';
    protected $primaryKey = 'id_service';
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'barang_service',
        'status_service',
        'kondisi_awal_barang',
        'tgl_service',
        'total_bayar',
        'created_at'
    ];

    // get grafik transaksi 1 tahun
    public function grafikLabelTahunan()
    {
        $data = DB::select("SELECT tgl_service,SUM(total_bayar) as 'jumlah' FROM service_table GROUP BY  YEAR(tgl_service), MONTH(tgl_service) LIMIT 12");
        // dd($labelChart);
        return $data;
    }

    // penjualan barang selama satu tahum
    public function grafikPenjualanBarang()
    {
        $data = DB::select("SELECT a.tgl_service, b.jasa, sum(b.jumlah) as 'jumlah' FROM service_table a JOIN detail_service b ON a.id_service=b.id_service where b.id_barang IS NOT NULL and YEAR(a.tgl_service) = year(now()) GROUP BY b.id_barang LIMIT 12");
        // dd($labelChart);
        return $data;
    }
    // penjualan barang by id barang selama satun tahun terakir
    public function grafikPenjualanBaranByIdg($id_barang)
    {
        $data = DB::select("SELECT a.tgl_service, b.jasa, sum(b.jumlah) as 'jumlah' FROM service_table a JOIN detail_service b ON a.id_service=b.id_service where b.id_barang = $id_barang GROUP  BY b.id_barang, YEAR(tgl_service), MONTH(tgl_service) LIMIT 12");
        // dd($labelChart);
        return $data;
    }

    // get report data service
    public function getReport()
    {
        $data = DB::select("SELECT * FROM service_table");
        // dump($data);
        // die;
        // menampung data service dan detail
        $reportData = [];
        foreach ($data as $key => $value) {
            $idService = $value->id_service;
            $data[$key]->detail = DB::select("SELECT * FROM detail_service WHERE id_service = $idService");
        }
        // dd($data);
        return $data;
    }

    // get report by tgl service
    public function getReportBy($tgl_awal, $tgl_akhir)
    {
        $data = DB::select("SELECT * FROM service_table WHERE DATE(tgl_service) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        // menampung data service dan detail
        $reportData = [];
        foreach ($data as $key => $value) {
            $idService = $value->id_service;
            $data[$key]->detail = DB::select("SELECT * FROM detail_service WHERE id_service = $idService");
        }
        // dd($data);
        return $data;
    }
}
