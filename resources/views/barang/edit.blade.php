@extends('layout/main')
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

{{-- notification --}}
@if (session('gagal'))
<script>
    Swal.fire({
                        icon: 'erorr',
                        title: "Gagal",
                        text: "{{ session('gagal') }}"
                        showConfirmButton: false,
                        timer: 2000
                        })
</script>
@endif
{{-- notification --}}

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="/barang/{{ $barang->barang_id }}" method="POST" enctype="multipart/form-data"
                class="form-horizontal form-material mx-2">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between">
                        <h3 class="card-title float-start my-2">Edit barang</h3>
                        <a href="/barang" class="btn btn-light "> <i class="fas fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-body">
                        @method("PUT")
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Nama Barang</label>
                            <div class="col-md-12">
                                <input type="text"
                                    class="form-control ps-0 form-control-line @error('nama_barang') is-invalid @enderror"
                                    autofocus name="nama_barang"
                                    value="{{ old('nama_barang', $barang->nama_barang) }}" />
                                @error('nama_barang')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Harga Satuan Barang</label>
                            <div class="col-md-12">
                                <input type="number"
                                    class="form-control ps-0 form-control-line @error('harga_barang') is-invalid @enderror"
                                    name="harga_barang" value="{{ old('harga_barang', $barang->harga_barang) }}">
                                @error('harga_barang')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Stok Awal Barang</label>
                            <div class="col-md-12">
                                <input type="number"
                                    class="form-control ps-0 form-control-line @error('stok_barang') is-invalid @enderror"
                                    name="stok_barang" value="{{ old('stok_barang', $barang->stok_barang) }}">
                                @error('stok_barang')
                                <div id=" validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-2">Foto Barang</label>
                            <div class="row">

                                <div class="col-md-12 mb-2 text-center">
                                    <img id="preview-image" src="{{ asset('storage/'. $barang->foto_barang) }}"
                                        alt="preview image" style="max-height: 200px; max-width: 250px;">

                                    <input type="hidden" name="foto_lama" value="{{ $barang->foto_barang }}">
                                </div>
                                <div class="col-md-12">
                                    <input type="file"
                                        class="form-control ps-0 form-control-line @error('foto_barang') is-invalid @enderror"
                                        name="foto_barang" value="{{ old('foto_barang', $barang->foto_barang) }}"
                                        id="foto_barang">
                                    @error('foto_barang')
                                    <div id=" validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer py-3">
                        <button type="submit" class="btn btn-primary float-end me-2">Simpan</button>
                        <button type="reset" class="btn btn-outline-dark float-end me-2">Reset</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
@section('addscript')
<script type="text/javascript">
    $(document).ready(function (e) {
       $('#foto_barang').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
    
          $('#preview-image').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       });
      
    });
    
</script>
@endsection