@extends('layouts.dokter')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('dokter.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <br />
    <br />
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-warning">
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <form action="{{ route('dokter.perawatanSelesai') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="hidden" name="id" readonly class="form-control"
                                    value="{{ $perawatan->id }}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p><b>Nama</b> : {{ $perawatan->Pasien->name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><b>No Telepon</b> : {{ $perawatan->Pasien->no_hp }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p><b>Klinik</b> : {{ $perawatan->Klinik->name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Service</b> : {{ $perawatan->Service->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p><b>Tanggal</b> : {{ $perawatan->tanggal }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Jam</b> : {{ $perawatan->jam }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Biaya :</label>
                                    <input type="number" class="form-control" name="biaya" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Catatan :</label>
                                    <textarea name="catatan" class="form-control" cols="3" rows="2" required></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-2 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat"
                                        style="border-radius: 10px"
                                        onclick="return confirm('Apakah anda yakin ?')">Selesai</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail Perawatan Sebelumnnya</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-sm-6">
                                <p><b>Nama</b> : {{ @$lastPerawatan->Pasien->name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><b>No Telepon</b> : {{ @$lastPerawatan->Pasien->no_hp }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><b>Klinik</b> : {{ @$lastPerawatan->Klinik->name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><b>Service</b> : {{ @$lastPerawatan->Service->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><b>Tanggal</b> : {{ @$lastPerawatan->tanggal }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><b>Dokter</b> : {{ @$lastPerawatan->Dokter->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><b>Biaya</b> : Rp.{{ number_format(@$lastPerawatan->biaya, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><b>Catatan</b> : {{ @$lastPerawatan->catatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
@endsection
