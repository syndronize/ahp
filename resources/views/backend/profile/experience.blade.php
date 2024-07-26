<div class="profile-setting">
    <form>
        <ul class="profile-edit-list row">
            <li class="weight-500 col-md-12">
                <h4 class="text-blue h5 mb-20">Your Experience </h4>
                <button type="button" onclick="experienceForm()" class="btn btn-outline-light mb-4"><i class="fas fa-plus" style="color: black"></i></button>
                <button type="button" onclick="saveExperience()" class="btn btn-primary mb-4">Save Changes</button>
                <div id="fieldExperience"></div>
                @foreach ($experience as $val)
                    <div class="col-lg-12 input-container">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control mb-1" value="{{$val->nama}}" readonly>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control mb-1" value="{{$val->start_date}}" readonly>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control mb-1" value="{{$val->end_date}}" readonly>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control mb-1" readonly>{!!$val->job_description!!}</textarea>
                            </div>
                            <div class="col-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger" onclick="deleteExperience({{$val->id}})"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </li>
            
        </ul>
    </form>
</div>