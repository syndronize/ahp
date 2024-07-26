<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(){
        
        return view('backend.users.index');
    }

    public function tabel(){
        $data['eval'] = DB::table('evaluations')
        ->select('evaluations.id as evaluation_id','evaluations.employee_id', 'ue.fullname as fullname', 'uh.fullname as hr_name', 'jobs.nama as jobname', 'ue.birthday as birthday')
        ->leftJoin('users as ue', 'evaluations.employee_id', '=', 'ue.id')
        ->leftJoin('users as uh', 'evaluations.hr_id', '=', 'uh.id')
        ->leftJoin('jobs', 'evaluations.job_id', '=', 'jobs.id')
        ->get();
                        
        return view('backend.users.tabel',$data);
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'fullname' => 'required|string|max:255',
    //         'username' => 'required|string|max:255|unique:users',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //         'priv' => 'required|string',
    //         'almamater' => 'required|string|max:255',
    //         'ipk' => 'required|numeric|min:0|max:4',
    //         'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    //         'arrayPengalaman' => 'required|string',
            
    //     ]);

    //     if ($request->file('cv')) {

    //         $file = $request->file('cv');
    //         $filePath = $file->store('uploads/cv', 'public');  // Store the file in the 'public/uploads' directory
    //         $arrayPengalaman = json_decode($request->arrayPengalaman, true);
    //         // Save user info and file info to the database using Query Builder
    //         DB::table('users')->insert([
    //             'fullname' => $request->fullname,
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password),
    //             'priv' => $request->priv,
    //             'almamater' => $request->almamater,
    //             'ipk' => $request->ipk,
    //             'cv' => $filePath,
    //             'pengalaman' => json_encode($arrayPengalaman),
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         return response()->json([
    //             'message'   => 'success',
    //             'text'      => 'User added successfully.'
    //         ],200);
    //     }

    //     return response()->json([
    //         'message'   => 'error',
    //         'text'      => 'File upload failed.'
    //     ], 500);
    // }
    
    
}
