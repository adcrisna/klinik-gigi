@extends('layouts.pasien')
@section('css')
    <style>
        :disabled {
            background-color: #11d1c7 !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Booking</p>
            </div>
            <center>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="width: 600px !important;">
                    <div class="team-item position-relative rounded overflow-hidden">
                        @if (\Session::has('msg_success'))
                            <div class="alert alert-primary">
                                {{ \Session::get('msg_success') }}
                            </div>
                        @endif
                        @if (\Session::has('msg_error'))
                            <div class="alert alert-danger">
                                {{ \Session::get('msg_error') }}
                            </div>
                        @endif
                        <form action="{{ route('pasien.order') }}" method="POST" enctype="multipart/form-data"
                            id="formBooking">
                            @csrf
                            <div class="row g-3" style="width: 500px !important;">
                                <div class="col-12">
                                    <label>Pilih Cabang Klinik</label>
                                    <select name="klinik" class="form-control border-0" id="klinik"
                                        style="background-color: white" required>
                                        <option value="">Pilih</option>
                                        @foreach ($klinik as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label>Pilih Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label>Pilih Service</label>
                                    <select name="service" class="form-control border-0" id="service"
                                        style="background-color: white" required>
                                        <option value="">Pilih</option>
                                        @foreach ($service as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label>Pilih Jam</label>
                                    <select name="jam" class="form-control border-0" id="jam"
                                        style="background-color: white" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                                <br>
                                <p class="text-primary" style="display: none" id="berhasil">Silahkan melakukan Booking</p>
                                <p class="text-danger" style="display: none" id="gagal">Maaf, Silahkan Pilih
                                    Tanggal atau Jam yang lain!
                                </p>
                                <p class="text-danger" style="display: none" id="cabang">Cabang Klinik Harus Dipilih!
                                </p>
                                <p class="text-danger" style="display: none" id="date">Tanggal Harus Dipilih!
                                </p>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" id="btnBooking" type="submit"
                                        disabled>Booking</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var klinik = $('#klinik').val();
            var tanggal = $('#tanggal').val();
            console.log(tanggal);
            if (klinik === null || tanggal === null) {
                $('#date').show();
                $('#cabang').show();
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#service').on('change', function() {

                    $.ajax({
                        url: '{{ route('pasien.cekJam') }}',
                        method: 'POST',
                        data: {
                            id: $(this).val()
                        },
                        success: function(response) {
                            console.log(response);

                            $.each(response.data, function(key, data) {
                                $('#jam').append(new Option(data,
                                    data))
                            })
                        }
                    })
                });
            }

            $('#jam').on('change', function() {
                var formData = $('#formBooking').serialize();
                console.log(formData);
                $.ajax({
                    url: '{{ route('pasien.cekBooking') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response == 0) {
                            $('#berhasil').show();
                            $('#gagal').hide();
                            $('#date').hide();
                            $('#cabang').hide();
                            $('#btnBooking').prop('disabled', false);
                        } else if (response == 1) {
                            $('#berhasil').hide();
                            $('#gagal').show();
                            $('#date').hide();
                            $('#cabang').hide();
                            $('#btnBooking').prop('disabled', true);
                        } else if (response == 2) {
                            $('#berhasil').hide();
                            $('#gagal').hide();
                            $('#date').hide();
                            $('#cabang').show();
                            $('#btnBooking').prop('disabled', true);
                        } else if (response == 3) {
                            $('#berhasil').hide();
                            $('#gagal').hide();
                            $('#date').show();
                            $('#cabang').hide();
                            $('#btnBooking').prop('disabled', true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });
        });
    </script>
@endsection
