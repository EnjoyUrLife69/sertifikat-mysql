<!-- Create Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add Data Training
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('training.store') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama<b
                                    style="color: red">*</b>
                                Training</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-category'></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="AI Development" aria-label="John Doe" name="nama_training"
                                        value="{{ old('nama_training') }}"
                                        aria-describedby="basic-icon-default-fullname2" />
                                </div>
                                @error('nama_training')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal<b
                                    style="color: red">*</b>
                                Mulai</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i
                                            class='bx bx-calendar'></i></span>
                                    <input class="form-control" name="tanggal_mulai" id="tanggal_mulai" type="date"
                                        value="{{ old('tanggal_mulai') }}" value="{{ date('y-m-d') }}"
                                        id="html5-date-input" />
                                </div>
                                @error('tanggal_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal<b
                                    style="color: red"> *</b>
                                Selesai</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i
                                            class='bx bx-calendar'></i></span>
                                    <input class="form-control" name="tanggal_selesai" id="tanggal_selesai"
                                        type="date" value="{{ old('tanggal_selesai') }}" value="{{ date('y-m-d') }}"
                                        id="html5-date-input" />
                                </div>
                                @error('tanggal_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kode<b
                                    style="color: red"> *</b></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-lock-open-alt'></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="XX-XXXX" aria-label="John Doe" name="kode"
                                        value="{{ old('kode') }}" aria-describedby="basic-icon-default-fullname2" />
                                </div>
                                @error('kode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Cover<b
                                    style="color: red"> *</b></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class='bx bx-image'></i></span>
                                    <input class="form-control" value="{{ old('cover') }}" type="file"
                                        id="formFile" name="cover" required />
                                </div>
                                <small class="form-text text-muted">
                                    jpeg, png, jpg, gif, svg, webp.
                                </small>
                                @error('cover')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-message">Deskripsi<b
                                    style="color: red"> *</b></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> --}}
                                    <textarea id="exampleFormControlTextarea1" class="form-control konten" name="konten"
                                        aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ old('konten') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
