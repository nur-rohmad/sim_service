@extends('layout/main')
@section('addcss')
<!-- load style select 2 -->
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
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
            {{-- notification --}}
            @if (session('succes'))
            <script>
                Swal.fire({
                                    icon: 'success',
                                    title: "{{ session('succes') }}",
                                    showConfirmButton: false,
                                    timer: 2000
                                    })
            </script>
            @endif
            @if (session('gagal'))
            <script>
                Swal.fire({
                                    icon: 'error',
                                    title: "{{ session('gagal') }}",
                                    showConfirmButton: false,
                                    timer: 2000
                                    })
            </script>
            @endif
            {{-- notification --}}
            <div class="card shadow">
                <div class="card-header bg-info d-flex justify-content-between">
                    <h3 class="card-title text-white my-2">Update Service
                    </h3>
                    <a href="#" id="btnKembali" class="btn btn-light "> <i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/service/{{ $data->id_service }}" method="POST" id="formService">
                        <div class="row">
                            @method("PUT")
                            @csrf
                            <div class="col-md-6 ">
                                <table width="100%" class="fw-normal fs-5">
                                    <tr>
                                        <td width="30%" class="fw-bolder">Tanggal Service</td>
                                        <td width="5%">:</td>
                                        <td><input type="date"
                                                class="form-control my-2 @error('tgl_service') is-invalid @enderror"
                                                name="tgl_service" value="{{ old('tgl_service',$data->tgl_service) }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="fw-bolder">Nama Pelanggan</td>
                                        <td width="5%">:</td>
                                        <td>
                                            <input type="text"
                                                class="form-control my-2 @error('nama_pelanggan') is-invalid @enderror"
                                                name="nama_pelanggan"
                                                value="{{ old('nama_pelanggan', $data->nama_pelanggan) }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="fw-bolder">Alamat Pelanggan</td>
                                        <td width="5%">:</td>
                                        <td><input type="text"
                                                class="form-control my-2 @error('alamat_pelanggan') is-invalid @enderror"
                                                name="alamat_pelanggan"
                                                value="{{ old('alamat_pelanggan',$data->alamat_pelanggan) }}"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 ">
                                <table width="100%" class="fw-normal fs-5">
                                    <tr>
                                        <td width="40%" class="fw-bolder">Barang Service</td>
                                        <td width="5%">:</td>
                                        <td>
                                            <input type="text"
                                                class="form-control my-2 @error('barang_service') is-invalid @enderror"
                                                name="barang_service"
                                                value="{{ old('barang_service',$data->barang_service) }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%" class="fw-bolder">Status Service</td>
                                        <td width="5%">:</td>
                                        <td>
                                            <select name="status_service" id="" class="form-control my-2">
                                                <option value="proses_pengerjaan" {{ $data->status_service ==
                                                    'proses_pengerjaan' ?
                                                    "selected" :
                                                    '' }}>Proses Pengerjaan</option>
                                                <option value="selesai" {{ $data->status_service == 'selesai' ?
                                                    "selected" :
                                                    '' }}>Selesai</option>
                                                <option value="sudah_diambil" {{ $data->status_service ==
                                                    'sudah_diambil' ?
                                                    "selected" : '' }}>Sudah diambil</option>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td width="40%" class="fw-bolder">Kondisi Awal Barang</td>
                                        <td width="5%">:</td>
                                        <td>
                                            <textarea name="kondisi_awal_barang" id="" cols="10" rows="4"
                                                class="form-control my-2">{{ old('kondisi_awal_barang',$data->kondisi_awal_barang) }}</textarea>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" value="{{ $total_bayar }}" name="total_bayar">
                    </form>
                    <form action="/tambahJasa" method="POST" class="my-4">
                        <div class="row">
                            @csrf
                            <input type="hidden" value="{{ $data->id_service }}" name="id_service">
                            <div class="col-md-3">
                                <select class="form-control " id="jenisInput">
                                    <option value="">Pilihan Input</option>
                                    <option value="barang">Barang</option>
                                    <option value="jasa">Jasa</option>
                                </select>
                                <select name="barang_id" class="d-none form-control " id="barang">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barang as $result)
                                    <option value="{{ $result->barang_id }}">{{ $result->nama_barang }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="jasa" required
                                    class="form-control d-none @error('jasa') is-invalid @enderror" name="jasa"
                                    placeholder="Jasa atau barang" value="{{ old('jasa') }}">
                                @error('jasa')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror"
                                    name="harga_satuan" placeholder="harga satuan" id="harga_satuan"
                                    value="{{ old('harga_satuan') }}">
                                @error('harga_satuan')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" placeholder="Jumlah" id="jumlah_jasa" value="{{ old('jumlah') }}">
                                @error('jumlah')
                                <div class="valid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="text" readonly
                                    class="form-control @error('total_harga') is-invalid @enderror" name="total_harga"
                                    placeholder="Total Harga" id="total_harga">
                                @error('total_harga')
                                <div class="valid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success text-white col-md-2"> <i
                                    class="fas fa-plus me-2"></i>
                                tambah</button>

                            <div class="col-md-2">
                                <button type="reset" class="btn btn-outline-dark "> <i class="fas fa-undo me-2"></i>
                                    reset</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-4">
                        <table class="table user-table no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jasa / Seperpat</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
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
                                    <td>
                                        <form action="/hapusJasa" method="POST"
                                            id="formDeleteItem{{ $item->id_detail_service }}">
                                            @csrf
                                            <input type="hidden" name="id_service_detail"
                                                value="{{ $item->id_detail_service }}">
                                            <input type="hidden" name="id_service" name="id_service"
                                                value="{{ $item->id_service }}">
                                            <button type="button" class="btn btn-sm btn-danger text-white"
                                                onclick="deleteconfirm('{{ $item->id_detail_service }}')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align="right" colspan="4" class="fw-bolder">Total</td>
                                    <td colspan="2">Rp. {{ number_format($total_bayar) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button id="btnSubmitService" class="btn btn-success text-white me-2 my-2 float-end"> <i
                        class="fas fa-check me-2"></i>
                    simpan</button>
            </div>
        </div>
    </div>
</div>
</div>

</div>
@endsection
@section('addscript')
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
            });
    });

    $('#barang').change(() => {
        let barang_id = $('#barang').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/getBarang",
            type: "POST",
            dataType: "JSON",
            data: {
                'id_barang': barang_id,
                '_token': token
            },
            success: function(data){
                console.log(barang_id)
                console.log(data)
                $('#harga_satuan').val(data.harga_barang)
                $('#jasa').val(data.nama_barang)
            },
            error:function(data){
                console.log(data.responseJSON.message)
            }
        })
    });
    $('#btnSubmitService').click(() => {
            $('#formService').submit()
        })

        $('#btnKembali').click(() => {
            let oldTotalBayar = {{ $data->total_bayar }};
            let totalBayarSekarang ={{  $total_bayar  }}
            if(oldTotalBayar != totalBayarSekarang){
                Swal.fire({
                title: 'Anda telah melakukan perubhan ?',
                icon: 'warning',
                text : "harap menyimpan perubahan yang anda lakukan sebelum keluar dari halaman ini !!",
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#formService').submit()
                } 
                })
            }else{
                window.location.href = "/service";
            }
        })

        function getHargaTotal(){
            let hargaSatuan = $('#harga_satuan').val();
            let jumlahJasa = $('#jumlah_jasa').val();

            let totalHarga = hargaSatuan * jumlahJasa;
            $('#total_harga').val(totalHarga);
        }

        $( document ).ready(function() {
            $('#jumlah_jasa').change(() => {
                getHargaTotal();
            })
            $('#harga_satuan').change(() => {
                getHargaTotal();
            })
            $('#jenisInput').change(() => {
               $('#jenisInput').addClass('d-none')
               let pilihan = $('#jenisInput').val()
               if(pilihan == 'barang'){
                   $('#barang').addClass('select2')
                $('#barang').removeClass('d-none')
                $('.select2').select2({
                theme: 'bootstrap4',
                });
               }else if(pilihan == 'jasa'){
                $('#jasa').removeClass('d-none')
               }
            })
        });

        function deleteconfirm(id){
            Swal.fire({
            title: 'Anda yakin ingin menghapus Item ?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Batal`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                 $('#formDeleteItem'+id).submit()
            } else if (result.isDenied) {
                 Swal.fire('Data gagal dihapus', '', 'error')
            }
            })
        }

</script>
@endsection