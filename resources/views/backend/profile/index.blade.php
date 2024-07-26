@extends('backend/core')
@section('title','Profile Account')
@section('style')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endsection
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    {{-- <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a> --}}
                    <img src="{{'/deskapp'}}/vendors/images/photo1.jpg" alt="" class="avatar-photo">
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pd-5">
                                    <div class="img-container">
                                        <img id="image" src="{{'/deskapp'}}/vendors/images/photo2.jpg" alt="Picture">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="text-center h5 mb-0">{{$user->email}}</h5>
                <p class="text-center text-muted font-14">-</p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                    <ul>
                        <li>
                            <span>Email Address:</span>
                            {{$user->email}}
                        </li>
                        <li>
                            <span>Fullname:</span>
                            {{$user->fullname}}
                        </li>
                        <li>
                            @php
                            use Carbon\Carbon;
                            $birthday = Carbon::createFromFormat('Y-m-d', $user->birthday)->format('d F Y');
                            @endphp
                            <span>Birthday:</span>
                            {{$birthday}}
                        </li>
                        
                    </ul>
                </div>
                <!--
                <div class="profile-social">
                    <h5 class="mb-20 h5 text-blue">Social Links</h5>
                    <ul class="clearfix">
                        <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fas fa-facebook"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fas fa-twitter"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fas fa-linkedin"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fas fa-instagram"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fas fa-dribbble"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fas fa-dropbox"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fas fa-google-plus"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fas fa-pinterest-p"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fas fa-skype"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fas fa-vine"></i></a></li>
                    </ul>
                </div>
                <div class="profile-skills">
                    <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                    <h6 class="mb-5 font-14">HTML</h6>
                    <div class="progress mb-20" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h6 class="mb-5 font-14">Css</h6>
                    <div class="progress mb-20" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h6 class="mb-5 font-14">jQuery</h6>
                    <div class="progress mb-20" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h6 class="mb-5 font-14">Bootstrap</h6>
                    <div class="progress mb-20" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                -->
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#education-tab" role="tab">Education</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#experience-tab" role="tab">Experience</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#hardskill-tab" role="tab">Hardskill</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#certification-tab" role="tab">Certification</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade height-100-p"  role="tabpanel" id="education-tab">
                                
                            </div>
                            <div class="tab-pane fade height-100-p"  role="tabpanel" id="experience-tab">
                                
                            </div>
                            <div class="tab-pane fade height-100-p"  role="tabpanel" id="hardskill-tab">
                                
                            </div>
                            <div class="tab-pane fade height-100-p"  role="tabpanel" id="certification-tab">
                                
                            </div>
                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="privValue" value="<?= Session()->get('priv') ?>">
