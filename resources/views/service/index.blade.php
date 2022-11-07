@extends('layout.main')
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
            {{-- notification --}}
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title float-start my-2">Daftar Service</h3>
                    <a href="/service/create" id="tambah_service" class="btn btn-light float-end"> Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table user-table no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Tanggal Service</th>
                                    <th>Nama Pelanggann</th>
                                    <th>Alamat Pelanggan</th>
                                    <th>Status Service</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->barang_service }}</td>
                                    <td>{{ $result->tgl_service }}</td>
                                    <td>{{ $result->nama_pelanggan }}</td>
                                    <td>{{ $result->alamat_pelanggan }}</td>
                                    <td>
                                        @if ($result->status_service == 'proses_pengerjaan')
                                        <span class="badge  bg-warning">Proses Pengerjaan</span>
                                        @elseif($result->status_service == 'selesai')
                                        <span class="badge  bg-success">Selesai</span>
                                        @else
                                        <span class="badge  bg-dark">Sudah diambil</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/service/{{ $result->id_service }}"
                                            class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i></a>
                                        <a href="/service/{{ $result->id_service }}/edit"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="/service/{{ $result->id_service }}" method="post" class="d-inline"
                                            id="formDelete{{ $result->id_service }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger inline border-0 text-white"
                                                type="button" onclick="deleteconfirm('{{ $result->id_service }}')"><i
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