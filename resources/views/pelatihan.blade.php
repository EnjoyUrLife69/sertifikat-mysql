@extends('layouts.user')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="bg-breadcrumb-single"></div>
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Comprehensive Professional Training Program</h4>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('more') }}">Training</a></li>
                <li class="breadcrumb-item active text-primary">{{ $training->nama_training }}</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <!-- About Start -->
    <div class="container-fluid about bg-light py-5" id="about">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <h4 class="text-primary">About Training</h4>
                    <h1 class="display-5 mb-4">{{ $training->nama_training }}</h1>
                    <p class="text ps-4 mb-4" style="font-size: 20px">{!! $training->konten !!}
                    </p>
                </div>
                <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="about-img">
                        <img src="{{ asset('User/img/about-11.svg') }}" class="img-fluid w-100 rounded-bottom"
                            alt="Image">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- About End -->
@endsection
