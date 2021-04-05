@extends('layout')

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ພາບລວມລະບົບ</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h2>{{ $user_count }} ທ່ານ</h2>
                                <h4>ຈຳນວນ ສສ ທັງໝົດ</h4>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h2>{{ $all_count }} ທ່ານ</h2>
                                <h4>ຈຳນວນຜູ້ທີ່ເລືອກແລ້ວ</h4>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h2>{{ $yes }} ທ່ານ</h2>
                                <h4>ຈຳນວນຜູ້ເຫັນດີ</h4>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h2>{{ $no }} ທ່ານ</h2>
                                <h4>ຈຳນວນຜູ້ບໍ່ເຫັນດີ</h4>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h2>{{ $mute }} ທ່ານ</h2>
                                <h4>ຈຳນວນຜູ້ງົດອອກສຽງ</h4>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <hr>
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- PIE CHART -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">ອັດຕາສ່ວນການລົງຄະແນນ</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            // var data = <?php echo json_encode($count); ?> ;;
            // console.log(data);
            var mute = {{ $mute }};
            var no = {{ $no }};
            var yes = {{ $yes }};
            var all_count = {{ $all_count }};
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'ງົດອອກສຽງ (%)',
                    'ບໍ່ເຫັນດີ (%)',
                    'ເຫັນດີ (%)',
                ],
                datasets: [{
                    data: [(mute * 100 / all_count).toFixed(2), (no * 100 / all_count).toFixed(2), (yes * 100 / all_count).toFixed(2)],
                    backgroundColor: ['#5cb85c', '#d9534f', '#0275d8'],
                }]
            };
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })

    </script>
@endsection
