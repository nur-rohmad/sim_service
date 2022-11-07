@extends('layout/main')
@section('addcss')
<link rel="stylesheet" href="/plugins/chartist/dist/chartist.min.css">
<!-- load style select 2 -->
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('main')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Dashboard</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Jumlah Barang</h5>
                                    <div class="">
                                        <i class="fas fa-boxes fa-4x"></i>
                                        <h2 class="py-2 float-end me-3" style="font-size: 4em">{{ $jumlahBarang }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- card item --}}
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3"> Sevice Bulan {{ date('M-Y') }}</h5>
                                    <div class="">
                                        <i class="fas fa-wrench fa-4x"></i>
                                        <h2 class="py-2 float-end me-3" style="font-size: 4em">{{ $serviceBulanIni }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- card item --}}
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Service dalam Proses</h5>
                                    <div class="">
                                        <i class="fas fa-hourglass-half fa-4x"></i>
                                        <h2 class="py-2 float-end me-3" style="font-size: 4em">{{ $serviceDiproses }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- card item --}}
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Pendapatan {{ date('M-Y') }}</h5>
                                    <div class="">
                                        <i class="fas fa-hand-holding-usd fa-3x"></i>
                                        <h2 class="py-2 float-end me-3" style="font-size: 1.6em">{{
                                            number_format($jumlahPendapatan) }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- card item --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- chart Pendapatan --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Grafik Pendapatan 1 Tahun Terakir</h3>
                </div>
                <div class="card-body">

                    <div id="myChart"></div>
                </div>
            </div>
        </div>
        {{-- end chart --}}
        {{-- chart Penjualan Barang --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between pe-4">
                    <h3 class="card-title py-2">Grafik Penjualan Barang Tahun {{ date("Y") }}</h3>
                    <select name="barang_id" id="barang" class="select2 col-5">
                        <option value=""></option>
                        @foreach ($data_barang as $result)
                        <option value="{{ $result->barang_id }}">{{ $result->nama_barang }}</option>
                        @endforeach


                    </select>
                </div>
                <div class="card-body">

                    <div id="myChartBarang"></div>
                </div>
            </div>
        </div>
        {{-- end chart --}}
    </div>

</div>
@endsection
@section('addscript')
<script src="/plugins/apexcharts/apexcharts.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true,
                theme: 'bootstrap4',
            });
    });

    var options = {
    chart: {
    type: 'line'
    },
    series: [{
    name: 'pendapatan',
    data: <?= $grafik['jumlah'] ?>
    }],
    colors: ['#33b2df'],
    xaxis: {
    categories: <?= $grafik['label'] ?>
    }
    }
    
    var chart = new ApexCharts(document.querySelector("#myChart"), options); 
    chart.render();
    // grafik penjualan barang
    var options1 = {
    chart: {
    type: 'bar'
    },
    series: [{
    name: 'pendapatan',
    data: <?= $grafikBarang['jumlah'] ?>
    }],
    colors: ['#33b2df', '#00000'],
    xaxis: {
    categories: <?= $grafikBarang['label'] ?>
    }
    }
    
    var chartBarang = new ApexCharts(document.querySelector("#myChartBarang"), options1);
    
    chartBarang.render();

    $('#barang').change(() =>{
       let  barang_id =  $('#barang').val();
       let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
        url: "/getGrafikBarang",
        type: "POST",
        dataType: "JSON",
        data: {
        'id_barang': barang_id,
        '_token': token
        },
        success: function(data){
            // let data = JSON.stringify(data)
            let jumlah = data.jumlah
            let label = data.label
          
        console.log(data)
            chartBarang.updateSeries([{
                name: 'Penjualan Barang',
                data: jumlah,
            }])
            chartBarang.updateOptions({
                xaxis: {
                categories: label
                }
            })
        },
        error:function(data){
        console.log(data.responseJSON.message)
        }
        })
    })

</script>
@endsection