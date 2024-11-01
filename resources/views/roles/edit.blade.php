@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Table /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Role & Permission</b>
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
                        <h5 class="mb-0">Edit Data Role table
                        </h5>
                        <small class="text-muted float-end">Merged input group</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="post" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class='bx bx-category'></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="AI Development" aria-label="John Doe" name="name"
                                            aria-describedby="basic-icon-default-fullname2" value="{{ $role->name }}" />
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Permission</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        @foreach ($permission as $key => $value)
                                            <div class="col-md-3">
                                                <label><input class="form-check-input permission-checkbox" type="checkbox"
                                                        name="permission[{{ $value->id }}]" value="{{ $value->id }}"
                                                        class="name" data-group="{{ explode('-', $value->name)[0] }}"
                                                        data-type="{{ explode('-', $value->name)[1] }}"
                                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                    {{ $value->name }}</label>
                                            </div>
                                            @if (($key + 1) % 4 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
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
