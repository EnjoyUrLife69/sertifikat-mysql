@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel Data /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Training</b>
                </h4>
            </div>
            <div class="col-md-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted"> {{ Auth::user()->getRoleNames()->first() }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item preview-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="row">
                                <div class="col">
                                    <i class="bx bx-power-off me-2"></i>
                                </div>
                                <div class="col" style="margin-left: -120px">
                                    <span class="fw-semibold d-block">Logout</span>
                                </div>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bordered Table -->
        <div class="card">
            <div class="row" style="margin-top: 10px;">
                <div class="col-4">
                    <h5 class="card-header">Data Training Tables</h5>
                </div>

                {{-- FILTER BY TAHUN --}}
                <div class="col-4">
                    <form method="GET" action="{{ route('training.index') }}">
                        <div class="row" style="margin-left: 137px;">
                            <div class="col-md-5" style="margin-top: 16px; margin-left: -90px;">
                                <select class="select2" name="tahun"
                                    style="margin-top: 16px; width: 220px; margin-left: -60px;" id="exampleSelectYear">
                                    <option value="" {{ is_null(request()->get('tahun')) ? 'selected' : '' }}>
                                        Tampilkan Semua Data
                                    </option>
                                    @foreach ($tahunList as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ request()->get('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="margin-left: 90px;">
                                <button type="submit" style="margin-top: 16px; margin-left: 70px;"
                                    class="btn btn-info d-flex align-items-center">
                                    <i class='bx bx-filter-alt' style="margin-right: 8px;"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- EXPORT BUTTON --}}
                <div class="col-2">
                    <div class="dropdown" style="margin-top: 16px; margin-left: 52px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-export'></i> Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            {{-- EXPORT TO PDF BUTTON --}}
                            {{-- <li>
                                <a class="dropdown-item" href="#">
                                    <i class='bx bxs-file-pdf'></i> PDF
                                </a>
                            </li> --}}
                            {{-- EXPORT TO EXCEL BUTTON --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('export.training') }}">
                                    <i class='bx bxs-file-export'></i> Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- CREATE DATA --}}
                <div class="col-2">
                    <div class="mt-3">
                        <!-- Button trigger modal -->
                        @can('training-create')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                <i class='bx bx-plus-circle'></i> Add Data
                            </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Data Training
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('training.store') }}" method="post" role="form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Nama<b style="color: red">*</b>
                                                        Training</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <input type="text" class="form-control"
                                                                id="basic-icon-default-fullname"
                                                                placeholder="AI Development" aria-label="John Doe"
                                                                name="nama_training" value="{{ old('nama_training') }}"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('nama_training')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-company">Tanggal<b style="color: red">*</b>
                                                        Mulai</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-company2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-calendar'></i></span>
                                                            <input class="form-control" name="tanggal_mulai"
                                                                id="tanggal_mulai" type="date"
                                                                value="{{ old('tanggal_mulai') }}"
                                                                value="{{ date('y-m-d') }}" id="html5-date-input" />
                                                        </div>
                                                        @error('tanggal_mulai')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-company">Tanggal<b style="color: red"> *</b>
                                                        Selesai</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-company2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-calendar'></i></span>
                                                            <input class="form-control" name="tanggal_selesai"
                                                                id="tanggal_selesai" type="date"
                                                                value="{{ old('tanggal_selesai') }}"
                                                                value="{{ date('y-m-d') }}" id="html5-date-input" />
                                                        </div>
                                                        @error('tanggal_selesai')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Kode<b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-lock-open-alt'></i></span>
                                                            <input type="text" class="form-control"
                                                                id="basic-icon-default-fullname" placeholder="XX-XXXX"
                                                                aria-label="John Doe" name="kode"
                                                                value="{{ old('kode') }}"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('kode')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 form-label"
                                                        for="basic-icon-default-phone">Cover<b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-phone2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-image'></i></span>
                                                            <input class="form-control" value="{{ old('cover') }}"
                                                                type="file" id="formFile" name="cover" required />
                                                        </div>
                                                        <small class="form-text text-muted">
                                                            jpeg, png, jpg, gif, svg, webp.
                                                        </small>
                                                        @error('cover')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 form-label"
                                                        for="basic-icon-default-message">Deskripsi<b style="color: red"> *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> --}}
                                                            <textarea id="exampleFormControlTextarea1" class="form-control konten" name="konten"
                                                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ old('konten') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelatihan</th>
                                <th>tanggal</th>
                                <th>Peserta</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($training as $data)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td><b>{{ $data->nama_training }}</b></td>
                                    <td>{{ $data->formatted_tanggal }}</td>
                                    <td><b>{{ $data->sertifikat_count }}</b> Peserta</td>
                                    <td>
                                        {{-- SHOW DATA --}}
                                        <a href="{{ route('training.show', $data->id) }}" class="btn btn-sm btn-warning"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true" title="<span>Show</span>"><i class='bx bx-show-alt'></i>
                                        </a>

                                        {{-- EDIT DATA --}}
                                        @can('training-edit')
                                            <a href="{{ route('training.edit', $data->id) }}" class="btn btn-sm btn-primary"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title="<span>Edit</span>"><i class='bx bxs-edit-alt'></i>
                                            </a>
                                        @endcan

                                        {{-- DELETE DATA --}}
                                        @can('training-delete')
                                            @if ($data->sertifikat_count == 0)
                                                <form id="deleteForm{{ $data->id }}"
                                                    action="{{ route('training.destroy', $data->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        id="deleteButton{{ $data->id }}" data-bs-toggle="tooltip"
                                                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                        title="<span>Delete</span>">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
                                            @else
                                                &nbsp;
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->


    </div>
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



    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#exampleFormControlTextarea1', // Pastikan ini sesuai dengan ID textarea
                height: 350,
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.getBody().style.width =
                            '100%'; // Mengatur lebar editor mengikuti lebar container
                    });
                },
            });
        });
    </script> --}}
@endsection
