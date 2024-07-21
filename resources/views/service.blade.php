@extends('layouts.index')
@section('css')
@endsection

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Services</p>
                <h1>Our Services</h1>
            </div>
            <div class="row g-4">
                @foreach ($service as $key => $value)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative rounded overflow-hidden">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset('foto/' . $value->foto) }}" alt="foto">
                            </div>
                            <div class="team-text bg-light text-center p-4">
                                <h5>{{ $value->name }}</h5>
                                <p class="text-primary"></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
