<!-- Edit Modal -->
<div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditTitle">
                    Edit
                    Data Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sertifikat.update', $data->id) }}" method="post" role="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama
                                Peserta<b style="color: red"> *</b></label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-user'></i></span>
                                <input style="font-weight: bold; padding-left: 15px;" type="text" id="nameWithTitle"
                                    required class="form-control" name="nama_penerima"
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
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-category'></i></span>
                                <select id="defaultSelect" class="form-select" name="id_training">
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
                            <label for="nameWithTitle" class="form-label">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-user'></i></span>
                                <input style="font-weight: bold; padding-left: 15px;" type="text" id="nameWithTitle"
                                    placeholder="Enter Email" class="form-control" name="email"
                                    value="{{ $data->email }}" />
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
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-category'></i></span>
                                <select id="defaultSelect" class="form-select" required name="status"
                                    aria-describedby="basic-icon-default-fullname2">
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>
                                        Terdaftar
                                    </option>
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>
                                        Selesai
                                        Pelatihan
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
