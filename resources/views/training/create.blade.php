@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training/</span> Add Data
        </h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic with Icons -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add Data Training table
                        </h5>
                        <small class="text-muted float-end">Merged input group</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('training.store') }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jenis
                                    Training</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_training"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal
                                    Mulai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class='bx bx-calendar'></i></span>
                                        <input class="form-control" type="date" name="tanggal_mulai" id="tanggal_mulai"
                                            value="{{ date('y-m-d') }}" id="html5-date-input" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal
                                    Selesai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class='bx bx-calendar'></i></span>
                                        <input class="form-control" name="tanggal_selesai" id="tanggal_selesai"
                                            type="date" value="{{ date('y-m-d') }}" id="html5-date-input" />
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
                                            placeholder="AI Development" aria-label="John Doe" name="kode"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Cover</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class='bx bx-image'></i></span>
                                        <input class="form-control" type="file" id="formFile" name="cover" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Isi Konten</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-comment"></i>
                                        </span>
                                        <textarea id="basic-icon-default-message" class="form-control" name="konten"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- <!-- Include CKEditor 5 CDN -->
                                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

                                            <!-- Initialize CKEditor 5 -->
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#basic-icon-default-message'))
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            </script> --}}


                            {{-- <!-- Include CKEditor CDN -->
                                            <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

                                            <!-- Initialize CKEditor -->
                                            <script>
                                                CKEDITOR.replace('basic-icon-default-message');
                                            </script> --}}

                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                    <a href="{{ route('training.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                                <div class="col-sm-5" style="margin-left: -31.5%;">
                                    <button type="submit" class="btn btn-info">Send &nbsp;<i
                                            class='bx bx-send'></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- FUNGSI CREATE PINDAH KE MODAL DI TRAINING/INDEX.BLADE.PHP --}}
