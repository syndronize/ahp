@extends('backend/core')
@section('title','Evaluation')
@section('style')
@endsection    

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Evaluation</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="route{{route('eval.index')}}">Evaluation</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Index
                        </li>
                    </ol>
                </nav>
            </div>
            <!--
            <div class="col-md-6 col-sm-12 text-right">
                <ol>
                    <li>
                        <button class="btn btn-light" onclick="autoRefresh()"><i class="fas fa-sync"></i></button>
                    </li>
                </ol>
            </div>
            -->
            
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-black h4">Data Users</h4>
        </div>
        <div class="pb-20" id="evalContent">
        
           
        </div>
    </div>
</div>

@endsection
@section('modal')

<!-- Certification List -->
<div class="modal fade bs-example-modal-lg" id="seeCertificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Certification List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="certificationList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Experience List -->
<div class="modal fade bs-example-modal-lg" id="seeExperienceModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Experience List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="experienceList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Education List -->
<div class="modal fade bs-example-modal-lg" id="seeEducationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Education List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="educationList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Hardskill List -->
<div class="modal fade bs-example-modal-lg" id="seeHardskillModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Hardskill List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="hardskillList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Evaluate Form -->
<div class="modal fade bs-example-modal-lg" id="evaluateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Evaluate Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="evaluateId">
                <div class="form-group">
                    <label>Certification Score</label>
                    <input class="form-control" type="number" placeholder="1 - 100" id="certificationScore">
                </div>
                <div class="form-group">
                    <label>Experience Score</label>
                    <input class="form-control" type="number" placeholder="1 - 100" id="experienceScore">
                </div>
                <div class="form-group">
                    <label>Education Score</label>
                    <input class="form-control" type="number" placeholder="1 - 100" id="educationScore">
                </div>
                <div class="form-group">
                    <label>Hardskill Score</label>
                    <input class="form-control" type="number" placeholder="1 - 100" id="hardskillScore">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-primary"  onclick="saveEvaluate()">Save</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $( document ).ready(function() {
        showEval();
    });

    function autoRefresh() {
        
    }
    function showEval() {
        $('#evalContent').load("{{route('eval.content')}}");
    }

    function seeCertification(id) {
        $.ajax({
            url: "{{ route('certification.content') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                $('#certificationList').innerHTML('');
                $.each(res.data.certifications, function(index, val) {
                    var certificationHtml = `
                        
                        <div class="col-lg-12 input-container">
                            <span style="font-weight:bold; margin-bottom:20px;"> ${index + 1 } . ${val.name}</span> 
                            <div class="row mb-2">
                                <div class="col-12">
                                    <span style="font-weight:bold;">Publisher </span><p class=" mb-1">${val.publisher}</p>
                                </div>
                                <div class="col-12">
                                    <span style="font-weight:bold;">Valid Date  </span><p class=" mb-1">${val.start_date} / ${val.end_date}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#certificationList').append(certificationHtml);
                });
                $('#seeCertificationModal').modal('show');
            },
            error: function(res) {
                
            }
        });
    }

    function seeExperience(id) {
        $.ajax({
            url: "{{ route('experience.content') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                console.log(res);
                $.each(res.data.experiences, function(index, val) {
                    var experienceHtml = `
                        
                        <div class="col-lg-12 input-container">
                            <span style="font-weight:bold; margin-bottom:20px;"> ${index + 1 } . ${val.nama}</span> 
                            <div class="row mb-2">
                                <div class="col-12">
                                    <span style="font-weight:bold;">Valid Date  </span><p class=" mb-1">${val.start_date} / ${val.end_date}</p>
                                </div>
                                <div class="col-12">
                                    <span style="font-weight:bold;">Job Descripiton  </span><p class=" mb-1">${val.job_description}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#experienceList').append(experienceHtml);
                });
                $('#seeExperienceModal').modal('show');
            },
            error: function(res) {
                console.log(`error : ${res}`);
            }
        });
    }

    function seeEducation(id) {
        $.ajax({
            url: "{{ route('education.content') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                console.log(res);
                $.each(res.data.educations, function(index, val) {
                    var formattedGPA = parseFloat(val.gpa).toFixed(2);
                    var educationHtml = `
                        
                        <div class="col-lg-12 input-container">
                            <span style="font-weight:bold; margin-bottom:20px;"> ${index + 1 } . ${val.instansi} - ${val.major}</span> 
                            <div class="row mb-2">
                                <div class="col-12">
                                    <span style="font-weight:bold;">Valid Date  </span><p class=" mb-1">${val.start_date} / ${val.end_date}</p>
                                </div>
                                <div class="col-12">
                                    <p class=" mb-1"><b>GPA</b> ${formattedGPA}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#educationList').append(educationHtml);
                });
                $('#seeEducationModal').modal('show');
            },
            error: function(res) {
                console.log(`error : ${res}`);
            }
        });
    }

    function seeHardskill(id) {
        $.ajax({
            url: "{{ route('hardskill.content') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                console.log(res);
                $.each(res.data.hardskills, function(index, val) {
                    var hardskillHtml = `
                        
                        <div class="col-lg-12 input-container">
                            <span  margin-bottom:20px;"> <b>${index + 1 } .</b> ${val.nama} | ${val.range} </span> 
                        </div>
                    `;
                    $('#hardskillList').append(hardskillHtml);
                });
                $('#seeHardskillModal').modal('show');
            },
            error: function(res) {
                console.log(`error : ${res}`);
            }
        });
    }

    function openEvaluateModal(id){
        $('#evaluateId').val(id);
        $('#evaluateModal').modal('show');
    }

    function saveEvaluate() {
        var evaluationId = $('#evaluateId').val();
        var certificationScore = $('#certificationScore').val();
        var experienceScore = $('#experienceScore').val();
        var educationScore = $('#educationScore').val();
        var hardskillScore = $('#hardskillScore').val();

        if (!evaluationId || !certificationScore || !experienceScore || !educationScore || !hardskillScore) {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Please fill all fields",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        const certificationScoreValue = parseInt(certificationScore, 10);
        const experienceScoreValue = parseInt(experienceScore, 10);
        const educationScoreValue = parseInt(educationScore, 10);
        const hardskillScoreValue = parseInt(hardskillScore, 10);

        if (certificationScoreValue < 1 || certificationScoreValue > 100 || 
            experienceScoreValue < 1 || experienceScoreValue > 100 || 
            educationScoreValue < 1 || educationScoreValue > 100 || 
            hardskillScoreValue < 1 || hardskillScoreValue > 100) {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Scores must be between 1 and 100",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        $.ajax({
            url: "{{ route('eval.evaluate') }}",
            type: "POST",
            dataType: "JSON",
            data: {
                id: evaluationId,
                certification: certificationScore,
                experience: experienceScore,
                education: educationScore,
                hardskill: hardskillScore
            },
            success: function(res) {
                if (res.message == 'success') {
                    Swal.fire({
                        title: "Form was updated!",
                        text: res.text,
                        icon: "success"
                    });
                }
                $('#evaluateModal').modal('hide');
                setTimeout(showEval, 5000);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#evaluateModal').modal('hide');
                setTimeout(showEval, 1500);
            }
        });
    }

</script>
@endsection