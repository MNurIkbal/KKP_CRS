@extends('layouts.Admin.adm')

@section('content')
    <!-- Start right Content here -->

    <!-- ============================================================== -->

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                <!-- start page title -->
                @if (session()->get('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif

                <div class="row">

                    <div class="col-12">

                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item active">Dashboard</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- end page title -->

                <div class="row">

                    <div class="col-xl-4 col-md-4">

                        <div class="card border border-primary">

                            <div class="card-body">

                                <div class="d-flex">

                                    <div class="flex-grow-1">

                                        <p class="text-truncate font-size-14 mb-2">Jumlah Laporan Masuk</p>

                                        <h4 class="mb-2">{{ $laporanmasuk }}</h4>

                                    </div>

                                    <div class="avatar-sm">

                                        <span class="avatar-title bg-light text-primary rounded-3">

                                            <i class="fas fa-inbox"></i>

                                        </span>

                                    </div>

                                </div>

                            </div><!-- end cardbody -->

                        </div><!-- end card -->

                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-4">

                        <div class="card  border border-success">

                            <div class="card-body">

                                <div class="d-flex">

                                    <div class="flex-grow-1">

                                        <p class="text-truncate font-size-14 mb-2">Jumlah Laporan Selesai</p>

                                        <h4 class="mb-2">{{ $laporanselesai }}</h4>

                                    </div>

                                    <div class="avatar-sm">

                                        <span class="avatar-title bg-light text-primary rounded-3">

                                            <i class="fas fa-check-double"></i>

                                        </span>

                                    </div>

                                </div>

                            </div><!-- end cardbody -->

                        </div><!-- end card -->

                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-4">

                        <div class="card  border border-warning">

                            <div class="card-body">

                                <div class="d-flex">

                                    <div class="flex-grow-1">

                                        <p class="text-truncate font-size-14 mb-2">Jumlah Laporan Ditolak</p>

                                        <h4 class="mb-2">{{ $laporanbelumselesai }}</h4>

                                    </div>

                                    <div class="avatar-sm">

                                        <span class="avatar-title bg-light text-primary rounded-3">

                                            <i class="fas fa-paper-plane"></i>

                                        </span>

                                    </div>

                                </div>

                            </div><!-- end cardbody -->

                        </div><!-- end card -->

                    </div><!-- end col -->



                </div><!-- end row -->
                <div id="grafik" class="card-body bg-white" style="width: 100%;height: 500px;">

                </div>
            </div>

        </div>

        <!-- End Page-content -->


<br>
        <footer class="footer">

            <div class="container-fluid">

                <div class="row">

                    <div class="text-center">

                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Aplikasi CRS LLDIKTI Wilayah III

                    </div>


                </div>

            </div>

        </footer>


    </div>

    <!-- end main content-->



    </div>

    <!-- END layout-wrapper -->



    <!-- Right Sidebar -->



    <!-- /Right-bar -->



    <!-- Right bar overlay-->

    <div class="rightbar-overlay"></div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
         const grafikData = @json($grafik);
const labels = grafikData.map(item => {
    const date = new Date(item.bulan + '-01'); 
    return date.toLocaleString('default', { month: 'short', year: 'numeric' });
});

const data = grafikData.map(item => item.views);

var options = {
    series: [{
        name: "Grafik Laporan Perbulan",
        data: data
    }],
    chart: {
        height: 500,
        type: 'line',
        zoom: {
            enabled: false
        }
    },
    colors: ['#28a745'], // hijau
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth', // garis halus
        width: 3
    },
    title: {
        text: 'Grafik Laporan Perbulan',
        align: 'left'
    },
    grid: {
        row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0.5
        },
    },
    xaxis: {
        categories: labels
    }
};

var chart = new ApexCharts(document.querySelector("#grafik"), options);
chart.render();
    </script>

    @push('js')
        <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>
    @endpush
@endsection
