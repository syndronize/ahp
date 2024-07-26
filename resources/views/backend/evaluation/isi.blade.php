@include('components.datatable.datatable')
<table class="data-table table stripe hover nowrap" style="text-align: center">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Birthday</th>
            <th>Job Name</th>
            <th>Certification</th>
            <th>Experience</th>
            <th>Education</th>
            <th>Hardskill</th>
            <th class="datatable-nosort">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            use Carbon\Carbon;
        @endphp
        @foreach ($eval as $val)
            @php
                $birthday = Carbon::createFromFormat('Y-m-d', $val->birthday)->format('d F Y');
            @endphp
            <tr>

                <td>{{$val->fullname}}</td>
                <td>{{$birthday}}</td>
                <td>{{$val->jobname}}</td>
                <td><button type="button" class="btn btn-light" onclick="seeCertification({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeExperience({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeEducation({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeHardskill({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                
                @if ($val->hr_name != NULL)
                    <td>Has been evaluate by {{$val->hr_name}}</td>
                @else
                    @if (Session()->get('priv') != 'HR')
                        <td>HR Access</td>  
                    @else    
                        <td>
                            <button type="button" class="btn btn-light" onclick="openEvaluateModal({{ $val->evaluation_id }})">
                                <i class="fas fa-sticky-note"></i>
                            </button>
                        </td>
                    @endif
                @endif
                
            </tr>
        @endforeach
    </tbody>
</table>

