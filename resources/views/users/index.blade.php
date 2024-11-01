@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel Data /</span> <b data-aos="fade-left"
                        data-aos-duration="200">User</b>
                </h4>
            </div>
            <div class="col-md-1">
                @include('partials.navbar')
            </div>
        </div>

        <!-- Bordered Table -->
        <div class="card">
            <div class="row" style="margin-top: 10px;">
                <div class="col-10">
                    <h5 class="card-header">Data User Tables</h5>
                </div>
                {{-- CREATE DATA --}}
                <div class="col-2">
                    <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            <i class='bx bx-plus-circle'></i> Add Data
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Data
                                            User
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('users.store') }}" method="post" role="form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Username<b style="color: red">
                                                            *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ old('name') }}" id="basic-icon-default-fullname"
                                                                placeholder="Enter Name" required aria-label="John Doe"
                                                                name="name"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('username')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Email<b style="color: red">
                                                            *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <input type="email" class="form-control"
                                                                id="basic-icon-default-fullname" value="{{ old('email') }}"
                                                                placeholder="Enter Email" required aria-label="John Doe"
                                                                name="email"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Password<b style="color: red">
                                                            *</b></label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <input type="password" class="form-control"
                                                                value="{{ old('password') }}"
                                                                id="basic-icon-default-fullname" placeholder="Password"
                                                                required aria-label="John Doe" name="password"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-icon-default-fullname">Confirm<b style="color: red">
                                                            *</b> Password</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class='bx bx-category'></i></span>
                                                            <input type="password" class="form-control"
                                                                id="basic-icon-default-fullname"
                                                                placeholder="Confirm password" required
                                                                aria-label="John Doe" name="confirm-password"
                                                                aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        @error('confirm-password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Role -->
                                                <div class="row mb-3">
                                                    <label for="defaultSelect"
                                                        class="col-sm-2 col-form-label">Role</label>
                                                    <div class="col-sm-10">
                                                        <select id="defaultSelect" class="form-select" name="roles[]">
                                                            <option value="" disabled selected>Select Role</option>
                                                            @foreach ($roles as $value => $label)
                                                                <option value="{{ $value }}">{{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('roles')
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
                {{-- END CREATE DATA --}}
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td><b>{{ $user->name }}</b></td>
                                    <td><b>{{ $user->email }}</b></td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                @php
                                                    $role = strtolower(str_replace(' ', '', $v)); // Menghapus spasi dan mengonversi role ke huruf kecil
                                                @endphp
                                                <label
                                                    class="badge 
                                                        @if ($role == 'admin') bg-primary
                                                        @elseif($role == 'superadmin') bg-danger
                                                        @elseif($role == 'user') bg-info
                                                        @else bg-success @endif">
                                                    {{ ucfirst($v) }}
                                                    <!-- Menampilkan role dengan huruf pertama kapital -->
                                                </label>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>
                                        {{-- SHOW DATA --}}
                                        @can('user-edit')
                                            <button type="button" class="btn btn-sm btn-warning"
                                                data-bs-target="#Show{{ $user->id }}" data-bs-toggle="modal">
                                                <i class='bx bx-show-alt' data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Show" data-bs-offset="0,4" data-bs-html="true"></i>
                                            </button>
                                        @endcan
                                        <!-- Modal -->
                                        <div class="modal fade" id="Show{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditTitle">
                                                            Show
                                                            Data Sertifikat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.show', $user->id) }}" method="post"
                                                        role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle"
                                                                        class="form-label">Username</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-user'></i></span>
                                                                        <input
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle" required
                                                                            class="form-control" name="name" disabled
                                                                            value="{{ $user->name }}" />
                                                                    </div>
                                                                    @error('name')
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
                                                                                class='bx bx-envelope'></i></span>
                                                                        <input disabled
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle" required
                                                                            class="form-control" name="email"
                                                                            value="{{ $user->email }}" />
                                                                    </div>
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
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

                                        {{-- EDIT DATA --}}
                                        @can('user-edit')
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-bs-target="#Edit{{ $user->id }}" data-bs-toggle="modal">
                                                <i class='bx bx-edit' data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit" data-bs-offset="0,4" data-bs-html="true"></i>
                                            </button>
                                        @endcan
                                        <!-- Modal -->
                                        <div class="modal fade" id="Edit{{ $user->id }}" tabindex="-1"
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
                                                    <form action="{{ route('users.update', $user->id) }}" method="post"
                                                        role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle"
                                                                        class="form-label">Username</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-user'></i></span>
                                                                        <input
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle" required
                                                                            class="form-control" name="name"
                                                                            value="{{ $user->name }}" />
                                                                    </div>
                                                                    @error('name')
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
                                                                                class='bx bx-envelope'></i></span>
                                                                        <input
                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                            type="text" id="nameWithTitle" required
                                                                            class="form-control" name="email"
                                                                            value="{{ $user->email }}" />
                                                                    </div>
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle"
                                                                        class="form-label">Role</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <span id="basic-icon-default-fullname2"
                                                                            class="input-group-text"><i
                                                                                class='bx bx-category'></i></span>
                                                                        <select id="defaultSelect" class="form-select"
                                                                            name="roles[]">
                                                                            @foreach ($roles as $value => $label)
                                                                                <option value="{{ $value }}"
                                                                                    @if (in_array($value, $user->userRole)) selected @endif>
                                                                                    {{ $label }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    {{-- @error('id_training')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror --}}
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
                                        @can('user-delete')
                                            <form id="deleteForm{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    id="deleteButton{{ $user->id }}" data-bs-toggle="tooltip"
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
        <hr class="my-5" />
    </div>
@endsection
