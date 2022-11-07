@extends('layout.main');
@section('main')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Laporab</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Page</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Laporan Transaksi</h3>
                </div>
                <div class="card-body">
                    {{-- search filter --}}
                    <div class="row">

                    </div>
                    {{-- end search filter --}}
                    <div class="table-responsive py-4">
                        <table class="table user-table no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Barang / Jasa</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $result)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ date("d M Y", strtotime($result->tgl_service)) }}</td>
                                    <td>{{ $result->nama_pelanggan}}</td>
                                    <td>
                                        @foreach ($result->detail as $result2)
                                        {{ $result2->jasa }} <br><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($result->detail as $result2)
                                        {{ number_format($result2->harga_satuan) }} <br><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($result->detail as $result2)
                                        {{ number_format($result2->jumlah) }} <br><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($result->detail as $result2)
                                        {{ number_format($result2->total_harga) }} <br><br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="fw-bold" align="center">Total</td>
                                    <td class="fw-bold">{{ number_format($result->total_bayar)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection