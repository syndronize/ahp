<div class="row clearfix">
    @if ($job->empty())
        <div class="col-12 mt-30 mb-30">
            <div class="alert alert-info text-center" role="alert">
                No jobs available at the moment. Please check back later.
            </div>
        </div>
    @endif
    @if (Session()->get('isfilled') == '0')
        <div class="col-12 mt-30 mb-30">
            <!--
            <div class="alert alert-info text-center" role="alert">
                No jobs available at the moment. Please check back later.
            </div>
            -->
            <div class="alert alert-warning text-center" role="alert">
                Please kindly complete your profile account <a href="{{route('profile.index')}}" style="color:#FF8225">here</a> ! 
            </div>
        </div>
    @else
        @foreach ($job as $val)
            <div class="col-lg-3 col-md-6 col-sm-12 mt-30 mb-30">
                <div class="da-card">
                    <div class="da-card-photo">
                        <img src="{{('/deskapp')}}/images/jobimage.jpg" alt="">
                        <div class="da-overlay">
                            <div class="da-social">
                                <ul class="clearfix">
                                    @if(Session()->get('priv') != 'user')
                                        <li><a href="#" type="button" onclick="deleteJobs({{$val->id}})"><i class="fas fa-trash"></i></a></li>
                                    @endif
                                        <li><a href="#" type="button" onclick="seeJobs({{$val->id}})"><i class="fas fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="da-card-content">
                        <h5 class="h5 mb-10">{{$val->nama}}</h5>
                        <p class="mb-0">{{$val->level}}</p>
                        <p class="mb-0">{{$val->created_at}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>