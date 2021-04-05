@extends('homeLayout')

@section('body')

    <div class="container pt-5">
        <!-- Small boxes (Stat box) -->

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

        @if (!session()->get('is_select_subject'))

            @if (session()->get('alert') == 'exist')
                <div class="modal fade" id="modal_alert">
                    <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                            <div class="modal-header">
                                <h4 class="modal-title">ທ່ານໄດ້ໂຫວດຫົວຂໍ້ນີ້ໄປແລ້ວ !!!</h4>
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
            @if ($bad_user)
                <div class="modal fade" id="modal_alert">
                    <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                            <div class="modal-header">
                                <h4 class="modal-title">ຜູ້ໃຊ້ຖືກປິດໃຊ້ງານ</h4>
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
            @else
                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">ກະລຸນາເລືອກຫົວຂໍ້ທີ່ຕ້ອງການໂຫວດ :</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="/selectSubject">
                                    @csrf
                                    @foreach ($subjects as $key => $item)
                                        <div class="row pb-3">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="subject"
                                                        id="{{ $key }}" value="{{ $item->id }}"
                                                        {{ $key == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $key }}">
                                                        {{ $item->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary px-5">ຕົກລົງ</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            @endif
        @else
            <div class="row">
                <div class="col">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">ກະລຸນາເລືອກ :</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form method="POST" action="/election">
                                @csrf
                                <input type="hidden" name="subject_id" value="{{ session()->get('id') }}">
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subject_choice" id="yes"
                                                value="yes" checked>
                                            <label class="form-check-label" for="yes">
                                                ເຫັນດີ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subject_choice" id="no"
                                                value="no">
                                            <label class="form-check-label" for="no">
                                                ບໍ່ເຫັນດີ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="subject_choice" id="mute"
                                                value="mute">
                                            <label class="form-check-label" for="mute">
                                                ງົດອອກຄຳຄິດເຫັນ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success px-5">ບັນທຶກ</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        @endif
        <!-- /.row -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('logout') }}" class="btn btn-danger"
                onclick="event.preventDefault();
                                                                                                                            document.getElementById('logout-form').submit();"
                {{ __('Logout') }}><i class="fa fa-sign-out pull-right"></i>
                ອອກຈາກລະບົບ</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @if (Auth::user()->is_admin == 1)
                <a href="/subjects" class="btn btn-info"><i class="fa fa-sign-out pull-right"></i>
                    ຜູ້ດູແລລະບົບ</a>
            @endif
        </div>

    </div><!-- /.container-fluid -->
    <!-- /.content -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#modal_alert').modal('show')
        })

    </script>
@endsection
