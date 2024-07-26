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
            <th>Action</th>
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
                <td>
                    {{-- <td><button class="btn btn-success" onclick="emailSent('{{$value->email}}')"></button></td> --}}
                    <a href="mailto:{{$value->email}}?subject=Human%20Resources%20Interview%20at%20PT.%20Curug%20Lintas%20Indonesia&body=Dear%20Interviewer%2C%0ATerkait%20dengan%20proses%20lamaran%20Anda%20di%20PT.Curug%20Lintas%20Indonesia%2C%20kami%20mengundang%20Anda%20untuk%20mengikuti%20Online%20Interview%20pada.%0A%0AHari%20%2F%20Tanggal%20%3A%20%0ALink%20%3A%20%0A%0ADemikian%20informasi%20yang%20dapat%20kami%20sampaikan%0A%0ARegards%2C%0A%0AHuman%20Resources%20Department%0A%0A" class="btn btn-success">Sent</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>