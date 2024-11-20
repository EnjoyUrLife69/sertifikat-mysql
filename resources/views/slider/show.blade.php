<div class="modal fade" id="Show{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditTitle">
                    Show
                    Data Image Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('slider.show', $data->id) }}" method="post" role="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Judul</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-user'></i></span>
                                <input style="font-weight: bold; padding-left: 15px;" type="text" id="nameWithTitle"
                                    required class="form-control" name="name" disabled value="{{ $data->judul }}" />
                            </div>
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Deskripsi</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class='bx bx-user'></i></span>
                                <textarea disabled style="font-weight: bold; padding-left: 15px; height: 8rem" type="text"
                                    id="nameWithTitle" required class="form-control" name="deskripsi"
                                    value="{{ $data->deskripsi }}" >{{ $data->deskripsi }}</textarea>
                            </div>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label class="form-label">COVER IMAGE
                                <hr style="height: 3px; width: 31%; ">
                            </label>
                            @csrf
                            <center><img class="card" src="{{ asset('storage/' . $data->image) }}" width="350">
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>