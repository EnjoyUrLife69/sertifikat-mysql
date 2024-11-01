@extends('layouts.user')

@section('content')
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel" id="carosel">
        <div class="header-carousel-item">
            <div class="header-carousel-item-img-1">
                <img src="{{ asset('User/img/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-start p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4 fadeInUp animate__animated"
                        data-animation="fadeInUp" data-delay="0.3s" style="animation-delay: 0.3s;">Pelatihan Berkualitas &
                        Sertifikasi Terpercaya</h1>
                    <p class="mb-5 fs-5 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="0.5s"
                        style="animation-delay: 0.5s;">Tingkatkan keahlianmu dengan pelatihan profesional dan dapatkan
                        sertifikat resmi yang diakui. Kami menyediakan platform untuk memastikan kesuksesan karirmu.</p>
                </div>
            </div>

        </div>
        <div class="header-carousel-item mx-auto">
            <div class="header-carousel-item-img-2">
                <img src="{{ asset('User/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-center p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4">Pelatihan dan Sertifikasi Terbaik untuk Masa
                        Depanmu</h1>
                    <p class="mb-5 fs-5">Kami menawarkan pelatihan berkualitas dengan sertifikasi resmi yang diakui.
                        Persiapkan diri kamu untuk tantangan dunia kerja dengan keahlian yang lebih baik.</p>
                    {{-- <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4" href="#">Daftar Sekarang</a>
        <a class="btn btn-dark rounded-pill py-3 px-5 mb-4" href="#">Pelajari Lebih Lanjut</a> --}}
                </div>
            </div>

        </div>
        <div class="header-carousel-item">
            <div class="header-carousel-item-img-3">
                <img src="{{ asset('User/img/carousel-3.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-end p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4">Tingkatkan Kemampuanmu dengan Sertifikasi
                        Profesional</h1>
                    <p class="mb-5 fs-5">Dapatkan pelatihan terbaik yang akan membekalimu dengan sertifikat resmi untuk
                        menunjang karirmu. Kami hadir untuk memastikan setiap langkah suksesmu.</p>
                    {{-- <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4" href="#">Daftar Sekarang</a>
    <a class="btn btn-dark rounded-pill py-3 px-5 mb-4" href="#">Pelajari Lebih Lanjut</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Cek Sertifikat Start -->
    <div class="container-fluid sertifikat py-5 bg-light" id="sertifikat">
        <div class="container py-5 mt-5" style="margin-bottom: 5rem;">
            <div id="result" class="card py-5 shadow-lg border-0 rounded wow fadeInUp" data-wow-delay="0.1s"
                style="margin-bottom: 5rem;">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px">
                    <h4 class="text-primary">Sertifikat</h4>
                    <h1 class="display-4">Konfirmasi Sertifikat Kamu</h1>
                    <p class="fs-5">Verifikasi sertifikat pelatihan kamu di sini dengan mudah. Masukkan nomor
                        sertifikat untuk memulai pengecekan.</p>
                </div>

                <div class="row g-4 justify-content-center " style="margin-top: -70px;">
                    <div class="container justify-content-center"></div>
                    <div class="col-lg-8 wow fadeInUp text-center" data-wow-delay="0.1s">
                        <!-- Form untuk mengecek sertifikat -->
                        <form action="{{ route('checkCertificate') }}" method="POST">
                            @csrf
                            <label for="no_sertifikat" class="form-label text-center">
                                <h3>Masukan No. Sertifikat</h3>
                            </label>
                            <input type="text" class="form-control text-center nomor_sertifikat w-100"
                                placeholder="NO. XXX/XX-XXX/XX/XXXX" id="no_sertifikat" name="nomor_sertifikat">
                            <button class="btn btn-primary mt-4 w-100" type="submit">Cek</button>
                        </form>
                        <!-- Tempat untuk menampilkan hasil -->
                        <div id="" class="form-group w-100 mt-4">
                            @if (session('status') && session('message'))
                                <div class="alert alert-{{ session('status') }}">
                                    {!! session('message') !!}
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cek Sertifikat End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5 bg-light" id="service" style="margin-top: -10rem;">
        <div class="container py-5">
            <div class="container-fluid service py-5 bg-light" id="service">
                <div class="container py-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h4 class="text-primary">Training</h4>
                        <h1 class="display-4"> Agenda Training</h1>
                    </div>
                    <div class="row g-4 justify-content-center text-center">

                        @foreach ($limitTraining as $data)
                            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                                <a href="{{ url('pelatihan', $data->id) }}">
                                    <div class="service-item bg-light rounded d-flex flex-column h-100">
                                        <div class="service-img">
                                            <img src="{{ asset('storage/' . $data->cover) }}"
                                                class="img-fluid w-100 rounded-top fixed-img" alt="Cover Image">
                                        </div>
                                        <div class="service-content text-center p-4 flex-grow-1 d-flex flex-column">
                                            <div class="service-content-inner mb-auto">
                                                <a href="#" class="h4 mb-4 d-inline-flex text-start">
                                                    <i class="fas fa-donate fa-2x me-2"></i>{{ $data->nama_training }}
                                                </a>
                                                <p class="mb-4">
                                                    {{ $data->formatted_tanggal_training }}
                                                </p>
                                            </div>
                                            <a class="btn btn-light rounded-pill py-2 px-4 mt-auto" id="read_more"
                                                href="{{ url('pelatihan', $data->id) }}">Read More</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.1s"
                                href="{{ route('more') }}">More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- About Start -->
    <div class="container-fluid about bg-light py-5" id="about">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="about-img">
                        <img src="{{ asset('User/img/about-3.png') }}" class="img-fluid w-100 rounded-top bg-white"
                            alt="Image">
                        <img src="{{ asset('User/img/about-2.jpg') }}" class="img-fluid w-100 rounded-bottom"
                            alt="Image">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <h4 class="text-primary">Tentang Kami</h4>
                    <h1 class="display-5 mb-4">Solusi Pelatihan dan Sertifikasi Terbaik untuk Masa Depan Anda</h1>
                    <p class="text ps-4 mb-4">Kami berkomitmen untuk menyediakan pelatihan berkualitas tinggi yang
                        mendukung pengembangan karier Anda. Dengan sertifikat yang diakui secara global, Anda akan
                        diperlengkapi dengan keahlian terbaik untuk bersaing di dunia kerja.</p>
                    <div class="row g-4 justify-content-between mb-5">
                        <div class="col-lg-6 col-xl-5">
                            <p class="text-dark"><i class="fas fa-check-circle text-primary me-1"></i> Pelatihan
                                Berkualitas</p>
                            <p class="text-dark mb-0"><i class="fas fa-check-circle text-primary me-1"></i>
                                Sertifikasi Resmi</p>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <p class="text-dark"><i class="fas fa-check-circle text-primary me-1"></i> Program
                                Fleksibel</p>
                            <p class="text-dark mb-0"><i class="fas fa-check-circle text-primary me-1"></i>
                                Instruktur Berpengalaman</p>
                        </div>
                    </div>
                    <div class="row g-4 justify-content-between mb-5">
                        {{-- <div class="col-xl-5"><a href="#"
                                        class="btn btn-primary rounded-pill py-3 px-5">Temukan Lebih Lanjut</a></div> --}}
                        <div class="col-xl-7 mb-5">
                            <div class="about-customer d-flex position-relative">
                                <img src="{{ asset('User/img/customer-img-1.jpg') }}"
                                    class="img-fluid btn-xl-square position-absolute" style="left: 0; top: 0;"
                                    alt="Image">
                                <img src="{{ asset('User/img/customer-img-2.jpg') }}"
                                    class="img-fluid btn-xl-square position-absolute" style="left: 45px; top: 0;"
                                    alt="Image">
                                <img src="{{ asset('User/img/customer-img-3.jpg') }}"
                                    class="img-fluid btn-xl-square position-absolute" style="left: 90px; top: 0;"
                                    alt="Image">
                                <img src="{{ asset('User/img/customer-img-1.jpg') }}"
                                    class="img-fluid btn-xl-square position-absolute" style="left: 135px; top: 0;"
                                    alt="Image">
                                <div class="position-absolute text-dark" style="left: 220px; top: 10px;">
                                    <p class="mb-0">5m+ Terpercaya</p>
                                    <p class="mb-0">Pelanggan Global</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center">
                        <div class="col-sm-4">
                            <div class="bg-primary rounded p-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value fs-1 fw-bold text-dark" data-toggle="counter-up">32</span>
                                    <h4 class="text-dark fs-1 mb-0" style="font-weight: 600; font-size: 25px;">k+
                                    </h4>
                                </div>
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <p class="text-white mb-0">Proyek Selesai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="bg-dark rounded p-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value fs-1 fw-bold text-white" data-toggle="counter-up">21</span>
                                    <h4 class="text-white fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+
                                    </h4>
                                </div>
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <p class="mb-0">Tahun Pengalaman</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="bg-primary rounded p-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value fs-1 fw-bold text-dark" data-toggle="counter-up">97</span>
                                    <h4 class="text-dark fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+
                                    </h4>
                                </div>
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <p class="text-white mb-0">Anggota Tim</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    </div>
    </div>
    <!-- Cek Sertifikat End -->
@endsection
