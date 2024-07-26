<div class="profile-setting">
    <form>
        <ul class="profile-edit-list row">
            <li class="weight-500 col-md-12">
                <h4 class="text-blue h5 mb-20">Your Hardskill </h4>
                <button type="button" onclick="addSkillForm()" class="btn btn-outline-light mb-4"><i class="fas fa-plus" style="color: black"></i></button>
                <button type="button" onclick="saveSkills()" class="btn btn-primary mb-4">Save Changes</button>
                <div id="fieldHardSkills"></div>

                @foreach ($hardskill as $val)
                    <div class="col-lg-12 input-container" id="input-container-0">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control mb-1" value="{{$val->nama}}" readonly disabled>
                            </div>
                            <div class="col-4">
                                <input type="number" class="form-control mb-1" value="{{$val->range}}" readonly disabled>
                            </div>
                                <div class="col-2 d-flex align-items-end">
                                    <button class="btn btn-danger" type="button" onclick="deleteHardskill({{$val->id}})">
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