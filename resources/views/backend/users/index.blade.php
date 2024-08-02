@extends('backend/core')
@section('title','Users')
@section('style')
@endsection    

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Users</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="route{{route('users.index')}}">Users</a>
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
                        <button class="btn btn-light" onclick="refresh()"><i class="fas fa-redo-alt"></i></button>
                        <button class="btn btn-primary" onclick="tambah()"><i class="fas fa-plus-square"></i></button>
                    </li>
                </ol>
            </div>
        -->
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-black h4">Data Users</h4>
            <!--
            <p class="mb-0">
                you can find more options
                <a
                    class="text-primary"
                    href="https://datatables.net/"
                    target="_blank"
                    >Click Here</a
                >
            </p>
            -->
        </div>
        <div class="pb-20" id="tabelUsers">
        
           
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

@endsection
@section('script')
<script>
    function tabeluser(){
        $('#tabelUsers').load("{{route('users.table')}}");
    }
    
    $( document ).ready(function() {
        tabeluser();
    });

    function seeCertification(id) {
        const certificationList = document.getElementById('certificationList');
        certificationList.innerHTML = '';
        $.ajax({
            url: "{{ route('certification.content') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
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
        const experienceList = document.getElementById('experienceList');
        experienceList.innerHTML = '';
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
        const educationList = document.getElementById('educationList');
        educationList.innerHTML = '';
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
        const hardskillList = document.getElementById('hardskillList');
        hardskillList.innerHTML = '';
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

    // function tambah() {
    //     $('#tambahModal').modal('show');
    // }

    // let counterPengalaman = 0;
    // function tambahPengalaman() {
    //     const fieldPengalaman = document.getElementById('fieldPengalaman');
    //     const inputContainer = document.createElement('div');
    //     inputContainer.className = 'col-lg-12 input-container';
    //     inputContainer.id = 'input-container-' + counterPengalaman;

    //     const rowDiv = document.createElement('div');
    //     rowDiv.className = 'row';

    //     const col8Div = document.createElement('div');
    //     col8Div.className = 'col-10';

    //     const input = document.createElement('input');
    //     input.type = 'text';
    //     input.className = 'form-control mb-1';
    //     input.id = 'fieldSelectKantor' + counterPengalaman;
    //     input.placeholder = 'Pengalaman Kerja';

    //     const col4Div = document.createElement('div');
    //     col4Div.className = 'col-2';

    //     const deleteButton = document.createElement('button');
    //     deleteButton.className = 'btn btn-lg btn-danger';
    //     deleteButton.type = 'button';
    //     deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
    //     deleteButton.onclick = function() { removeFieldInputKantor(inputContainer.id); };

    //     col8Div.appendChild(input);
    //     col4Div.appendChild(deleteButton);
    //     rowDiv.appendChild(col8Div);
    //     rowDiv.appendChild(col4Div);
    //     inputContainer.appendChild(rowDiv);

    //     fieldPengalaman.appendChild(inputContainer);

    // }

    // function removeFieldInputKantor(id) {
    //     const container = document.getElementById(id);
    //     container.remove();
    // }

    // function simpan(){
    //     let fullname = $('#name').val();
    //     let username = $('#username').val();
    //     let email = $('#email').val();
    //     let password = $('#password').val();
    //     let priv = $('#priv').val();
    //     let almamater = $('#almamater').val();
    //     let ipk = $('#ipk').val();
    //     let cv = $('#cv')[0].files[0];
    //     event.preventDefault();
    //     const arrayPengalaman = [];
    //     const inputs = document.querySelectorAll('#fieldPengalaman input');
    //     inputs.forEach(input => {
    //         arrayPengalaman.push(input.value);
    //     });

    //     let formData = new FormData();
    //     formData.append('fullname', fullname);
    //     formData.append('username', username);
    //     formData.append('email', email);
    //     formData.append('password', password);
    //     formData.append('priv', priv);
    //     formData.append('almamater', almamater);
    //     formData.append('ipk', ipk);
    //     formData.append('cv', cv);
    //     formData.append('arrayPengalaman', JSON.stringify(arrayPengalaman));
    //     $.ajax({
    //         url  : "{{route('users.add')}}",
    //         type : "POST",
    //         dataType : "JSON",
    //         data : formData, 
    //         processData: false,  // Prevent jQuery from automatically transforming the data into a query string
    //         contentType: false,
    //         success: function(res) {
    //             console.log(res);
    //         }, error : function (res) {
    //             console.error('Error', res);
    //         }
    //     })
    // }

    // function pengalaman(pengalaman) {
    //     console.log(pengalaman);
    //     $('#pengalamanModal').modal('show');
    // }

    // function downloadCV(path) {
    //     console.log(path);
    //     const link = document.createElement('a');
    //     link.href = path;  // Set the href attribute to the file URL
    //     link.download = path.split('/').pop();  // Set the download attribute to suggest the filename
    //     document.body.appendChild(link);  // Append the link to the body
    //     link.click();  // Trigger a click event on the link to start the download
    //     document.body.removeChild(link);
    // }

    // function deleteItem(id) {
    //     console.log(`delete Item : ${id}`);
    // }

    // function edit(id) {
    //     console.log(`edited Item : ${id}`);
    // }

    
</script>
@endsection