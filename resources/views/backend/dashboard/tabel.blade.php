@include('components.datatable.datatable')
<div class="h5 pd-20 mb-0">
    <span>Employee</span>
<!--
    <ol>
        <li style="margin-left: auto;display: flex; align-items: center; justify-content: space-between;">
            <select class="custom-select2 form-control" style="width:265px" id="selectReview" onchange="changeReview()">
                <option value="NULL" selected disabled>Select Option</option>
                <option value="needreview">Need Review</option>
                <option value="donereview">Have Reviewed</option>
            </select>
        </li>
    </ol>
-->
</div>
<table class="data-table table nowrap">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Human Resource</th>
            <th>Job Name</th>
            <th>Job Level</th>
            <th>Final Score</th>
            <th>HR Approval</th>
            <th>HR Manager Acknowledge</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($interviewer as $value)
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
                <td>{{$value->score}}</td>
                <td>
                        @if ($value->result == '2' && Session()->get('priv') == 'HR')
                        <div class="text-center">
                            <button class="btn btn-success" onclick="updateResult('1','{{$value->id_result}}')"><i class="fas fa-check"></i></button>
                            <button class="btn btn-danger" onclick="updateResult('0','{{$value->id_result}}')"><i class="fas fa-times"></i></button>
                        </div>
                        @endif
                        @if($value->result == '1')
                        <div>Approve by HR</div>
                        @endif
                        @if($value->result == '0')
                        <div>Failed</div>
                        @endif
                        @if($value->result == '2' && Session()->get('priv') != 'HR' )
                        <div >Hasn't Approve yet</div>
                        @endif
                </td>
                <td>
                    @if (Session()->get('priv') == 'admin' && $value->result == '1')
                        <div class="text-center">
                            <button class="btn btn-success" onclick="updateResultManager('1','{{$value->id_result}}')"><i class="fas fa-check"></i></button>
                            <button class="btn btn-danger" onclick="updateResultManager('0','{{$value->id_result}}')"><i class="fas fa-times"></i></button>
                        </div>
                    @endif
                    @if($value->result == '1' && Session()->get('priv') == 'HR')
                        <div>Need Manager Acknowledge</div>
                    @endif
                    @if ($value->result == '2' && $value->result_manager == NULL)
                        <div>Waiting Action from HR</div>
                    @endif
                    
                    @if($value->result_manager == '1')
                        Approve by HR Manager 
                    @endif
                    @if($value->result_manager == '0')
                        Doesn't Approve by HR Manager  
                    @endif
                    @if($value->result == '2' && Session()->get('priv') == 'admin')
                        <div>Need HR Approval First</div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>