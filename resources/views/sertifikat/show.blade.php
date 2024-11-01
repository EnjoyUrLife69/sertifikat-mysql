@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sertifikat /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Show Data</b>
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

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic with Icons -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Show Data Sertifikat table
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                    Peserta</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-user'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="nama_penerima" disabled
                                            style="padding-left: 15px; font-weight: bold;"
                                            aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $sertifikat->nama_penerima }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama
                                    Pelatihan</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <select id="defaultSelect" class="form-select" style="font-weight: bold;"
                                            name="id_training" disabled>
                                            <option>Default select</option>
                                            @foreach ($training as $data)
                                                <option disabled value="{{ $data->id }}"
                                                    {{ $data->id == $sertifikat->id_training ? 'selected' : '' }}>
                                                    {{ $data->nama_training }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-envelope'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="No Email" aria-label="John Doe" name="email" disabled
                                            style="padding-left: 15px; font-weight: bold;"
                                            aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $sertifikat->email }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Status</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <select class="form-control" id="status" name="status"
                                            style="padding-left: 15px; font-weight: bold;"
                                            aria-describedby="basic-icon-default-fullname2" disabled>
                                            <option value="0" {{ $sertifikat->status == 0 ? 'selected' : '' }}><b
                                                    style="color: red">Terdaftar
                                                    <b></option>
                                            <option value="1" {{ $sertifikat->status == 1 ? 'selected' : '' }}><b
                                                    style="color: green">
                                                    Selesai Pelatihan</b></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- SERTIFIKAT --}}
                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                    <a href="{{ route('sertifikat.index') }}" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($sertifikat->status == 1)
            <div class="row">
                <div class="col-xxl">
                    <div class="card" style="height: 820px">
                        <!-- Embed PDF preview in an iframe -->
                        <iframe style="height: 200%; border-radius: 10px"
                            src="{{ route('sertifikat.preview', $sertifikat->id) }}" width="100%"
                            height="500px"></iframe>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xxl">
                    <div class="card" style="height: 100px">
                        <!-- Embed PDF preview in an iframe -->
                        <center>
                            <h3 style="margin-top : 35px;">Sertifikat belum tersedia karena peserta <b>belum</b>
                                menyelesaikan pelatihan</h3>
                        </center>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
