<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok_barang',
        'foto_barang',
        'created_at',
    ];

    //barang yang telah terjual
    public function barangTerjual()
    {
        $data = DB::select("SELECT * FROM barang WHERE barang_id IN (SELECT id_barang FROM detail_service WHERE id_barang IS NOT NULL)");
        // dd($labelChart);
        return $data;
    }
}
