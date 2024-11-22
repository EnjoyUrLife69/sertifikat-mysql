@extends('layouts.user')

@section('content')

    <body>
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="bg-breadcrumb-single"></div>
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Training List</h4>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Training</li>
                </ol>
            </div>
        </div>
        <!-- Header End -->

        {{-- resources\views\more.blade.php --}}
        <div class="container my-5">
            <div class="row g-4">
                <center>
                    <div style="width: 100%">
                        <h1 style="font-size: 30px; color: #102147" class="display-5 mb-4">Temukan berbagai program
                            pelatihan yang dirancang untuk meningkatkan keterampilan Anda dan memperluas wawasan Anda menuju
                            kesuksesan.</h1>
                    </div>
                </center>
                @foreach ($training as $data)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100 wow fadeInUp" data-wow-delay="0.1s">
                            <img src="{{ asset('storage/' . $data->cover) }}" class="img-fluid w-100 rounded-top fixed-img"
                                alt="Cover Image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $data->nama_training }}</h5>
                                <p class="card-text">{{ $data->formatted_tanggal }}</p>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($data->konten, 75) !!}</p>
                                <a href="{{ url('pelatihan', $data->id) }}" class="btn btn-primary mt-auto">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('welcome') }}" class="btn btn-secondary btn-lg"
                    style="width: 50%; margin-bottom: 15.5rem; margin-top:4rem;">Kembali</a>
            </div>
        </div>


    </body>
@endsection
