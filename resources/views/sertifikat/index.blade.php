@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel Data /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Sertifikat</b>
                </h4>
            </div>
            <div class="col-md-1">
                @include('partials.navbar')
            </div>
        </div>

        <!-- Bordered Table -->
        <div class="card">
            <div class="row" style="margin-top: 10px;">
                <div class="col-4">
                    <h5 class="card-header">Data Sertifikat Tables</h5>
                </div>

                {{-- FILTER BY TRAINING --}}
                <div class="col-4">
                    <form method="GET" action="{{ route('sertifikat.index') }}">
                        <div class="row" style="margin-left: 137px;">
                            <div class="col-md-5" style="margin-top: 16px; margin-left: -90px;">
                                <select class="select2 form-control form1" name="id_training" id="exampleSelectGender">
                                    <option value="" {{ is_null(request()->get('id_training')) ? 'selected' : '' }}>
                                        Tampilkan Semua Data
                                    </option>
                                    @foreach ($training as $data)
                                        <option value="{{ $data->id }}"
                                            {{ request()->get('id_training') == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama_training }}
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
                    @can('sertifikat-export')
                        <div class="dropdown" style="margin-top: 16px; margin-left: 47px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-export'></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                {{-- EXPORT TO PDF BUTTON --}}
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('export.pdf', ['id_training' => request()->get('id_training')]) }}">
                                        <i class='bx bxs-file-pdf'></i> PDF
                                    </a>
                                </li>
                                {{-- EXPORT TO EXCEL BUTTON --}}
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('export.excel', ['id_training' => request()->get('id_training')]) }}">
                                        <i class='bx bxs-file-export'></i> Excel
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endcan
                </div>

                {{-- CREATE DATA --}}
                <div class="col-2">
                    <div class="mt-3">
                        <!-- Button trigger modal -->
                        @can('sertifikat-create')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="margin-left: -10px;"
                                data-bs-target="#modalCenter">
                                <i class='bx bx-plus-circle'></i> Add Data
                            </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Data
                                            Sertifikat
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('sertifikat.store') }}" method="post" role="form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Nama
                                                        Peserta<b style="color: red">*</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i class='bx bx-user'></i></span>
                                                            <input type="text" class="form-control"
                                                                id="basic-icon-default-fullname" placeholder="Enter Name"
                                                                required style="padding-left: 15px;" name="nama_penerima"
                                                                aria-describedby="basic-icon-default-fullname2"
                                                                value="{{ old('nama_penerima') }}" />
                                                        </div>
                                                        @error('nama_penerima')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3 mt-2">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-company">Nama<b style="color: red"> *</b>
                                                        Pelatihan</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <select id="defaultSelect"
                                                                class="select2 form-select form2 custom-select" required
                                                                name="id_training">
                                                                <option value="">Pilih Pelatihan</option>
                                                                @foreach ($training as $data)
                                                                    <option value="{{ $data->id }}"
                                                                        {{ old('id_training') == $data->id ? 'selected' : '' }}>
                                                                        {{ $data->nama_training }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('id_training')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-email">Email</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-email2" class="input-group-text">
                                                                <i class='bx bx-envelope'></i>
                                                            </span>
                                                            <input type="email" class="form-control"
                                                                id="basic-icon-default-email" name="email"
                                                                style="padding-left: 15px;" placeholder="Enter Email"
                                                                aria-describedby="basic-icon-default-email2"
                                                                value="{{ old('email') }}" />
                                                        </div>
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL DATA --}}
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Nama Pelatihan</th>
                                <th>No Sertifikat</th>
                                <th>Status Pelatihan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $no=1; @endphp
                            @foreach ($sertifikat as $data)
                                <tr>
                                    <td>
                                        <center> {{ $no++ }} </center>
                                    </td>
                                    <td><b>{{ $data->nama_penerima }}</b></td>
                                    <td><b>{{ Str::limit($data->training->nama_training, 26) }}</b>
                                    </td>
                                    <td><b>{{ $data->nomor_sertifikat ?? '-' }}</b></td>
                                    <td>
                                        <span class="badge {{ $data->status ? 'bg-success' : 'bg-primary' }}">
                                            {{ $data->status ? 'Selesai Pelatihan' : 'Terdaftar' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- SHOW DATA --}}
                                        <a href="{{ route('sertifikat.show', $data->id) }}"
                                            class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="top" data-bs-html="true" title="Show">
                                            <i class='bx bx-show-alt'></i>
                                        </a>

                                        {{-- EDIT DATA --}}
                                        <!-- Button yang nge-trigger modal -->
                                        @can('sertifikat-edit')
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-bs-target="#Edit{{ $data->id }}" data-bs-toggle="modal">
                                                <i class='bx bx-edit' data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit" data-bs-offset="0,4" data-bs-html="true"></i>
                                            </button>
                                        @endcan
                                        <!-- Modal -->
                                        <div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditTitle">
                                                            Edit
                                                            Data Sertifikat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sertifikat.update', $data->id) }}"
                                                        method="post" role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle" class="form-label">Nama
                                                                        Peserta<b style="color: red"> *</b></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-user'></i></span>
                                                                        <input
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle" required
                                                                            class="form-control" name="nama_penerima"
                                                                            value="{{ $data->nama_penerima }}" />
                                                                    </div>
                                                                    @error('nama_penerima')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle" class="form-label">Nama
                                                                        Pelatihan<b style="color: red"> *</b></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-category'></i></span>
                                                                        <select id="defaultSelect" class="form-select"
                                                                            name="id_training">
                                                                            <option>Default
                                                                                select
                                                                            </option>
                                                                            @foreach ($training as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $item->id == $data->id_training ? 'selected' : '' }}>
                                                                                    {{ $item->nama_training }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        {{-- <select id="defaultSelect" class="form-select"
                                                                            required name="id_training">
                                                                            <option value="">Pilih Pelatihan</option>
                                                                            @foreach ($training as $data)
                                                                                <option value="{{ $data->id }}"
                                                                                    {{ old('id_training') == $data->id ? 'selected' : '' }}>
                                                                                    {{ $data->nama_training }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select> --}}
                                                                    </div>
                                                                    @error('id_training')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle"
                                                                        class="form-label">Email</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-user'></i></span>
                                                                        <input
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle"
                                                                            placeholder="Enter Email" class="form-control"
                                                                            name="email" value="{{ $data->email }}" />
                                                                    </div>
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle" class="form-label">Status
                                                                        Pelatihan<b style="color: red"> *</b></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-category'></i></span>
                                                                        <select id="defaultSelect" class="form-select"
                                                                            required name="status"
                                                                            aria-describedby="basic-icon-default-fullname2">
                                                                            <option value="0"
                                                                                {{ $data->status == 0 ? 'selected' : '' }}>
                                                                                Terdaftar
                                                                            </option>
                                                                            <option value="1"
                                                                                {{ $data->status == 1 ? 'selected' : '' }}>
                                                                                Selesai
                                                                                Pelatihan
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- DELETE DATA --}}
                                        @can('sertifikat-delete')
                                            <form id="deleteForm{{ $data->id }}"
                                                action="{{ route('sertifikat.destroy', $data->id) }}" method="POST"
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
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
