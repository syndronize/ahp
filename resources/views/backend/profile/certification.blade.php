<div class="profile-setting">
    <form>
        <ul class="profile-edit-list row">
            <li class="weight-500 col-md-12">
                <h4 class="text-blue h5 mb-20">Your Certifications</h4>
                <button type="button" onclick="certificationForm()" class="btn btn-outline-light mb-4"><i class="fas fa-plus" style="color: black"></i></button>
                <button type="button" onclick="saveCertification()" class="btn btn-primary mb-4">Save Changes</button>
                <div id="fieldCertification"></div>

                @foreach ($certifications as $val)
                    <div class="col-lg-12 input-container">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control mb-1" value="{{ $val->name }}" readonly disabled>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control mb-1" value="{{ $val->publisher }}" readonly disabled>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control mb-1" value="{{ $val->start_date }}" readonly disabled>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control mb-1" value="{{ $val->end_date }}" readonly disabled>
                            </div>
                            <div class="col-12 d-flex align-items-end">
                                <button class="btn btn-danger" type="button" onclick="deleteCertification({{ $val->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </li>
        </ul>
    </form>
</div>
