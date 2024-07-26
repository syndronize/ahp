
@extends('backend/core')
@section('title','Dashboard')
@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">Employee Overview</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-4 col-lg-4 col-md-8 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{$countRegistrant}}</div>
                        <div class="font-14 text-secondary weight-500">
                            Registrant
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy fa fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-8 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{$countNeedReview}}</div>
                        <div class="font-14 text-secondary weight-500">
                            Need Review
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#F4A261">
                            <span class="icon-copy fa fa-check"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-8 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{$isReadyInterview}}</div>
                        <div class="font-14 text-secondary weight-500">
                            Ready to Interview
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#FFFFFF">
                            <span class="icon-copy fa fa-handshake-o"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    

    <div class="card-box pb-10" id="dataDashboard" ></div>

    <div class="title pb-20 pt-20" style="visibility: hidden">
        <h2 class="h3 mb-0">Quick Start</h2>
    </div>
    <!--
    <div class="row" style="visibility: hidden">
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                    <img src="{{('/')}}deskapp/vendors/images/medicine-bro.svg" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">Services</h3>
                    <p class="max-width-200">
                        We provide superior health care in a compassionate maner
                    </p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                    <img src="{{('/')}}deskapp/vendors/images/remedy-amico.svg" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">Medications</h3>
                    <p class="max-width-200">
                        Look for prescription and over-the-counter drug information.
                    </p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                    <img src="{{('/')}}deskapp/vendors/images/paper-map-cuate.svg" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">Locations</h3>
                    <p class="max-width-200">
                        Convenient locations when and where you need them.
                    </p>
                </div>
            </a>
        </div>
    </div>
    -->

@endsection
@section('script')
<script>
    function tabel() {
        $('#dataDashboard').load("{{ route('dashboard.table') }}", function(response, status, xhr) {
            if (status == "error") {
                console.log("Error loading table:", xhr.status, xhr.statusText);
            } else {
                console.log("Table loaded successfully.");
            }
        });
    }

    $(document).ready(function(){
        tabel();
    });
    
    function changeReview() {
        var param = $('#selectReview').val();
        $.ajax({
            url: "{{ route('dashboard.table') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                values: param,
            },
            success: function(res) {
                tabel()
            },
            error: function(res) {
                console.log(res);
            }
        });
    }

    $('#selectReview').change(function() {
        changeReview();
    });

    function updateResult(resultHasil,id) {
        
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('dashboard.update') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        id: id,
                        result: resultHasil,
                    },
                    success: function(res) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.text,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        tabel();

                    },
                    error: function(res) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Cannot Update Please Call your Admin!",
                        });
                        tabel();
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }
</script>
@endsection