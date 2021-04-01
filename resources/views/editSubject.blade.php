@extends('layout')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ແກ້ໄຂຫົວຂໍ້</h1>
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
                            <h3 class="card-title">ແກ້ໄຂຫົວຂໍ້ :</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/updateSubject">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subject_name">ຊື່ຫົວຂໍ້</label>
                                    <input type="hidden" value="{{ $subject->id }}" name="id">
                                    <input type="text" class="form-control" value="{{ $subject->name }}"
                                        id="subject_name" name="subject_name" placeholder="ຊື່ຫົວຂໍ້">
                                </div>
                                <div class="form-group">
                                    <label for="detail">ລາຍລະອຽດ</label><br>
                                    <textarea class="form-control" id="detail" name="detail"
                                        rows="3">{{ $subject->detail }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ບັນທຶກ</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- ./col -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#modal_alert').modal('show');
    })

</script>
@endsection