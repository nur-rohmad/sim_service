@extends('layout.main')
@section('main')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Barang</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang Page</li>
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
            {{-- notification --}}
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title float-start my-2">Daftar Barang</h3>
                    <a href="/barang/create" id="tambah_service" class="btn btn-light float-end"> Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table user-table no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Foto Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Stok Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td> <img id="preview-image" src="{{ asset('storage/'. $barang->foto_barang) }}"
                                            alt="preview image" style="max-height: 100px; max-width: 100px;"> </td>
                                    <td>{{ $barang->harga_barang }}</td>
                                    <td>{{ $barang->stok_barang }}</td>
                                    <td>
                                        <a href="/barang/{{ $barang->barang_id }}/edit"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="/barang/{{ $barang->barang_id }}" method="post" class="d-inline"
                                            id="formDelete{{ $barang->barang_id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger inline border-0 text-white"
                                                type="button" onclick="deleteconfirm('{{ $barang->barang_id  }}')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
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
@section('addscript')
<script>
    function deleteconfirm(id){
        Swal.fire({
        title: 'Anda yakin ingin menghapus data ?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        denyButtonText: `Batal`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
        $('#formDelete'+id).submit()
        } else if (result.isDenied) {
        Swal.fire('Data gagal dihapus', '', 'error')
        }
        })
    }
   
</script>
@endsection