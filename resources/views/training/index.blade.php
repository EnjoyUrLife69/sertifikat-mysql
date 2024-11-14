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
                @include('partials.navbar')
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
                                <select class="select2 form1" name="tahun"
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

                        @include('training.create')

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
