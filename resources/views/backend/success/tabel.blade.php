@include('components.datatable.datatable')

<div class="h5 pd-20 mb-0">
    <ol>
        <li style="margin-left: auto;display: flex; align-items: center; justify-content: space-between;">
            <span>Employee Has Reviewed</span>
            
        </li>
    </ol>
</div>

<table class="data-table table nowrap">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Human Resource</th>
            <th>Job Name</th>
            <th>Job Level</th>
            <th>Final Score</th>
            <th>Status</th>
            <th>Acknowledge</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>
    <tbody>
        @php
            use Carbon\Carbon;
        @endphp

        @foreach ($interviewer as $value)
            @php
                $date = Carbon::parse($value->updated_at);
                $formattedDate = $date->formatLocalized('%A, %d %B %Y');
            @endphp
            <tr>
                <td class="table-plus">
                    <div class="name-avatar d-flex align-items-center">
                        
                        <div class="txt">
                            <div class="weight-600">{{$value->employee_name}}</div>
                        </div>
                    </div>
                </td>
                <td>{{$value->hr_name}}</td>
                <td>{{$value->job_name}}</td>
                <td>{{$value->job_level}}</td>
                <td><a href="#" type="button" onclick="stepOverview({{$value->id_evaluation}})">{{$value->score}} </a></td>
                <td>
                    @if($value->result == '1' && $value->result_manager == '1')
                    Ready to Interview
                    @else
                    Failed
                    @endif
                </td>
                <td>
                    @if($value->result_manager == '1')
                        Approve by HR Manager on {{ ucfirst($formattedDate) }}
                    @endif
                    @if($value->result_manager == '0')
                        Doesn't Approve by HR Manager  on {{ ucfirst($formattedDate) }}
                    @endif
                    @if ($value->result == '0' && $value->result_manager == '2')
                        Doesn't Approve by HR
                    @endif
                </td>
                
            </tr>
        @endforeach 
    </tbody>
</table> 