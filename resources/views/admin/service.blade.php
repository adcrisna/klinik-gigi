@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        img.zoom {
            width: 130px;
            height: 100px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }

        .transisi {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -o-transform: scale(1.8);
            transform: scale(1.8);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Services</li>
        </ol>
        <br />
    </section>
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-info">
                    {{ \Session::get('msg_success') }}
                </div>
            </h5>
        @endif
        @if (\Session::has('msg_error'))
            <h5>
                <div class="alert alert-danger">
                    {{ \Session::get('msg_error') }}
                </div>
            </h5>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Services</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                data-target="#modal-form-tambah-klinik"><i class="fa fa-plus"> Tambah Data
                                </i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-klinik">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Jam Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$service as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>
                                            <img src="{{ asset('foto/' . $value->foto) }}" class="zoom"
                                                alt="foto service">
                                        </td>
                                        <td>{{ @$value->name }}</td>
                                        <td>{{ @$value->description }}</td>
                                        <td>
                                            @foreach (@$value->jam as $item)
                                                {{ $item }},
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-success btn-edit-klinik"><i class="fa fa-edit">
                                                    Ubah</i></button> &nbsp;
                                            <a href="{{ route('admin.deleteService', $value->id) }}"><button
                                                    class=" btn btn-xs btn-danger"
                                                    onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                        class="fa fa-trash"> Hapus</i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-form-tambah-klinik" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Service</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addService') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <label>Nama Service</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Service" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Service</label>
                            <input type="file" name="foto" class="form-control" placeholder="Foto Service" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Deskripsi</label>
                            <textarea name="description" id="description" cols="3" rows="1" class="form-control" required></textarea>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Jam Kerja</label>
                            <select class="js-example-basic-multiple form-control" style="width: 100%" name="jam[]"
                                multiple="multiple" required>
                                <option value="">Pilih</option>
                                <option value="14:00 - 14:30">14:00 - 14:30</option>
                                <option value="14:30 - 15:00">14:30 - 15:00</option>
                                <option value="14:00 - 15:00">14:00 - 15:00</option>
                                <option value="15:00 - 15:30">15:00 - 15:30</option>
                                <option value="15:30 - 16:00">15:30 - 16:00</option>
                                <option value="15:00 - 16:00">15:00 - 16:00</option>
                                <option value="16:00 - 16:30">16:00 - 16:30</option>
                                <option value="16:30 - 17:00">16:30 - 17:00</option>
                                <option value="16:00 - 17:00">16:00 - 17:00</option>
                                <option value="17:00 - 17:30">17:00 - 17:30</option>
                                <option value="17:30 - 18:00">17:30 - 18:00</option>
                                <option value="17:00 - 18:00">17:00 - 18:00</option>
                                <option value="18:00 - 18:30">18:00 - 18:30</option>
                                <option value="18:30 - 19:00">18:30 - 19:00</option>
                                <option value="18:00 - 19:00">18:00 - 19:00</option>
                                <option value="19:00 - 19:30">19:00 - 19:30</option>
                                <option value="19:30 - 20:00">19:30 - 20:00</option>
                                <option value="19:00 - 20:00">19:00 - 20:00</option>
                                <option value="20:00 - 20:30">20:00 - 20:30</option>
                                <option value="20:30 - 21:00">20:30 - 21:00</option>
                                <option value="20:00 - 21:00">20:00 - 21:00</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form-edit-klinik" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Ubah Service</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateService') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="id" readonly class="form-control" placeholder="ID"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Nama Service</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Service"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Service</label>
                            <input type="file" name="foto" class="form-control" placeholder="Foto Service">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Deskripsi</label>
                            <textarea name="description" id="description" cols="3" rows="1" class="form-control" required></textarea>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Jam Kerja</label>
                            <select class="js-example-basic-multiple form-control" style="width: 100%" name="jam[]"
                                multiple="multiple" required>
                                <option value="">Pilih</option>
                                <option value="14:00 - 14:30">14:00 - 14:30</option>
                                <option value="14:30 - 15:00">14:30 - 15:00</option>
                                <option value="14:00 - 15:00">14:00 - 15:00</option>
                                <option value="15:00 - 15:30">15:00 - 15:30</option>
                                <option value="15:30 - 16:00">15:30 - 16:00</option>
                                <option value="15:00 - 16:00">15:00 - 16:00</option>
                                <option value="16:00 - 16:30">16:00 - 16:30</option>
                                <option value="16:30 - 17:00">16:30 - 17:00</option>
                                <option value="16:00 - 17:00">16:00 - 17:00</option>
                                <option value="17:00 - 17:30">17:00 - 17:30</option>
                                <option value="17:30 - 18:00">17:30 - 18:00</option>
                                <option value="17:00 - 18:00">17:00 - 18:00</option>
                                <option value="18:00 - 18:30">18:00 - 18:30</option>
                                <option value="18:30 - 19:00">18:30 - 19:00</option>
                                <option value="18:00 - 19:00">18:00 - 19:00</option>
                                <option value="19:00 - 19:30">19:00 - 19:30</option>
                                <option value="19:30 - 20:00">19:30 - 20:00</option>
                                <option value="19:00 - 20:00">19:00 - 20:00</option>
                                <option value="20:00 - 20:30">20:00 - 20:30</option>
                                <option value="20:30 - 21:00">20:30 - 21:00</option>
                                <option value="20:00 - 21:00">20:00 - 21:00</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        var table = $('#data-klinik').DataTable();

        $('#data-klinik').on('click', '.btn-edit-klinik', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=name]').val(row[2]);
            $('textarea[name=description]').val(row[3]);
            $('#modal-form-edit-klinik').modal('show');
        });
        $('#modal-form-tambah-klinik').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('textarea[name=description]').val('');
            $('input[name=name]').val('');
        });

        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
