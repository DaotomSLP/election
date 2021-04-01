@extends('layout')

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ເພີ່ມຜູ້ໃຊ້</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if (session()->get('alert') == 'insert_success')
            <div class="modal fade" id="modal_alert">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ບັນທຶກຂໍ້ມູນສຳເລັດ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @elseif (session()->get('alert') == 'not_insert')
            <div class="modal fade" id="modal_alert">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title">ເກີດຂໍ້ຜິດພາດ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !!!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">ເພີ່ມຜູ້ໃຊ້ :</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="/addUser">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">ຊື່ຜູ້ໃຊ້</label>
                                                <input type="text" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">ລະຫັດຜ່ານ</label>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-5">ເພີ່ມ</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ລາຍຊື່ຜູ້ໃຊ້ງານ</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table_data" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ລຳດັບ</th>
                                            <th>ຊື່ຜູ້ໃຊ້</th>
                                            <th>ສະຖານະ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $value)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $value->email }}
                                                </td>
                                                <td>
                                                    {{ $value->enabled == 1 ? 'ເປີດໃຊ້ງານ' : 'ປິດໃຊ້ງານ' }}
                                                </td>
                                                <td>
                                                    <a href="/editUser/{{ $value->id }}" class="px-3">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if ($value->enabled == 1)
                                                        <a href="/deleteUser/{{ $value->id }}" class="px-3">
                                                            <i class="fas fa-user-slash"></i>
                                                        </a>
                                                    @else
                                                        <a href="/openUser/{{ $value->id }}" class="px-3">
                                                            <i class="fas fa-user-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#modal_alert').modal('show')
        })

    </script>
@endsection
