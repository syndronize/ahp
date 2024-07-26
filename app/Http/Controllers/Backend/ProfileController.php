<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class ProfileController extends Controller
{
    public function index(){
        // var_dump(Session()->all());die;
        $id = Session()->get('email');
        #profile basic
        $data['user'] = DB::table('users')
                        ->select('fullname','email','birthday')
                        ->where('email',$id)
                        ->first();

        
        return view('backend.profile.index',$data);
    }

    #Experience 
    public function experience(){
        $id = Session()->get('id');

        $data['experience'] = DB::table('pengalamen')
                            ->select('id','nama','start_date','end_date','job_description')
                            ->where('employee_id',$id)
                            ->orderBy('end_date', 'desc')
                            ->get();
        return view('backend.profile.experience',$data);
    }

    public function experienceForm(Request $req){
        try {
            $arrExperience = json_decode($req->arrayExperience, true);
            $id = Session()->get('id');
            
            foreach ($arrExperience as  $experience) {
                DB::table('pengalamen')->insert([
                    'employee_id' => $id,
                    'nama' => $experience['experienceName'],
                    'start_date' => $experience['startDate'],
                    'end_date' => $experience['endDate'],
                    'job_description' => $experience['jobDescription'],
                    'created_at' => now(), 
                ]);   
            }
            

            return response()->json([
                'message'   => 'success',
                'text'      => 'Data saved successfully.'
            ],200);
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be saved', 'error' => $e->getMessage()], 500);
        }
    }

    public function experienceDelete(Request $req){
        try {
            $id = $req->id;
            
            $delete = DB::table('pengalamen')
                      ->where('id',$id)
                      ->delete();
            if ($delete) {
                return response()->json([
                    'message'   => 'success',
                    'text'      => 'Data delete successfully.'
                ],200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be deleted', 'error' => $e->getMessage()], 500);
        }
    }

    #Hardskill
    public function hardskill(){
        $id = Session()->get('id');

        $data['hardskill'] = DB::table('hardskills')
                            ->select('id','nama','range')
                            ->where('employee_id',$id)
                            ->get();
        return view('backend.profile.hardskill',$data);
    }

    public function hardskillForm(Request $req){
        $req->validate([
            'skills.*.name' => 'required|string|max:255',
            'skills.*.range' => 'required|integer|min:1|max:10',
        ]);
        try {
            $arrHardskill = $req->skills;
            $id = Session()->get('id');

            foreach ($arrHardskill as  $hardskill) {
                DB::table('hardskills')->insert([
                    'employee_id' => $id,
                    'nama' => $hardskill['name'],
                    'range' => $hardskill['range'],
                    'created_at' => now(), 
                ]);   
            }
            return response()->json([
                'message'   => 'success',
                'text'      => 'Data saved successfully.'
            ],200);
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be saved', 'error' => $e->getMessage()], 500);
        }
    }

    public function hardskillDelete(Request $req){
        try {
            $id = $req->id;
            
            $delete = DB::table('hardskills')
                      ->where('id',$id)
                      ->delete();
            if ($delete) {
                return response()->json([
                    'message'   => 'success',
                    'text'      => 'Data delete successfully.'
                ],200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be deleted', 'error' => $e->getMessage()], 500);
        }
    }

    #Certification
    public function certification(){
        $id = Session()->get('id');

        $data['certifications'] = DB::table('certifications')
                            ->select('id','name','publisher','start_date','end_date')
                            ->where('employee_id',$id)
                            ->orderBy('end_date', 'desc')
                            ->get();
        return view('backend.profile.certification',$data);
    }

    // Save Certifications
    public function certificationForm(Request $req) {
        try {
            $arrCertification = json_decode($req->arrayCertification, true);
            $id = Session()->get('id');
            
            foreach ($arrCertification as $certification) {
                DB::table('certifications')->insert([
                    'employee_id' => $id,
                    'name' => $certification['name'],
                    'publisher' => $certification['publisher'],
                    'start_date' => $certification['startDate'],
                    'end_date' => $certification['endDate'],
                    'created_at' => now(), 
                ]);   
            }
            return response()->json([
                'message' => 'success',
                'text' => 'Data saved successfully.'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage()
            ], 500);
        }
    }

    // Delete Certification
    public function certificationDelete(Request $req) {
        try {
            $id = $req->id;
            
            $delete = DB::table('certifications')
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

    

    #Education
    public function education(){
        $id = Session()->get('id');

        $data['education'] = DB::table('pendidikans')
                            ->select('id','instansi','start_date','end_date','major','gpa')
                            ->where('employee_id',$id)
                            ->orderBy('end_date', 'desc')
                            ->get();
        return view('backend.profile.education',$data);
    }

    public function educationForm(Request $req){
        try {
            $arrEducation = json_decode($req->arrayEducation, true);
            $id = Session()->get('id');
            
            foreach ($arrEducation as  $education) {
                DB::table('pendidikans')->insert([
                    'employee_id' => $id,
                    'instansi' => $education['instansi'],
                    'start_date' => $education['startDate'],
                    'end_date' => $education['endDate'],
                    'major' => $education['major'],
                    'gpa' => $education['gpa'],
                    'created_at' => now(), 
                ]);   
            }
                if (Session()->get('isfilled') == '0') {

                    $update = DB::table('users')
                    ->where('id', $id )
                    ->update(['isfilled' => '1']);

                    if($update){
                        session(['isfilled' => 1]);
                    }
                }
            return response()->json([
                'message'   => 'success',
                'text'      => 'Data saved successfully.'
            ],200);
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be saved', 'error' => $e->getMessage()], 500);
        }
    }

    public function educationDelete(Request $req){
        try {
            $id = $req->id;
            
            $delete = DB::table('pendidikans')
                      ->where('id',$id)
                      ->delete();
            if ($delete) {
                return response()->json([
                    'message'   => 'success',
                    'text'      => 'Data delete successfully.'
                ],200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message'   => 'error',
                'text'      => $e->getMessage()
            ],500);
            return response()->json(['message' => 'Data could not be deleted', 'error' => $e->getMessage()], 500);
        }
    }
}
