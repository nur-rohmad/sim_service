@extends('layout/main')
@section('main')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Profile</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        {{-- notification --}}
        @if (session('gagal'))
        <script>
            Swal.fire({
                                icon: 'error',
                                title: "Gagal",
                                text:"{{ session('gagal') }}",
                                showConfirmButton: false,
                                timer: 2000
                                })
        </script>
        @endif
        @if (session('success'))
        <script>
            Swal.fire({
                                icon: 'success',
                                title: "Sukses",
                                text:"{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 2000
                                })
        </script>
        @endif
        @error('imageProfile')
        <script>
            Swal.fire({
                                        icon: 'error',
                                        title: "gagal",
                                        text:"{{ $message }}",
                                        showConfirmButton: true,
                                        // timer: 2000
                                        })
        </script>
        @enderror
        {{-- notification --}}
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body profile-card">
                    <center class="mt-4">

                        <img src="{{ asset('storage/'. $userProfile->foto) }}" class="rounded-circle" width="150"
                            height="150" id="preview-image" />

                        <h4 class="card-title mt-2">{{ $userProfile->name }}</h4>
                        <h6 class="card-subtitle">{{ $userProfile->role }}</h6>

                    </center>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material mx-2" method="POST" action="/profile"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $userProfile->id }}">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" value="{{ old('name', $userProfile->name) }}"
                                    class="form-control ps-0 form-control-line @error('name') is-invalid @enderror"
                                    name="name">
                                @error('name')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" value="{{ old('email', $userProfile->email) }}"
                                    class="form-control ps-0 form-control-line @error('email') is-invalid @enderror"
                                    name="email" id="example-email">
                                @error('email')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Password Lama</label>
                            <div class="col-md-12">
                                <input type="password" value="{{ old('password_lama') }}" name="password_lama"
                                    class="form-control ps-0 form-control-line @error('password_lama') is-invalid @enderror">
                                @error('password_lama')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Password</label>
                            <div class="col-md-12">
                                <input type="password" value="{{ old('password') }}" name="password"
                                    class="form-control ps-0 form-control-line @error('password') is-invalid @enderror">
                                @error('password')
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 mt-2">
                                <input type="hidden" name="profile_lama" value="{{ $userProfile->foto }}">
                                <input type="file"
                                    class="form-control ps-0 form-control-line @error('foto') is-invalid @enderror"
                                    name="foto" value="{{ old('foto', $userProfile->foto) }}" id="foto">
                                @error('foto')
                                <div id=" validationServerUsernameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 ">
                                <button type="submit" class="btn btn-success  text-white float-end">Update
                                    Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>


@endsection
@section('addscript')
<script type="text/javascript">
    $(document).ready(function (e) {
       $('#foto').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
    
          $('#preview-image').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       });
      
    });
    
</script>
@endsection