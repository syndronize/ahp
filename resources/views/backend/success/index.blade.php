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

    function emailSent(email){
        event.preventDefault(); // Prevent form submission
        const to = email;
        const subject = 'Human Resources Interview at PT. Curug Lintas Indonesia';
        const message = `Dear Interviewer,%0D%0A` +
                        `Terkait dengan proses lamaran Anda di PT.Curug Lintas Indonesia, kami mengundang Anda untuk mengikuti Online Interview pada.%0D%0A` +
                        `Hari / Tanggal :%0A` +
                        `Link :%0D%0A` +
                        `Demikian informasi yang dapat kami sampaikan%0D%0A` +
                        `Regards,%0D%0A` +
                        `Human Resources Department`;
        const mailtoLink = `mailto:${encodeURIComponent(to)}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(message)}`;
        window.location.href = mailtoLink;
    }

</script>
@endsection