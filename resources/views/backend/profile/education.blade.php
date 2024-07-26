<div class="profile-setting">
    <form>
        <ul class="profile-edit-list row">
            <li class="weight-500 col-md-12">
                <h4 class="text-blue h5 mb-20">Your Education </h4>
                <button type="button" onclick="educationForm()" class="btn btn-outline-light mb-4"><i class="fas fa-plus" style="color: black"></i></button>
                <button type="button" onclick="saveEducation()" class="btn btn-primary mb-4">Save Changes</button>
                <div id="fieldEducation"></div>

                    @foreach ($education as $val)
                    
                    <div class="col-lg-12 input-container" >
                        <div class="row mb-2"><div class="col-6">
                            <input type="text" class="form-control mb-1" value="{{$val->instansi}}" readonly disabled>
                        </div>
                        <div class="col-3"><input type="date" class="form-control mb-1"value="{{$val->start_date}}" readonly disabled>
                        </div>
                        <div class="col-3"><input type="date" class="form-control mb-1" value="{{$val->end_date}}" readonly disabled>
                        </div>
                        <div class="col-6"><input type="text" class="form-control mb-1" value="{{$val->major}}" readonly disabled>
                        </div>
                        <div class="col-3"><input type="number" step="0.01" class="form-control mb-1" value="{{$val->gpa}}" readonly disabled>
                        </div>
                        <div class="col-3 d-flex align-items-end">
                            <button class="btn btn-danger" type="button" onclick="deleteEducation({{$val->id}})">
                            <i class="fas fa-trash">
                            </i>
                        </button>
                        </div>
                    </div>
                    </div>
                    @endforeach
            </div>
            </li>
            
        </ul>
    </form>
</div>