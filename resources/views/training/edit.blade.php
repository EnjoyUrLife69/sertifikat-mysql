@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Edit Data</b>
                </h4>
            </div>
            <div class="col-md-1">
                @include('partials.navbar')
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <form action="{{ route('training.update', $training->id) }}" method="post" role="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row" style="display: flex;">
                <div class="col-7" style="display: flex; flex-direction: column;">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0"><b>EDIT DATA</b>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama<b
                                        style="color: red">*</b>
                                    Training</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_training"
                                            style="padding-left: 15px;" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $training->nama_training }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama<b
                                        style="color: red">*</b>
                                    Training (sertifikat)</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_training_sertifikat"
                                            style="padding-left: 15px;" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $training->nama_training_sertifikat }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal<b
                                        style="color: red">*</b>
                                    Mulai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input class="form-control" type="date" name="tanggal_mulai"
                                            id="html5-date-input" style="padding-left: 15px;"
                                            value="{{ $training->tanggal_mulai }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal<b
                                        style="color: red">*</b>
                                    Selesai</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input class="form-control" name="tanggal_selesai" type="date"
                                            id="html5-date-input" style="padding-left: 15px;"
                                            value="{{ $training->tanggal_selesai }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kode<b
                                        style="color: red">*</b></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            style="padding-left: 15px;" placeholder="AI Development"
                                            aria-label="John Doe" name="kode" value="{{ $training->kode }}"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5" style="display: flex; flex-direction: column;">
                    <div class="card mb-4 card-equal-height">
                        <div class="card-body">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Cover</label>
                            <div class="col-sm-12">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class='bx bx-image'></i></span>
                                    <input class="form-control" type="file" id="formFile" name="cover"
                                        onchange="previewImage(event)" />
                                </div>
                                <small class="form-text text-muted">
                                    jpeg, png, jpg, gif, svg, webp.
                                </small>
                                <center>
                                    @if ($existingCover)
                                        <img id="preview" src="{{ asset('storage/' . $existingCover) }}"
                                            alt="Cover Image" width="300" class="mt-3">
                                    @else
                                        <img id="preview" src="" alt="No image uploaded" width="200"
                                            class="mt-3" style="display:none;">
                                    @endif
                                    @error('cover')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Deskripsi</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <textarea id="exampleFormControlTextarea1" style="width: 100%" class="form-control konten" name="konten"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ $training->konten }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                    <a href="{{ route('training.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                                <div class="col-sm-5" style="margin-left: -31.5%;">
                                    <button type="submit" class="btn btn-info">Submit &nbsp;<i
                                            class='bx bx-send'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block'; // Tampilkan preview gambar jika tidak ada sebelumnya
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#exampleFormControlTextarea1',
                height: 500, // Anda bisa menyesuaikan tinggi awal
                 toolbar: 'undo redo | styles | bold italic | bullist numlist | alignleft aligncenter alignright | outdent indent',
                plugins: 'lists link image',
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.getBody().style.width = '100%';
                    });
                    
                    // Menyesuaikan tinggi editor berdasarkan isi
                    editor.on('input', function() {
                        editor.getBody().style.height =
                            'auto'; // Set height to auto before getting scrollHeight
                        editor.getBody().style.height = (editor.getBody().scrollHeight) +
                            'px'; // Set height to scrollHeight
                    });
                },
            });
        });
    </script>
@endsection
