<!-- Edit Modal -->
<div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditTitle">
                    Edit Data Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('slider.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="row">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Judul<b
                                    style="color: red">*</b>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-category'></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="Title" aria-label="John Doe" name="judul"
                                        value="{{ $data->judul }}" aria-describedby="basic-icon-default-fullname2"
                                        required />
                                </div>
                                @error('judul')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Deskripsi<b
                                    style="color: red">*</b>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class='bx bx-category'></i></span>
                                    <textarea style="height: 8rem;" type="textarea" class="form-control" id="basic-icon-default-fullname"
                                        aria-label="John Doe" name="deskripsi" value="{{ old('deskripsi') }}"
                                        aria-describedby="basic-icon-default-fullname2" required>{{ $data->deskripsi }}</textarea>
                                </div>
                                @error('deskripsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Image<b
                                    style="color: red"> *</b></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class='bx bx-image'></i></span>
                                    <input class="form-control" type="file" id="formFile" name="image" />
                                </div>
                                <small class="form-text text-muted">
                                    jpeg, png, jpg, gif, svg, webp.
                                </small><br><br>
                                @if ($data->image)
                                    <small class="form-text text-muted">
                                        Image sebelumnya: <a href="{{ asset('storage/' . $data->image) }}"
                                            target="_blank">{{ basename($data->image) }}</a>
                                    </small><br>
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
