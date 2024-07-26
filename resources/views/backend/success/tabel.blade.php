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
            <th>Result</th>
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
                @if ($value->result == '2')
                    <td>
                        <div class="text-center">
                            <button class="btn btn-success" onclick="updateResult('1','{{$value->id_result}}')"><i class="fas fa-check"></i></button>
                            <button class="btn btn-danger" onclick="updateResult('0','{{$value->id_result}}')"><i class="fas fa-times"></i></button>
                        </div>
                    </td>
                @endif
                @if($value->result == '1')
                    <td>Ready to Interview</td>
                @endif
                @if($value->result == '0')
                    <td>Failed</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>