<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class SuccessController extends Controller
{
    public function index(){
        return view('backend.success.index');
    }

    public function tabel(){
        
        $subQuery = DB::table('results as rs')
                    ->leftJoin('evaluations as ev', 'ev.id', '=', 'rs.evaluation_id')
                    ->select(
                        'ev.id as id_evaluation',
                        'rs.id as id_result',
                        'ev.employee_id',
                        'ev.hr_id',
                        'ev.certification',
                        'ev.pengalaman',
                        'ev.pendidikan',
                        'ev.hardskill',
                        'ev.job_id',
                        'rs.result',
                        'rs.result_manager',
                        'rs.updated_at',
                        'rs.score'
                    );
        $data['interviewer'] = DB::table(DB::raw("({$subQuery->toSql()}) as core"))
                            ->mergeBindings($subQuery)
                            ->leftJoin('users as u', 'u.id', '=', 'core.employee_id')
                            ->leftJoin('users as us', 'us.id', '=', 'core.hr_id')
                            ->leftJoin('jobs as j', 'j.id', '=', 'core.job_id')
                            ->select(
                                'core.id_evaluation',
                                'core.id_result',
                                'core.certification',
                                'core.pengalaman',
                                'core.pendidikan',
                                'core.hardskill',
                                'core.score',
                                'core.result',
                                'core.result_manager',
                                'core.updated_at',
                                'u.email as email',
                                'u.fullname as employee_name',
                                'us.fullname as hr_name',
                                'j.nama as job_name',
                                'j.level as job_level'
                            )
                            ->whereIn('result',['1','0'])
                            ->whereIn('result_manager',['1','0'])
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

    public function overview(Request $request){
        try {
            $id = $request->id;
            $data['overview'] = DB::table('evaluations as ev')
                                ->leftJoin('results as rs', 'ev.id', '=', 'rs.id')
                                ->where('evaluation_id', $id)
                                ->select('ev.certification', 'ev.pengalaman', 'ev.pendidikan', 'ev.hardskill', 'rs.score')
                                ->first();

            return response()->json([
                'message' => 'success',
                'text' => 'Data show successfully.',
                'data' => $data
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
