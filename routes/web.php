<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\EvaluationController;
use App\Http\Controllers\Backend\SuccessController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** All Access */
Route::middleware('cantlogin')->group(function () {
    Route::get('/',[AuthenticationController::class,'login'])->name('login');
    Route::get('/register',[AuthenticationController::class,'register'])->name('register');
    Route::post('/storeRegister',[AuthenticationController::class,'storeRegister'])->name('storeRegister');
    Route::post('/login',[AuthenticationController::class,'session'])->name('loginAction');
});

/** Authentication Access */
Route::middleware('canlogin')->group(function(){
    
    /** Dashboard */
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard-table',[DashboardController::class,'tabel'])->name('dashboard.table');
    Route::post('/dashboard-update',[DashboardController::class,'updateResult'])->name('dashboard.update');

    /** Authentication */
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');
    
    /** Users */
    Route::get('/users',[UsersController::class,'index'])->name('users.index');
    Route::get('/users-table',[UsersController::class,'tabel'])->name('users.table');
    Route::post('/users-add',[UsersController::class,'store'])->name('users.add');

    /**Profile */
    Route::get('/profile-account',[ProfileController::class,'index'])->name('profile.index');

    /**Profile - Education */
    Route::get('/education-tab',[ProfileController::class,'education'])->name('education.tab');
    Route::post('/education-form',[ProfileController::class,'educationForm'])->name('education.form');
    Route::delete('/education-delete',[ProfileController::class,'educationDelete'])->name('education.delete');

    /**Profile - Experience */
    Route::get('/experience-tab',[ProfileController::class,'experience'])->name('experience.tab');
    Route::post('/experience-form',[ProfileController::class,'experienceForm'])->name('experience.form');
    Route::delete('/experience-delete',[ProfileController::class,'experienceDelete'])->name('experience.delete');
    
    /**Profile - Hardskill */
    Route::get('/hardskill-tab',[ProfileController::class,'hardskill'])->name('hardskill.tab');
    Route::post('/hardskill-form',[ProfileController::class,'hardskillForm'])->name('hardskill.form');
    Route::delete('/hardskill-delete',[ProfileController::class,'hardskillDelete'])->name('hardskill.delete');

    /**Profile - Certification */ 
    Route::get('/certification-tab',[ProfileController::class,'certification'])->name('certification.tab');
    Route::post('/certification-form',[ProfileController::class,'certificationForm'])->name('certification.form');
    Route::delete('/certification-delete',[ProfileController::class,'certificationDelete'])->name('certification.delete');

    /** Job Portal */
    Route::get('/jobs',[JobController::class,'index'])->name('jobs.index');
    Route::get('/jobs-list',[JobController::class,'list'])->name('jobs.list');
    Route::post('/jobs-add',[JobController::class,'save'])->name('jobs.add');
    Route::delete('/jobs-delete',[JobController::class,'delete'])->name('jobs.delete');
    Route::post('/jobs-see',[JobController::class,'seeJobs'])->name('jobs.see');
    Route::post('/jobs-apply',[JobController::class,'applyJobs'])->name('jobs.apply');

    /** Evaluation */
    Route::get('/evaluation',[EvaluationController::class,'index'])->name('eval.index');
    Route::get('/evaluation-content',[EvaluationController::class,'content'])->name('eval.content');
    Route::get('/evaluation-certification',[EvaluationController::class,'seeCertification'])->name('certification.content');
    Route::get('/evaluation-experience',[EvaluationController::class,'seeExperience'])->name('experience.content');
    Route::get('/evaluation-education',[EvaluationController::class,'seeEducation'])->name('education.content');
    Route::get('/evaluation-hardskill',[EvaluationController::class,'seeHardskill'])->name('hardskill.content');
    Route::post('/evaluation-evaluate',[EvaluationController::class,'evaluate'])->name('eval.evaluate');
    
    /** Successfully Reviewed */
    Route::get('/reviewed',[SuccessController::class,'index'])->name('reviewed');
    Route::get('/reviewed-table',[SuccessController::class,'tabel'])->name('reviewed.table');
    Route::post('/email-sent',[SuccessController::class,'email'])->name('reviewed.email');

});
