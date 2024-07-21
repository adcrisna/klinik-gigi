@extends('layouts.index')
@section('css')
@endsection

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Login</p>
                    <h1 class="mb-4">Login and Make An Appointment To Visit Our Doctor</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
                        eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form action="{{ route('prosesLogin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Email"
                                        style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="password" name="password" class="form-control border-0"
                                        placeholder="Password" style="height: 55px;" required>
                                </div>
                                @if (\Session::has('msg_login'))
                                    <div class="alert alert-danger">
                                        {{ \Session::get('msg_login') }}
                                    </div>
                                @endif
                                @if (\Session::has('msg_success'))
                                    <div class="alert alert-primary">
                                        {{ \Session::get('msg_success') }}
                                    </div>
                                @endif
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
