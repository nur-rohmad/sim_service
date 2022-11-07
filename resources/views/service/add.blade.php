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
            <form action="/service" method="POST" class="form-horizontal form-material mx-2">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between">
                        <h3 class="card-title float-start my-2">Tambah Service</h3>
                        <a href="/service" class="btn btn-light "> <i class="fas fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Nama Pelanggan</label>
                            <div class="col-md-12">
                                <input type="text"
                                    class="form-control ps-0 form-control-line @error('nama_pelanggan') is-invalid @enderror"
                                    autofocus name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" />
                                @error('nama_pelanggan')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Alamat Pelanggan</label>
                            <div class="col-md-12">
                                <input type="text"
                                    class="form-control ps-0 form-control-line @error('alamat_pelanggan') is-invalid @enderror"
                                    name="alamat_pelanggan" value="{{ old('alamat_pelanggan') }}">
                                @error('alamat_pelanggan')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Barang Yang diservice</label>
                            <div class="col-md-12">
                                <input type="text"
                                    class="form-control ps-0 form-control-line @error('barang_service') is-invalid @enderror"
                                    name="barang_service" value="{{ old('barang_service') }}">
                                @error('barang_service')
                                <div id=" validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Kondisi Awal Barang</label>
                            <div class="col-md-12">
                                <textarea rows="5"
                                    class="form-control ps-0 form-control-line @error('kondisi_awal_barang') is-invalid @enderror"
                                    name="kondisi_awal_barang">{{ old('kondisi_awal_barang') }}</textarea>
                                @error('kondisi_awal_barang')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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