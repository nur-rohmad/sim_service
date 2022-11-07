@extends('layout.main')
@section('addcss')

@endsection
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
                    <form id="filterReport" action="/searchReport">
                        @csrf
                        <div class="row my-2">
                            <div class="col-md-2" id="tgl_awal">
                                <input type="date" name="tgl_service_awal" class="form-control" id="tgl_service_awal">

                            </div>

                            <div class="col-md-2 me-3">
                                <input type="date" name="tgl_service_akhir" class="form-control" id="tgl_service_akhir">
                            </div>
                            <button type="button" id="btn_kirim"
                                class="btn btn-circle btn-info text-white col-md-1 me-2"><i
                                    class="fas fa-search"></i></button>
                            <button type="button" id="btn_reset" class="btn btn-circle btn-outline-dark  col-md-1"><i
                                    class="fas fa-undo"></i></button>
                        </div>
                    </form>
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
    $(document).ready(function() {
        getAllData()
        
    })
    // get all data
    function getAllData(){
            $.ajax({
            url: "/getAllReport",
            type: "GET",
            dataType: "JSON",
            encode: true,
            beforeSend: function(){
            $("tbody").html(`<tr>
                <td colspan="7" align="center">
                    <div class="spinner-grow" role="status">
                        <div class="spinner-grow" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                </td>
            </tr>
            `)
            },
            success:function(data){
            console.log(data.data);
            let dataTable = pasteData(data.data)
            $("tbody").html(dataTable)
            },
            error:function(xhr, status, error){
            console.log("gagal")
            console.log(xhr.responseText)
            }
            })
    }
    // function ketika button reset
    $("#btn_reset").click((event)=>{
        $('#tgl_service_awal').val("")
        $('#tgl_service_akhir').val("")
            getAllData()
    })
    // function ketika button search
    $("#btn_kirim").click((event)=>{
        // ajax for submit data
        $.ajax({
            url: "/searchReport",
            type: "POST",
            data: {
                'tgl_service_awal' : $('#tgl_service_awal').val(),
                'tgl_service_akhir' : $('#tgl_service_akhir').val(),
                '_token': $("meta[name='csrf-token']").attr("content")
            },
            dataType: "JSON",
            encode: true,
            beforeSend: function(){
                $("tbody").html(`<tr>
                    <td colspan="7" align="center"> <div class="spinner-grow" role="status">
                      <div class="spinner-grow" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    </td>
                </tr>    
                `)
            },
            success:function(data){
                console.log(data)
                if (data.status == "OK") {
                    if (data.data.length <= 0) { let empetyTable=`<tr>
                        <td colspan="7" align="center"> <i class="fas fa-folder-open fa-2x mt-2"></i>
                            <p>Data Tidak di Temukan</p>
                        </td>
                        </tr>`
                        $("tbody").html(empetyTable)
                        }else{
                        let dataTable = pasteData(data.data)
                        $("tbody").html(dataTable)
                        }
                }else{
                    let empetyTable=`<tr>
                        <td colspan="7" align="center"> <i class="fas fa-folder-open fa-2x mt-2"></i>
                            <p>Data Tidak di Temukan</p>
                        </td>
                    </tr>`
                    $("tbody").html(empetyTable)
                  $("#error_tgl_awal").removeClass("none");
                  console.log(data.data.tgl_service_awal)
                  $("#error_tgl_awal").text(data.data.tgl_service_awal);
                }
               
            },
            error:function(xhr, status, error){
                console.log("gagal")
                console.log(xhr.responseText)
            }
        });
   
    })
    // funcution add data in table
    function pasteData(data){
       return  data.map((result)=>{
        return `<tr>
            <td></td>
            <td>${result.tgl_service}</td>
            <td>${result.nama_pelanggan}</td>
            <td>`+ result.detail.map((item) => {
                return `${item.jasa} <br><br>`
                }) +`</td>
            <td>`+ result.detail.map((item) => {
                return `${item.harga_satuan} <br><br>`
                }) +`</td>
            <td>`+ result.detail.map((item) => {
                return `${item.jumlah} <br><br>`
                }) +`</td>
            <td>`+ result.detail.map((item) => {
                return `${item.total_harga } <br><br>`
                }) +`</td>
        </tr>
        <tr>
            <td colspan="6" class="fw-bold" align="center">Total</td>
            <td>${result.total_bayar}</td>
        </tr>`
        })
    }
</script>

@endsection