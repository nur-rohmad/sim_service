{{-- coaba --}}
<title>Cetek Invoice</title>
<link href="/css/style.min.css" rel="stylesheet">
<style>
    @media print {
        @page {
            size: landscape
        }
    }
</style>
<div class="container-lg card" id="invoice">
    <div class="row ">
        <div class="col-sm-6">
            <div class="gambar float-start">
                <img class="rounded-sm me-2" src="/images/logo_GoTravel.png" style="width: 150px;">
            </div>
            <div class="text pt-4" style="color: black;">
                <h4><strong> PT. Go Travel </strong></h4>
                <h6>Jl. Pandhawa No. 25 Bintoyo Padas Padas Ngawi</h6>
                <h6>adminTravel@gotravel.com</h6>
                <h6>Wa. 08428282898</h6>
            </div>
        </div>

        <div class="col-sm-6 d-flex justify-content-end pe-4"
            style="color: black; font-weight: bold; letter-spacing: 10px;">
            <h1 class="pt-5">INVOICE</h1>
        </div>
    </div>

    <hr style=" border: 8px solid rgba(0, 0, 0, 0.041); color: black; background-color: black">

    <div class="row">
        <div class="col-sm-12">
            <h6 class="pb-3" style="font-size: 30px;"><strong>Kepada Yth. </strong></h6>
        </div>
        <div class="col-sm-6" style="color: black; font-family: 'Times New Roman', Times, serif; letter-spacing: 2px;">
            <table width="100%" style="font-size: 15px">
                <tr>
                    <td width="20%">Nama Pelanggan</td>
                    <td width="1%">:</td>
                    <td width="20%">{{ $data->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <td>No HP Pelanggan</td>
                    <td>:</td>
                    <td>{{ $data->noHp_pelanggan }}</td>
                </tr>
                <tr>
                    <td>Alamat Pelanggan</td>
                    <td>:</td>
                    <td>{{ $data->alamat_pelanggan }}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6 " style="color: black; font-family: 'Times New Roman', Times, serif; letter-spacing: 2px;">
            <div>
                <table width="100%" style="font-size: 15px">
                    <tr>
                        <td width="20%">No Invoice</td>
                        <td width="1%">:</td>
                        <td width="20%">S-{{ $data->id_service }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Sevice</td>
                        <td>:</td>
                        <td>{{ date('l, d F Y',strtotime($data->tgl_service))}}</td>
                    </tr>
                    <tr>
                        <td>Kondisi Awal Barang</td>
                        <td>:</td>
                        <td>{{ $data->kondisi_awal_barang }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr style="background-color: #009EFB;">
                            <th class="text-white fw-bold">No</th>
                            <th class="text-white fw-bold">Jasa / Seperpat</th>
                            <th class="text-white fw-bold">Jumlah</th>
                            <th class="text-white fw-bold">Harga Satuan</th>
                            <th class="text-white fw-bold">Total Harga </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_service as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jasa }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ number_format($item->harga_satuan) }}</td>
                            <td>{{ number_format($item->total_harga) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="4" class="fw-bolder">Total</td>
                            <td colspan="1">Rp. {{ number_format($total_bayar) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-5" style="color: black; font-family: 'Times New Roman', Times, serif; letter-spacing: 1px;">
            <div class="col-8">

            </div>

            <div class="col-4">
                <div style="padding-start: 300px;">
                    <h5 class="">{{ date('l, d F Y') }}</h5>
                    <h5 class="mb-5">Hormat Kami</h5>
                    <h5>PT. GoTravel Indonesi</h5>
                </div>
            </div>
        </div>
    </div>
    {{-- coaba --}}
</div>
<script>
    window.print();
</script>