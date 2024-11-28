@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-11">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel Data /</span> <b data-aos="fade-left"
                        data-aos-duration="200">Front Slider</b>
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
                    <h5 class="card-header">Front Slider Tables</h5>
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

                        @include('slider.create')

                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="myTable3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($slider as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><img src="{{ asset('storage/' . $data->image) }}" alt="" width="150px">
                                    </td>
                                    <td>{{ Str::limit($data->judul, 30) }}</td>
                                    <td>{{ Str::limit($data->deskripsi, 35) }}</td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input toggle-status" type="checkbox"
                                                id="switch-{{ $data->id }}" data-id="{{ $data->id }}"
                                                {{ $data->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- SHOW DATA --}}
                                        <button type="button" class="btn btn-sm btn-warning"
                                            data-bs-target="#Show{{ $data->id }}" data-bs-toggle="modal">
                                            <i class='bx bx-show-alt' data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Show" data-bs-offset="0,4" data-bs-html="true"></i>
                                        </button>
                                        @include('slider.show')


                                        {{-- EDIT DATA --}}
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-bs-target="#Edit{{ $data->id }}" data-bs-toggle="modal">
                                            <i class='bx bx-edit' data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit" data-bs-offset="0,4" data-bs-html="true"></i>
                                        </button>
                                        @include('slider.edit')


                                        {{-- DELETE DATA --}}
                                        <form id="deleteForm{{ $data->id }}"
                                            action="{{ route('slider.destroy', $data->id) }}" method="POST"
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
    <script>
        $(document).on('change', '.toggle-status', function() {
            let sliderId = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('slider.updateStatus', '') }}/" + sliderId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    </script>
@endsection
