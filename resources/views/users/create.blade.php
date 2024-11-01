@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sertifikat/</span> Add Data
        </h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic with Icons -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add Data Sertifikat table
                        </h5>
                        <small class="text-muted float-end">Merged input group</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Username</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" aria-label="John Doe" name="name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="email" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="NO. 001/DEV-AIDEV/VI/2024" aria-label="John Doe" name="email"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="password" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="NO. 001/DEV-AIDEV/VI/2024" aria-label="John Doe" name="password"
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Confirm
                                    Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="password" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="NO. 001/DEV-AIDEV/VI/2024" aria-label="John Doe"
                                            name="confirm-password" aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <select name="roles[]" class="form-control" multiple="multiple">
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}">
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                    <a href="{{ route('sertifikat.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                                <div class="col-sm-5" style="margin-left: -31.5%;">
                                    <button type="submit" class="btn btn-info">Submit &nbsp;<i
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

{{-- FUNGSI CREATE DATA PINDAH KE MODAL DI SERTIFIKAT/INDEX.BLADE.PHP --}}
