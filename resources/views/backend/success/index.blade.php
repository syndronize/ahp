@extends('backend/core')
@section('title','Reviewed Employee')
@section('style')

@endsection    

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Reviewed Employee</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="route{{route('reviewed')}}">Reviewed Employee</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Index
                        </li>
                    </ol>
                </nav>
            </div>
            
            
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pb-20" id="listReviewed" style="margin : 20px;">
            
        </div>
    </div>
</div>

@endsection
@section('modal')
<div class="modal fade bs-example-modal-lg" id="stepOverview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Score Detailed</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="overviewList"></div>
                
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
    $( document ).ready(function() {
        listReviewed();
    });

    function listReviewed(){
        $('#listReviewed').load("{{route('reviewed.table')}}");
    }

    function email(email) {
        event.preventDefault();
        var subject = `Human Resource's Interview at PT. Curug Lintas Indonesia`
        var message = `Congrate !!!`
        $.ajax({
            url: '/email-sent', // URL of the Laravel route
            type: 'POST',
            data: {
                to : email,
                subject : subject,
                message : message
            },
            success: function(response) {
                alert(response.success);
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }

    function stepOverview(id) {
        $.ajax({
            url: "{{ route('reviewed.overview') }}",
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(res) {
                console.log(res.data);
                const overviewList = document.getElementById('overviewList');
                overviewList.innerHTML = '';


                    
                let score1 = 0.52 * res.data.overview.pengalaman
                let score2 = 0.18275 * res.data.overview.certification
                let score3 = 0.20075 * res.data.overview.hardskill
                let score4 = 0.0965 * res.data.overview.pendidikan
                let score5 = score1 + score2 + score3 + score4 
                    var overviewHtml = `
                        <h5>1. Evalution Score</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Certification</th>
                                    <th scope="col">Hardskill</th>
                                    <th scope="col">Education</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <td >${res.data.overview.pengalaman}</td>
                                    <td >${res.data.overview.certification}</td>
                                    <td >${res.data.overview.hardskill}</td>
                                    <td >${res.data.overview.pendidikan}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>2. Criteria Weight </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Certification</th>
                                    <th scope="col">Hardskill</th>
                                    <th scope="col">Education</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <td >0.52</td>
                                    <td >0.18275</td>
                                    <td >0.20075</td>
                                    <td >0.0965</td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>3. Score </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Certification</th>
                                    <th scope="col">Hardskill</th>
                                    <th scope="col">Education</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <td >0.52 * ${res.data.overview.pengalaman}</td>
                                    <td >0.18275 * ${res.data.overview.certification}</td>
                                    <td >0.20075 * ${res.data.overview.hardskill} </td>
                                    <td >0.0965 * ${res.data.overview.pendidikan} </td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>4. Score Result </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Certification</th>
                                    <th scope="col">Hardskill</th>
                                    <th scope="col">Education</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <td > ${score1} </td>
                                    <td > ${score2} </td>
                                    <td > ${score3} </td>
                                    <td > ${score4} </td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>5. Final Score </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Result</th>
                                    <th scope="col">Final Result</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr class="text-center">
                                    <td > ${score5} </td>
                                    <td > ${res.data.overview.score} </td>
                                </tr>
                            </tbody>
                        </table>
                    `;
                    $('#overviewList').append(overviewHtml);
                $('#stepOverview').modal('show');

            },
            error: function(res) {
                
            }
        });
    }

</script>
@endsection