@extends('layouts.petugas')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
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
            <li><a href="{{ route('dokter.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Payment</li>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data Payment</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-klinik">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pasien</th>
                                    <th>No Handphone</th>
                                    <th>Klinik</th>
                                    <th>Service</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th style="display: none">Biaya</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$payment as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->Pasien->name }}</td>
                                        <td>{{ @$value->Pasien->no_hp }}</td>
                                        <td>{{ @$value->Klinik->name }}</td>
                                        <td>{{ @$value->Service->name }}</td>
                                        <td>{{ @$value->tanggal }}</td>
                                        <td>{{ @$value->jam }}</td>
                                        <td style="display: none">{{ @$value->biaya }}</td>
                                        <td>Rp.{{ number_format(@$value->biaya, 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-primary btn-edit-klinik"><i class="fa fa-money">
                                                    Payment</i></button> &nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data Payment</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-klinik">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pasien</th>
                                    <th>No Handphone</th>
                                    <th>Klinik</th>
                                    <th>Service</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th style="display: none">Biaya</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$selesai as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->Pasien->name }}</td>
                                        <td>{{ @$value->Pasien->no_hp }}</td>
                                        <td>{{ @$value->Klinik->name }}</td>
                                        <td>{{ @$value->Service->name }}</td>
                                        <td>{{ @$value->tanggal }}</td>
                                        <td>{{ @$value->jam }}</td>
                                        <td style="display: none">{{ @$value->biaya }}</td>
                                        <td>Rp.{{ number_format(@$value->biaya, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('pdf', $value->id) }}" class="btn btn-primary"
                                                target="_blank"><i class="fa fa-envelope"></i> Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </section>
    <div class="modal fade" id="modal-form-edit-klinik" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Ubah Data Klinik</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('petugas.savePayment') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="id" readonly class="form-control" placeholder="ID" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Biaya</label>
                            <input type="text" name="biaya" class="form-control" placeholder="Biaya" readonly required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Metode Pembayaran</label>
                            <select name="pembayaran" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Tunai">Tunai</option>
                                <option value="QRIS">QRIS</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="Mandiri">Mandiri</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Bayar</button>
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
    <script type="text/javascript">
        var table = $('#data-klinik').DataTable();

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(number);
        }

        $('#data-klinik').on('click', '.btn-edit-klinik', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=biaya]').val('Rp.' + rupiah(row[7]));
            $('#modal-form-edit-klinik').modal('show');
        });

        $('#modal-form-tambah-klinik').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('textarea[name=alamat]').val('');
            $('input[name=name]').val('');
            $('input[name=no_tlpn]').val('');
            $('input[name=gmap]').val('');
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
