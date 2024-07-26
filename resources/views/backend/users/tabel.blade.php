@include('components.datatable.datatable')
<table class="data-table table stripe hover nowrap" style="text-align: center">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Birthday</th>
            <th>Certification</th>
            <th>Experience</th>
            <th>Education</th>
            <th>Hardskill</th>
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
                <td><button type="button" class="btn btn-light" onclick="seeCertification({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeExperience({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeEducation({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                <td><button type="button" class="btn btn-light" onclick="seeHardskill({{$val->employee_id}})" ><i class="fas fa-eye"></i></button></td>
                
            </tr>
        @endforeach
    </tbody>
</table>