<input type="hidden" id="filledValue" value="<?= Session()->get('isfilled') ?>">
@endsection
@section('script')
<script>

    $(document).ready(function() {
        $('#education-tab').load("{{route('education.tab')}}");
        $('#experience-tab').load("{{route('experience.tab')}}");
        $('#certification-tab').load("{{route('certification.tab')}}");
        $('#hardskill-tab').load("{{route('hardskill.tab')}}");

        var priv = $('#privValue').val();
        var filled = $('#filledValue').val();

        if (priv == 'user' && filled == '0') {
            setTimeout(

                Swal.fire({
                    title: "Background Checking",
                    text: "Please complete your profile account first",
                    icon: "question"
                }),500
            )
        }

    })

    let counterEducation = 0;

    /** Education Field */
    function educationForm() {
        const fieldEducation = document.getElementById('fieldEducation');
        const inputContainer = document.createElement('div');
        inputContainer.className = 'col-lg-12 input-container';
        inputContainer.id = 'input-container-' + counterEducation;

        const rowDiv = document.createElement('div');
        rowDiv.className = 'row mb-2';

        // Institution field
        const colInstansiDiv = document.createElement('div');
        colInstansiDiv.className = 'col-6';

        const inputInstansi = document.createElement('input');
        inputInstansi.type = 'text';
        inputInstansi.className = 'form-control mb-1';
        inputInstansi.id = 'fieldInstansi' + counterEducation;
        inputInstansi.placeholder = 'Instansi';

        colInstansiDiv.appendChild(inputInstansi);

        // Start Date field
        const colStartDateDiv = document.createElement('div');
        colStartDateDiv.className = 'col-3';

        const inputStartDate = document.createElement('input');
        inputStartDate.type = 'date';
        inputStartDate.className = 'form-control mb-1';
        inputStartDate.id = 'fieldStartDate' + counterEducation;
        inputStartDate.placeholder = 'Start Date';

        colStartDateDiv.appendChild(inputStartDate);

        // End Date field
        const colEndDateDiv = document.createElement('div');
        colEndDateDiv.className = 'col-3';

        const inputEndDate = document.createElement('input');
        inputEndDate.type = 'date';
        inputEndDate.className = 'form-control mb-1';
        inputEndDate.id = 'fieldEndDate' + counterEducation;
        inputEndDate.placeholder = 'End Date';

        colEndDateDiv.appendChild(inputEndDate);

        // Major field
        const colMajorDiv = document.createElement('div');
        colMajorDiv.className = 'col-6';

        const inputMajor = document.createElement('input');
        inputMajor.type = 'text';
        inputMajor.className = 'form-control mb-1';
        inputMajor.id = 'fieldMajor' + counterEducation;
        inputMajor.placeholder = 'Level - Major';

        colMajorDiv.appendChild(inputMajor);

        // GPA field
        const colGpaDiv = document.createElement('div');
        colGpaDiv.className = 'col-3';

        const inputGpa = document.createElement('input');
        inputGpa.type = 'number';
        inputGpa.step = '0.01';
        inputGpa.className = 'form-control mb-1';
        inputGpa.id = 'fieldGpa' + counterEducation;
        inputGpa.placeholder = 'GPA';

        colGpaDiv.appendChild(inputGpa);

        // Delete button
        const colDeleteDiv = document.createElement('div');
        colDeleteDiv.className = 'col-3 d-flex align-items-end';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger';
        deleteButton.type = 'button';
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.onclick = function() { removeFieldEducation(inputContainer.id); };

        colDeleteDiv.appendChild(deleteButton);

        // Append all fields to the row div
        rowDiv.appendChild(colInstansiDiv);
        rowDiv.appendChild(colStartDateDiv);
        rowDiv.appendChild(colEndDateDiv);
        rowDiv.appendChild(colMajorDiv);
        rowDiv.appendChild(colGpaDiv);
        rowDiv.appendChild(colDeleteDiv);

        inputContainer.appendChild(rowDiv);
        fieldEducation.appendChild(inputContainer);

        counterEducation++;
    }

    function removeFieldEducation(id) {
        const container = document.getElementById(id);
        container.remove();
    }

    function saveEducation() {
        event.preventDefault();
        const arrayEducation = [];
        const inputContainers = document.querySelectorAll('.input-container');
        inputContainers.forEach(container => {
            const instansiInput = container.querySelector('input[id^="fieldInstansi"]');
            const startDateInput = container.querySelector('input[id^="fieldStartDate"]');
            const endDateInput = container.querySelector('input[id^="fieldEndDate"]');
            const majorInput = container.querySelector('input[id^="fieldMajor"]');
            const gpaInput = container.querySelector('input[id^="fieldGpa"]');

            // Debugging logs
            console.log('instansiInput:', instansiInput);
            console.log('startDateInput:', startDateInput);
            console.log('endDateInput:', endDateInput);
            console.log('majorInput:', majorInput);
            console.log('gpaInput:', gpaInput);

            if (instansiInput && startDateInput && endDateInput && majorInput && gpaInput) {
                const educationEntry = {
                    instansi: instansiInput.value,
                    startDate: startDateInput.value,
                    endDate: endDateInput.value,
                    major: majorInput.value,
                    gpa: gpaInput.value
                };
                arrayEducation.push(educationEntry);
            } else {
                console.error('One or more input fields are missing in container:', container);
            }
        });

        let formData = new FormData();
        formData.append('arrayEducation', JSON.stringify(arrayEducation));

        //console.log(arrayEducation);

        $.ajax({
            url  : "{{ route('education.form') }}",
            type : "POST",
            dataType : "JSON",
            data : formData,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#education-tab').load("{{ route('education.tab') }}"); }, 1500);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#education-tab').load("{{ route('education.tab') }}"); }, 1500);
            }
        });
    }


    function deleteEducation(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{route('education.delete')}}",
                    type : "DELETE",
                    dataType : "JSON",
                    data: {
                        id : id
                    },success : function(res) {
                        if (res.message == 'success') {
                            Swal.fire({
                            title: "Deleted!",
                            text: res.text,
                            icon: "success"
                            });
                        }
                        setTimeout(
                            $('#education-tab').load("{{route('education.tab')}}")
                        , 5000)

                    },error: function(res) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.text,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout($('#education-tab').load("{{route('education.tab')}}") , 1500)
                    }
                })
            }
        });
    }

    /** Experience Field */
    let counterExperience = 0;
    
    function experienceForm() {
        const fieldExperience = document.getElementById('fieldExperience');
        const inputContainer = document.createElement('div');
        inputContainer.className = 'col-lg-12 input-container';
        inputContainer.id = 'input-container-' + counterExperience;

        const rowDiv = document.createElement('div');
        rowDiv.className = 'row mb-2';

        // Experience Name field
        const colExperienceNameDiv = document.createElement('div');
        colExperienceNameDiv.className = 'col-6';

        const inputExperienceName = document.createElement('input');
        inputExperienceName.type = 'text';
        inputExperienceName.className = 'form-control mb-1';
        inputExperienceName.id = 'fieldExperienceName' + counterExperience;
        inputExperienceName.placeholder = 'Job Function - Job Place';

        colExperienceNameDiv.appendChild(inputExperienceName);

        // Start Date field
        const colStartDateDiv = document.createElement('div');
        colStartDateDiv.className = 'col-3';

        const inputStartDate = document.createElement('input');
        inputStartDate.type = 'date';
        inputStartDate.className = 'form-control mb-1';
        inputStartDate.id = 'fieldExperienceStartDate' + counterExperience;
        inputStartDate.placeholder = 'Start Date';

        colStartDateDiv.appendChild(inputStartDate);

        // End Date field
        const colEndDateDiv = document.createElement('div');
        colEndDateDiv.className = 'col-3';

        const inputEndDate = document.createElement('input');
        inputEndDate.type = 'date';
        inputEndDate.className = 'form-control mb-1';
        inputEndDate.id = 'fieldExperienceEndDate' + counterExperience;
        inputEndDate.placeholder = 'End Date';

        colEndDateDiv.appendChild(inputEndDate);

        // Job Description field using CKEditor
        const colJobDescriptionDiv = document.createElement('div');
        colJobDescriptionDiv.className = 'col-12';

        const inputJobDescription = document.createElement('textarea');
        inputJobDescription.className = 'form-control mb-1';
        inputJobDescription.id = 'fieldJobDescription' + counterExperience;
        inputJobDescription.placeholder = 'Job Description';

        colJobDescriptionDiv.appendChild(inputJobDescription);

        // Delete button
        const colDeleteDiv = document.createElement('div');
        colDeleteDiv.className = 'col-3 d-flex align-items-end';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger';
        deleteButton.type = 'button';
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.onclick = function() { removeFieldExperience(inputContainer.id); };

        colDeleteDiv.appendChild(deleteButton);

        // Append all fields to the row div
        rowDiv.appendChild(colExperienceNameDiv);
        rowDiv.appendChild(colStartDateDiv);
        rowDiv.appendChild(colEndDateDiv);
        rowDiv.appendChild(colJobDescriptionDiv);
        rowDiv.appendChild(colDeleteDiv);

        inputContainer.appendChild(rowDiv);
        fieldExperience.appendChild(inputContainer);

        // Initialize CKEditor on the textarea after it is added to the DOM
        // setTimeout(function() {
        //     CKEDITOR.replace('fieldJobDescription' + counterExperience);
        // }, 0);

        counterExperience++;
    }

    function removeFieldExperience(id) {
        const container = document.getElementById(id);
        container.remove();
    }
    
    function saveExperience() {
        event.preventDefault();
        const arrayExperience = [];
        const inputContainers = document.querySelectorAll('.input-container');
        inputContainers.forEach(container => {
            const experienceNameInput = container.querySelector('input[id^="fieldExperienceName"]');
            const startDateInput = container.querySelector('input[id^="fieldExperienceStartDate"]');
            const endDateInput = container.querySelector('input[id^="fieldExperienceEndDate"]');
            const jobDescriptionInput = container.querySelector('textarea[id^="fieldJobDescription"]');
            
            if (experienceNameInput && startDateInput && endDateInput && jobDescriptionInput) {
                const experienceEntry = {
                    experienceName: experienceNameInput.value,
                    startDate: startDateInput.value,
                    endDate: endDateInput.value,
                    jobDescription: jobDescriptionInput.value
                };
                arrayExperience.push(experienceEntry);
            } else {
                console.error('One or more input fields are missing in container:', container);
            }
        
        });

        let formData = new FormData();
        formData.append('arrayExperience', JSON.stringify(arrayExperience));

        $.ajax({
            url  : "{{ route('experience.form') }}",
            type : "POST",
            dataType : "JSON",
            data : formData,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#experience-tab').load("{{ route('experience.tab') }}"); }, 1500);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#experience-tab').load("{{ route('experience.tab') }}"); }, 1500);
            }
        });
    }

    function deleteExperience(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{ route('experience.delete') }}",
                    type : "DELETE",
                    dataType : "JSON",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.message == 'success') {
                            Swal.fire({
                                title: "Deleted!",
                                text: res.text,
                                icon: "success"
                            });
                            setTimeout(() => {
                                $('#experience-tab').load("{{ route('experience.tab') }}");
                            }, 1500);
                        }
                    },
                    error: function(res) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: res.text,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            $('#experience-tab').load("{{ route('experience.tab') }}");
                        }, 1500);
                    }
                });
            }
        });
    }


    /** Hardskill Field */

    let counterSkill = 0;

    function addSkillForm() {
        const fieldHardSkills = document.getElementById('fieldHardSkills');
        const inputContainer = document.createElement('div');
        inputContainer.className = 'col-lg-12 input-container';
        inputContainer.id = 'input-container-' + counterSkill;

        const rowDiv = document.createElement('div');
        rowDiv.className = 'row mb-2';

        // Skill Name field
        const colSkillNameDiv = document.createElement('div');
        colSkillNameDiv.className = 'col-6';
        const inputSkillName = document.createElement('input');
        inputSkillName.type = 'text';
        inputSkillName.className = 'form-control mb-1';
        inputSkillName.name = 'skill[' + counterSkill + '][name]';
        inputSkillName.placeholder = 'Skill Name';
        colSkillNameDiv.appendChild(inputSkillName);

        // Skill Range field
        const colSkillRangeDiv = document.createElement('div');
        colSkillRangeDiv.className = 'col-4';
        const inputSkillRange = document.createElement('input');
        inputSkillRange.type = 'number';
        inputSkillRange.className = 'form-control mb-1';
        inputSkillRange.name = 'skill[' + counterSkill + '][range]';
        inputSkillRange.min = 1;
        inputSkillRange.max = 10;
        inputSkillRange.placeholder = 'Skill Range (1-10)';
        colSkillRangeDiv.appendChild(inputSkillRange);

        // Delete button
        const colDeleteDiv = document.createElement('div');
        colDeleteDiv.className = 'col-2 d-flex align-items-end';
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger';
        deleteButton.type = 'button';
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.onclick = function() { removeFieldSkill('input-container-' + counterSkill); };
        colDeleteDiv.appendChild(deleteButton);

        // Append all fields to the row div
        rowDiv.appendChild(colSkillNameDiv);
        rowDiv.appendChild(colSkillRangeDiv);
        rowDiv.appendChild(colDeleteDiv);
        inputContainer.appendChild(rowDiv);
        fieldHardSkills.appendChild(inputContainer);

        counterSkill++;
    }

    function removeFieldSkill(id) {
        const container = document.getElementById(id);
        container.remove();
    }

    function saveSkills() {
        const arraySkills = [];
        const inputContainers = document.querySelectorAll('.input-container');
        inputContainers.forEach(container => {
            const nameInput = container.querySelector('input[name^="skill"][name$="[name]"]');
            const rangeInput = container.querySelector('input[name^="skill"][name$="[range]"]');

            if (nameInput && rangeInput) {
                const rangeValue = parseInt(rangeInput.value, 10);
                if (rangeValue >= 1 && rangeValue <= 10) {
                    const skillEntry = {
                        name: nameInput.value,
                        range: rangeValue
                    };
                    arraySkills.push(skillEntry);
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Skill range only 1 until 10",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
            } else {
                console.error('One or more input fields are missing in container:', container);
            }
        });

        $.ajax({
            url: "{{ route('hardskill.form') }}",
            type: "POST",
            data: {
                skills: arraySkills
            },
            success: function(response) {
                if (response.message === 'success') {
                    Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.text,
                    showConfirmButton: false,
                    timer: 1500
                    });
                    setTimeout(() => { $('#hardskill-tab').load("{{ route('hardskill.tab') }}"); }, 1500);
                } else {
                    Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: response.text,
                    showConfirmButton: false,
                    timer: 1500
                    });
                    setTimeout(() => { $('#hardskill-tab').load("{{ route('hardskill.tab') }}"); }, 1500);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Please fill the blank field",
                            showConfirmButton: false,
                            timer: 1500
                            });
                        }
                    }
                } else {
                    if (errors.hasOwnProperty(key)) {
                            Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'Error saving skills:', error,
                            showConfirmButton: false,
                            timer: 1500
                            });
                        }
                }
            }
        });
    }

    function deleteHardskill(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{ route('hardskill.delete') }}",
                    type : "DELETE",
                    dataType : "JSON",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.message == 'success') {
                            Swal.fire({
                                title: "Deleted!",
                                text: res.text,
                                icon: "success"
                            });
                            setTimeout(() => {
                                $('#hardskill-tab').load("{{ route('hardskill.tab') }}");
                            }, 1500);
                        }
                    },
                    error: function(res) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: res.text,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            $('#hardskill-tab').load("{{ route('hardskill.tab') }}");
                        }, 1500);
                    }
                });
            }
        });
    }

    /** Certification Field */
    let counterCertification = 0;

    function certificationForm() {
        const fieldCertification = document.getElementById('fieldCertification');
        const inputContainer = document.createElement('div');
        inputContainer.className = 'col-lg-12 input-container';
        inputContainer.id = 'input-container-' + counterCertification;

        const rowDiv = document.createElement('div');
        rowDiv.className = 'row mb-2';

        // Certification Name field
        const colNameDiv = document.createElement('div');
        colNameDiv.className = 'col-6';

        const inputName = document.createElement('input');
        inputName.type = 'text';
        inputName.className = 'form-control mb-1';
        inputName.id = 'fieldCertificationName' + counterCertification;
        inputName.placeholder = 'Certification Name';

        colNameDiv.appendChild(inputName);

        // Publisher field
        const colPublisherDiv = document.createElement('div');
        colPublisherDiv.className = 'col-6';

        const inputPublisher = document.createElement('input');
        inputPublisher.type = 'text';
        inputPublisher.className = 'form-control mb-1';
        inputPublisher.id = 'fieldPublisher' + counterCertification;
        inputPublisher.placeholder = 'Publisher';

        colPublisherDiv.appendChild(inputPublisher);

        // Start Date field
        const colStartDateDiv = document.createElement('div');
        colStartDateDiv.className = 'col-6';

        const inputStartDate = document.createElement('input');
        inputStartDate.type = 'date';
        inputStartDate.className = 'form-control mb-1';
        inputStartDate.id = 'fieldCertificationStartDate' + counterCertification;
        inputStartDate.placeholder = 'Start Date';

        colStartDateDiv.appendChild(inputStartDate);

        // End Date field
        const colEndDateDiv = document.createElement('div');
        colEndDateDiv.className = 'col-6';

        const inputEndDate = document.createElement('input');
        inputEndDate.type = 'date';
        inputEndDate.className = 'form-control mb-1';
        inputEndDate.id = 'fieldCertificationEndDate' + counterCertification;
        inputEndDate.placeholder = 'End Date';

        colEndDateDiv.appendChild(inputEndDate);

        // Delete button
        const colDeleteDiv = document.createElement('div');
        colDeleteDiv.className = 'col-12 d-flex align-items-end';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger';
        deleteButton.type = 'button';
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.onclick = function() { removeFieldCertification(inputContainer.id); };

        colDeleteDiv.appendChild(deleteButton);

        // Append all fields to the row div
        rowDiv.appendChild(colNameDiv);
        rowDiv.appendChild(colPublisherDiv);
        rowDiv.appendChild(colStartDateDiv);
        rowDiv.appendChild(colEndDateDiv);
        rowDiv.appendChild(colDeleteDiv);

        inputContainer.appendChild(rowDiv);
        fieldCertification.appendChild(inputContainer);

        counterCertification++;
    }

    function removeFieldCertification(id) {
        const container = document.getElementById(id);
        container.remove();
    }

    function saveCertification() {
        event.preventDefault();
        const arrayCertification = [];
        const inputContainers = document.querySelectorAll('.input-container');
        inputContainers.forEach(container => {
            const nameInput = container.querySelector('input[id^="fieldCertificationName"]');
            const publisherInput = container.querySelector('input[id^="fieldPublisher"]');
            const startDateInput = container.querySelector('input[id^="fieldCertificationStartDate"]');
            const endDateInput = container.querySelector('input[id^="fieldCertificationEndDate"]');

            if (nameInput && publisherInput && startDateInput && endDateInput) {
                const certificationEntry = {
                    name: nameInput.value,
                    publisher: publisherInput.value,
                    startDate: startDateInput.value,
                    endDate: endDateInput.value
                };
                arrayCertification.push(certificationEntry);
            } else {
                console.error('One or more input fields are missing in container:', container);
            }
        });

        let formData = new FormData();
        formData.append('arrayCertification', JSON.stringify(arrayCertification));

        $.ajax({
            url: "{{ route('certification.form') }}",
            type: "POST",
            dataType: "JSON",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#certification-tab').load("{{ route('certification.tab') }}"); }, 1500);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => { $('#certification-tab').load("{{ route('certification.tab') }}"); }, 1500);
            }
        });
    }

    function deleteCertification(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('certification.delete') }}",
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.message == 'success') {
                            Swal.fire({
                                title: "Deleted!",
                                text: res.text,
                                icon: "success"
                            });
                        }
                        setTimeout(
                            $('#certification-tab').load("{{ route('certification.tab') }}"),
                        5000);
                    },
                    error: function(res) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.text,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout($('#certification-tab').load("{{ route('certification.tab') }}"), 1500);
                    }
                });
            }
        });
    }


</script>
@endsection