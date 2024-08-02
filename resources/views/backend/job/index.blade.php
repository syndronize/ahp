@extends('backend/core')
@section('title','Job Portal')
@section('style')

@endsection    

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Job Portal</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="route{{route('jobs.index')}}">Jobs</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Index
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ol>
                    <li>
                        <!--
                        <button class="btn btn-light" onclick="refresh()" style="visibility: hidden"><i class="fas fa-redo-alt"></i></button>
                        -->
                        @if (Session()->get('priv') != 'user')
                        <button class="btn btn-primary" onclick="tambah()"><i class="fas fa-plus-square"></i></button>
                        @endif
                    </li>
                </ol>
            </div>
            
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pb-20" id="listJobs" style="margin : 20px;">
            
        </div>
    </div>
</div>

@endsection
@section('modal')
<div class="modal fade" id="addJobsModal" tabindex="-1" aria-labelledby="addJobsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="addJobsModalLabel">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jobname">Job Name</label>
                    <input type="text" class="form-control" id="jobname" name="jobname" placeholder="Job Name" required>
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" class="form-control" id="level" name="level" placeholder="Job Level" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description"class="form-control" placeholder="Description of the jobs"  id="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="requirement">Spesification</label>
                    <textarea name="requirement"  class="form-control" placeholder="Spesification Needed for the jobs" id="requirement"></textarea>
                </div>
                
                <button type="button"  onclick="saveJobs()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="seeJobsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Job Description</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="jobsId">
                <p style="font-weight:bold;" id="seeJobs"></p>
                <span style="font-weight:bold; margin-botoom:30px" id="seeLevel"></span>
                <span style="font-weight:bold;"></span>
                <p id="seeDescription">
                   
                </p>
                <span style="font-weight:bold;">Requirement</span>
                <p id="seeRequirement">

                </p>
            </div>
            <div class="modal-footer" id="footerDetail">
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    $( document ).ready(function() {
        listJobs();
    });

    function listJobs(){
        $('#listJobs').load("{{route('jobs.list')}}");
    }

    /** Add Section */
    function tambah(){
        $('#addJobsModal').modal('show');
    }  
    
    function saveJobs(){
        var jobname = $('#jobname').val()
        var description = $('#description').val()
        var requirement = $('#requirement').val()
        var level = $('#level').val()

        let formData = new FormData();
        formData.append('jobname', jobname);
        formData.append('description', description);
        formData.append('requirement', requirement);
        formData.append('level', level);

        $.ajax({
            url: "{{ route('jobs.add') }}",
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
                $('#addJobsModal').modal('hide');

                setTimeout(() => { 
                    listJobs()
                        $('#jobname').val('');
                        $('#description').val('');
                        $('#requirement').val('');
                        $('#level').val('');
                 }, 1500);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#addJobsModal').modal('hide');
                setTimeout(() => { 
                    listJobs()
                 }, 1500);
            }
        });

    }

    function deleteJobs(id) {
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
                    url: "{{ route('jobs.delete') }}",
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
                            listJobs(),
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
                        setTimeout(listJobs(), 1500);
                    }
                });
            }
        });
    }

    function seeJobs(id) {
        $.ajax({
            url: "{{ route('jobs.see') }}",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                $('#jobsId').val(res.data.jobs.id);
                $('#seeJobs').text(res.data.jobs.nama); 
                $('#seeLevel').text(res.data.jobs.level); 
                $('#seeDescription').text(res.data.jobs.deskripsi); 
                $('#seeRequirement').text(res.data.jobs.requirement);
                console.log(res);

                const array = res.data.apppliedJob;
                const id  = res.data.jobs.id;
                let value = ``;
                
                console.log;
                if (Array.isArray(array) && array.includes(id)) {
                    value = `
                        <button type="button" class="btn btn-light" disabled>You've been applied for this Jobs</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    `
                }else{
                    value = `
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="applyJobs()">Apply for this Jobs</button>
                    `
                }
                
                
                var footer = $('#footerDetail').html(value) 
                $('#seeJobsModal').modal('show');
            },
            error: function(res) {
                
            }
        });
    }

    function applyJobs() {
        var id = $('#jobsId').val();
        $.ajax({
            url: "{{ route('jobs.apply') }}",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                if (res.message == 'success') {
                    Swal.fire({
                        title: "Thanks for Apply!",
                        text: res.text,
                        icon: "success"
                    });
                }
                $('#seeJobsModal').modal('hide');
                setTimeout(
                    listJobs(),
                5000);
            },
            error: function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#seeJobsModal').modal('hide');
                setTimeout(listJobs(), 1500);
            }
        });
    }

</script>
@endsection