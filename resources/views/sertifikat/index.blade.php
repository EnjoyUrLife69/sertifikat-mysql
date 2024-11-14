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

                        @include('sertifikat.create')
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
                                        @include('sertifikat.edit')

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
