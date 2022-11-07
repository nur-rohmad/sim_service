@extends('layout/main')
@section('main')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Service</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">service Page</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info d-flex justify-content-between">
                    <h3 class="card-title text-white my-2">Detail Service
                    </h3>
                    <div class="div">
                        <button class="btn btn-danger text-white" id="btnCetak"><i class="fas fa-print me-2"></i>cetak
                            Invoice</button>
                        <a href="/service" class="btn btn-light "> <i class="fas fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <table width="100%" class="fw-normal fs-5">
                                <tr>
                                    <td width="40%" class="fw-bolder">Tanggal Service</td>
                                    <td width="5%">:</td>
                                    <td>{{ date('d-m-Y', strtotime($data->tgl_service)) }}</td>
                                </tr>
                                <tr>
                                    <td width="40%" class="fw-bolder">Nama Pelanggan</td>
                                    <td width="5%">:</td>
                                    <td>{{ $data->nama_pelanggan }}</td>
                                </tr>
                                <tr>
                                    <td width="40%" class="fw-bolder">Alamat Pelanggan</td>
                                    <td width="5%">:</td>
                                    <td>{{ $data->alamat_pelanggan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 ">
                            <table width="100%" class="fw-normal fs-5">
                                <tr>
                                    <td width="40%" class="fw-bolder">Barang Service</td>
                                    <td width="5%">:</td>
                                    <td>{{ $data->barang_service }}</td>
                                </tr>
                                <tr>
                                    <td width="40%" class="fw-bolder">Kondisi Awal Barang</td>
                                    <td width="5%">:</td>
                                    <td>{{ $data->kondisi_awal_barang }}</td>
                                </tr>
                                <tr>
                                    <td width="40%" class="fw-bolder">Status Service</td>
                                    <td width="5%">:</td>
                                    <td class="fw-6 my-0">
                                        @if ($data->status_service == 'proses pengerjaan')
                                        <span class="badge  bg-warning">{{
                                            $data->status_service }}</span>
                                        @elseif($data->status_service == 'selesai')
                                        <span class="badge  bg-success">{{
                                            $data->status_service }}</span>
                                        @else
                                        <span class="badge  bg-dark">{{
                                            $data->status_service }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table user-table no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jasa / Seperpat</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$detail_service->isEmpty())
                                    @foreach ($detail_service as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jasa }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ number_format($item->harga_satuan) }}</td>
                                        <td>{{ number_format($item->total_harga) }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center"><i class="fas fa-folder-open me-2"></i>Data
                                            Kosong</td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    @if ($total_bayar != null)
                                    <tr>
                                        <td align="right" colspan="4" class="fw-bolder">Total</td>
                                        <td colspan="1">Rp. {{ number_format($total_bayar) }}</td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('addscript')
<script>
    $('#btnCetak').click(() => {
        var mywindow = window.open('/cetak-invoice/{{ $data->id_service }}', 'cetak invoice', 'height=600,width=1000');
    })

</script>
@endsection