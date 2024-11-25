@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Detail Data</b>
                </h4>
            </div>
            <div class="col-md-1">
                @include('backend.navbar')
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic with Icons -->
            <div class="col-7">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"><b style="color: #0B2B8A">DETAIL DATA</b>
                            <hr style="height: 3px; width: 95%; background-color: #0B2B8A">
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('training.update', $training->id) }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                    Training</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" disabled id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_training"
                                            style="padding-left: 15px;" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $training->nama_training }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                    Training (Sertfikat)</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" disabled id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_training_sertifikat"
                                            style="padding-left: 15px;" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $training->nama_training_sertifikat }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal
                                    Mulai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input class="form-control" type="date" name="tanggal_mulai" disabled
                                            id="html5-date-input" style="padding-left: 15px;"
                                            value="{{ $training->tanggal_mulai }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal
                                    Selesai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input class="form-control" name="tanggal_selesai" disabled type="date"
                                            id="html5-date-input" style="padding-left: 15px;"
                                            value="{{ $training->tanggal_selesai }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kode</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            style="padding-left: 15px;" placeholder="AI Development"
                                            aria-label="John Doe" name="kode" value="{{ $training->kode }}" disabled
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jumlah
                                    Peserta</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            style="padding-left: 15px;" placeholder="AI Development"
                                            aria-label="John Doe" name="kode"
                                            value="{{ $training->sertifikat_count }} Peserta" disabled
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('training.update', $training->id) }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <h5 class="card-title"><b style="color: #0B2B8A ">COVER IMAGE</b>
                                    <hr style="height: 3px; width: 31%; background-color: #0B2B8A">
                                </h5>
                                @csrf
                                <center><img class="card" src="{{ asset('storage/' . $training->cover) }}"
                                        width="350">
                                </center>
                            </div>
                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 4.5%; margin-top: 3.5%;">
                                    <a href="{{ route('training.index') }}" class="btn btn-danger"><i
                                            class='bx bx-arrow-back'></i> Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="col-sm-2 form-label" for="basic-icon-default-message">
                            <h5><b style="color: #0B2B8A">Deskripsi</b></h5>
                            <hr style="height: 3px; width: 54%; background-color: #0B2B8A">
                        </label>
                        <div class="col-sm-11" style="">
                            <div class="input-group input-group-merge" style="margin-left: 40px; font-size: 17px">
                                {!! $training->konten !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
