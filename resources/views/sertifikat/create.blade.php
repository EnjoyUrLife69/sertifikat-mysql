<!-- Create Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add Data
                    Sertifikat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sertifikat.store') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                Peserta<b style="color: red">*</b></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-user'></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="Enter Name" required style="padding-left: 15px;"
                                        name="nama_penerima" aria-describedby="basic-icon-default-fullname2"
                                        value="{{ old('nama_penerima') }}" />
                                </div>
                                @error('nama_penerima')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama<b
                                    style="color: red"> *</b>
                                Pelatihan</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-category'></i></span>
                                    <select id="defaultSelect" class="select2 form-select form2 custom-select" required
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
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-email2" class="input-group-text">
                                        <i class='bx bx-envelope'></i>
                                    </span>
                                    <input type="email" class="form-control" id="basic-icon-default-email"
                                        name="email" style="padding-left: 15px;" placeholder="Enter Email"
                                        aria-describedby="basic-icon-default-email2" value="{{ old('email') }}" />
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
