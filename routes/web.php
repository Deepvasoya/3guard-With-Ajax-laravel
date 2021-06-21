<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\StudentController;
use App\Http\Controllers\Auth\TeacherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm']);
Route::get('/login/teacher', [LoginController::class, 'showTeacherLoginForm']);
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm']);
Route::get('/register/teacher', [RegisterController::class, 'showTeacherRegisterForm']);


Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/login/student', [LoginController::class, 'studentLogin']);
Route::post('/login/teacher', [LoginController::class, 'teacherLogin']);
Route::post('/register/student', [RegisterController::class, 'createStudent']);
Route::post('/register/teacher', [RegisterController::class, 'createTeacher']);

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin', [AdminController::class, 'mainstudent'])->name('Student.list');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/fetch', [AdminController::class, 'paginationstudent'])->name('pagination.student');
        Route::delete('/{id}', [AdminController::class, 'studentdelete']);

        Route::get('listresult', [AdminController::class, 'mainresult'])->name('list.result');
        Route::get('listresult/fetch', [AdminController::class, 'paginationresult'])->name('pagination.result');

        Route::get('teacherlist', [AdminController::class, 'teachermain'])->name('Teacherss.list');
        Route::get('teacherlist/fetch', [AdminController::class, 'teacherpagination'])->name('teacher.pagination');
        Route::delete('teacherlist/{id}', [AdminController::class, 'teacherdelete']);

        Route::post('addsubject', [AdminController::class, 'addnewsubject'])->name('add.newsubject');
        Route::get('subjectlist', [AdminController::class, 'subjectmain'])->name('Subject.list');
        Route::post('subjectlist/fetch', [AdminController::class, 'subjectpagination'])->name('subject.pagination');
        Route::get('subjectlist/{id}', [AdminController::class, 'subjectedit']);
        Route::put('subjectlist/updatesubject', [AdminController::class, 'subjectupdate'])->name('Subject.update');
        Route::delete('subjectlist/{id}', [AdminController::class, 'subjectdelete']);

        Route::post('addstandard', [AdminController::class, 'addnewstandard'])->name('add.newstandard');
        Route::get('standardlist', [AdminController::class, 'standardmain'])->name('Standard.list');
        Route::post('standardlist/fetch', [AdminController::class, 'standardpagination'])->name('standard.pagination');
        Route::delete('standardlist/{id}', [AdminController::class, 'standarddelete']);
    });
});
Route::group(['middleware' => 'auth:student'], function () {
    Route::view('/student', 'Student.student');
    Route::group(['prefix' => 'student'], function () {
        Route::post('/result', [StudentController::class, 'result'])->name('Student.result');
    });
});
Route::group(['middleware' => 'auth:teacher'], function () {
    Route::get('/teacher', [TeacherController::class, 'studentmain'])->name('Teacher.list');
    Route::group(['prefix' => 'teacher'], function () {
        Route::post('/fetch', [TeacherController::class, 'studentpagination'])->name('teacher.pagination');
        Route::post('addresult', [TeacherController::class, 'addstudentresult'])->name('add.result');

        Route::get('resultlist', [TeacherController::class, 'resultmain'])->name('Result.list');
        Route::post('resultlist/fetch', [TeacherController::class, 'resultpagination'])->name('Result.pagination');
    });
});
Route::get('logout', [LoginController::class, 'logout']);
