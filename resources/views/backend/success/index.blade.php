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

</script>
@endsection