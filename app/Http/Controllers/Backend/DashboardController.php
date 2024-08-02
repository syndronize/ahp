<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function index(){
        
        $data['countRegistrant'] = DB::table('users')
            ->where('priv', 'user')
            ->count();

        $data['countNeedReview'] = DB::table('evaluations')
            ->whereNull('hr_id')
            ->count();
        
        $data['isReadyInterview'] = DB::table('results')
            ->where('result','1')
            ->count();

        return view('backend.dashboard.index',$data);

    }

    public function tabel(Request $req){
        $values = $req->values;
        $priv = Session()->get('priv');
        $id = Session()->get('id');
        if ($priv == 'user') {
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
                            'rs.result_manager',
                            'rs.score'
                        )
                        ->where('ev.employee_id',$id);

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
                                    'core.result_manager',
                                    'u.fullname as employee_name',
                                    'us.fullname as hr_name',
                                    'j.nama as job_name',
                                    'j.level as job_level'
                                )
                                ->whereIn('result',['0','1'])
                                ->get();
        }
        else {
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
                            'rs.result_manager',
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
                                    'core.result_manager',
                                    'u.fullname as employee_name',
                                    'us.fullname as hr_name',
                                    'j.nama as job_name',
                                    'j.level as job_level'
                                )
                                ->whereIn('result',['2'])
                                ->orWhereIn('result_manager',['2'])
                                ->get();
        }
        
        return view('backend.dashboard.tabel',$data);
    }

    public function updateResult(Request $req){
        try {
            $id = $req->id;
            $result = $req->result;

            if ($result == '1') {

                DB::table('results')
                ->where('id', $id)
                ->update([
                    'result' => $result,
                    'result_manager' => '2',
                    'updated_at' => now()
                ]);
            }else{
                DB::table('results')
                ->where('id', $id)
                ->update([
                    'result' => $result,
                    'result_manager' => '0',
                    'updated_at' => now()
                ]);
            }
            return response()->json([
                'message' => 'success',
                'text' => 'Result Update successfully.'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateResultManager(Request $req){
        try {
            $id = $req->id;
            $result = $req->result;

            
            DB::table('results')
                ->where('id', $id)
                ->update([
                    'result_manager' => $result,
                    'updated_at' => now()
                ]);
            return response()->json([
                'message' => 'success',
                'text' => 'Result Update successfully.'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage(),
            ], 500);
        }
    }

}
