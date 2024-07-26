<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function index(){
        return view('backend.job.index');
    }

    public function seeJobs(Request $req){
        try {
            $id = $req->id;
            $data['jobs'] = DB::table('jobs')
                            ->where('id',$id)
                            ->first();

            $sessionId = Session()->get('id');
            $data['apppliedJob'] = DB::table('evaluations')
                            ->where('employee_id', $sessionId) 
                            ->pluck('job_id') 
                            ->toArray();
            return response()->json([
                'message' => 'success',
                'text' => 'Data saved successfully.',
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

    public function list(){
        $sessionId = Session()->get('id');
        $sessionPriv = Session()->get('priv');
        
        if ($sessionPriv == 'user') {
            $apppliedJob = DB::table('evaluations')
                        ->where('employee_id', $sessionId) 
                        ->pluck('job_id') 
                        ->toArray();
            $data['job'] = DB::table('jobs')
                        // ->whereNotIn('id',$apppliedJob)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }else{
            $data['job'] = DB::table('jobs')
                        ->orderBy('created_at', 'desc')
                        ->get();
        }
        return view('backend.job.list',$data);
    }

    public function save(Request $req) {
        try {
            $req->validate([
                'jobname' => 'required|string',
                'description' => 'required|string',
                'requirement' => 'required|string',
                'level' => 'required|string',
            ]);
            
            DB::table('jobs')->insert([
                'nama' => $req->jobname,
                'deskripsi' => $req->description,
                'requirement' => $req->requirement,
                'level' => $req->level,
                'created_at' => now(),
            ]);

            return response()->json([
                'message' => 'success',
                'text' => 'Data saved successfully.'
            ], 200);
        } catch (\Throwable $e) {
            // die($e);
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $req) {
        try {
            $id = $req->id;
            
            $delete = DB::table('jobs')
                    ->where('id', $id)
                    ->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'success',
                    'text' => 'Data deleted successfully.'
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage()
            ], 500);
        }
    }

    public function applyJobs(Request $req) {
        try {
            $id = $req->id;
            $employeeId = Session::get('id');
            
            $save = DB::table('evaluations')->insert([
                'employee_id' => $employeeId,
                'job_id' => $id,
                'created_at' => now(),
            ]);
            if ($save) {
                return response()->json([
                    'message' => 'success',
                    'text' => 'Job Apply successfully.'
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage()
            ], 500);
        }
    }

}
