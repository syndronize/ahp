<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class EvaluationController extends Controller
{
    public function index(){
        return view('backend.evaluation.index');
    }

    public function content(){
        $data['eval'] = DB::table('evaluations')
                        ->select('evaluations.id as evaluation_id','evaluations.employee_id', 'ue.fullname as fullname', 'uh.fullname as hr_name', 'jobs.nama as jobname', 'ue.birthday as birthday')
                        ->leftJoin('users as ue', 'evaluations.employee_id', '=', 'ue.id')
                        ->leftJoin('users as uh', 'evaluations.hr_id', '=', 'uh.id')
                        ->leftJoin('jobs', 'evaluations.job_id', '=', 'jobs.id')
                        ->get();
        return view('backend.evaluation.isi',$data);
    }

    public function seeCertification(Request $req){
        try {
            $id = $req->id;
            $data['certifications'] = DB::table('certifications')
                            ->where('employee_id',$id)
                            ->get();

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

    public function seeExperience(Request $req){
        try {
            $id = $req->id;
            $data['experiences'] = DB::table('pengalamen')
                            ->where('employee_id',$id)
                            ->get();

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

    public function seeEducation(Request $req){
        try {
            $id = $req->id;
            $data['educations'] = DB::table('pendidikans')
                            ->where('employee_id',$id)
                            ->get();

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

    public function seeHardskill(Request $req){
        try {
            $id = $req->id;
            $data['hardskills'] = DB::table('hardskills')
                            ->where('employee_id',$id)
                            ->get();

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

    public function evaluate(Request $req){
        try {
            $id = $req->id;
            $certification = $req->certification;
            $experience = $req->experience;
            $education = $req->education;
            $hardskill = $req->hardskill;
            $session = Session()->get('id');

            $dataEval = [
                ['certification' => $certification, 'experience' => $experience, 'hardskill' => $hardskill, 'education' => $education, 'evaluation_id' => $id]
            ];
            DB::table('evaluations')
                ->where('id', $id)
                ->update([
                    'hr_id' => $session,
                    'certification' => $certification,
                    'pengalaman' => $experience,
                    'pendidikan' => $education,
                    'hardskill' => $hardskill,
                    'updated_at' => now()
                ]);
            return response()->json([
                $this->calculateAHP($dataEval),
                'message' => 'success',
                'text' => 'Evaluate successfully.'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'text' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }


    function calculateAHP($evaluationData) {
        try {
            // Definisikan matriks perbandingan berpasangan (tidak berubah kecuali ada perubahan kriteria)
            $comparisonMatrix = [
                [1, 5, 3, 3], // Pengalaman kerja
                [1/5, 1, 1, 3], // Sertifikasi
                [1/3, 1, 1, 3], // Hardskill
                [1/3, 1/3, 1/3, 1] // Pendidikan
            ];
    
            // Hitung jumlah kolom
            $colSums = array_fill(0, 4, 0);
            foreach ($comparisonMatrix as $row) {
                foreach ($row as $colIndex => $value) {
                    $colSums[$colIndex] += $value;
                }
            }
            
    
            // Normalisasi matriks
            $normalizedMatrix = [];
            foreach ($comparisonMatrix as $rowIndex => $row) {
                foreach ($row as $colIndex => $value) {
                    $normalizedMatrix[$rowIndex][$colIndex] = $value / $colSums[$colIndex];
                }
            }
    
            // Hitung rata-rata setiap baris (prioritas vektor)
            $priorityVector = [];
            foreach ($normalizedMatrix as $row) {
                $priorityVector[] = array_sum($row) / count($row);
            }
    
            // Ambil data penilaian dari tabel evaluation dan hitung skor total
            $totalScores = [];
            foreach ($evaluationData as $evaluation) {
                // Pastikan setiap evaluasi adalah array yang valid
                if (!is_array($evaluation) || 
                    !isset($evaluation['certification']) || 
                    !isset($evaluation['experience']) || 
                    !isset($evaluation['hardskill']) || 
                    !isset($evaluation['education']) ) {
                    throw new Exception('Invalid evaluation data format.');
                }

                // Pastikan nilai adalah angka
                $certification = is_numeric($evaluation['certification']) ? (float) $evaluation['certification'] : 0;
                $experience = is_numeric($evaluation['experience']) ? (float) $evaluation['experience'] : 0;
                $hardskill = is_numeric($evaluation['hardskill']) ? (float) $evaluation['hardskill'] : 0;
                $education = is_numeric($evaluation['education']) ? (float) $evaluation['education'] : 0;

                // Perhitungan skor total
                $x = floor($certification * $priorityVector[1] +
                                    $experience * $priorityVector[0] +
                                    $hardskill * $priorityVector[2] +
                                    $education * $priorityVector[3]);
                
                // Sertakan evaluation_id dalam hasil
                $totalScores[] = [
                    'total_score' => $x
                ];
            }

            DB::table('results')->insert([
                'evaluation_id' => $evaluationData[0]['evaluation_id'],
                'score' => $totalScores[0]['total_score'],
                'result' => '2',
                'created_at' => now(), 
            ]); 
            
            return json_encode([
                'status' => 'success',
                'text' => 'berhasil mengupdate data'
            ]);
    
        } catch (\Exception $e) {
            // Return error response JSON
            return json_encode([
                'message' => 'error',
                'text' => $e->getMessage(),
            ]);
        }
    }

    




}
