<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class SuccessController extends Controller
{
    public function index(){
        return view('backend.success.index');
    }

    public function tabel(){
        
        $subQuery = DB::table('results as rs')
                    ->leftJoin('evaluations as ev', 'ev.id', '=', 'rs.evaluation_id')
                    ->select(
                        'rs.id as id_result',
                        'ev.employee_id',
                        'ev.hr_id',
                        'ev.certification',
                        'ev.pengalaman',
                        'ev.pendidikan',
                        'ev.hardskill',
                        'ev.job_id',
                        'rs.result',
                        'rs.score'
                    );
        $data['interviewer'] = DB::table(DB::raw("({$subQuery->toSql()}) as core"))
                            ->mergeBindings($subQuery)
                            ->leftJoin('users as u', 'u.id', '=', 'core.employee_id')
                            ->leftJoin('users as us', 'us.id', '=', 'core.hr_id')
                            ->leftJoin('jobs as j', 'j.id', '=', 'core.job_id')
                            ->select(
                                'core.id_result',
                                'core.certification',
                                'core.pengalaman',
                                'core.pendidikan',
                                'core.hardskill',
                                'core.score',
                                'core.result',
                                'u.email as email',
                                'u.fullname as employee_name',
                                'us.fullname as hr_name',
                                'j.nama as job_name',
                                'j.level as job_level'
                            )
                            ->whereIn('result',['1','0'])
                            ->get();
       
        return view('backend.success.tabel',$data);
    }

    public function email(Request $request){
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $details = [
            'to' => $request->to,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to($details['to'])->send(new ContactMail($details));

        return response()->json(['success' => 'Email sent successfully!']);
    }
}
