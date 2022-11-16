<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentDataController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmployeeInfoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware'=>'api',
    'prefix'=> 'auth'
], function($routes){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

});
Route::group([
    'middleware'=>'api',
    'prefix'=> 'add'    
], function($routes){
    Route::post('student-profile', [StudentDataController::class, 'add_student_details']);    
    
});
Route::group([
    'middleware'=>'api',
    'prefix' => 'get'
], function($routes){
    Route::post('student-profile', [StudentDataController::class, 'send_student_data']);
    Route::post('student-profile-all', [StudentDataController::class, 'send_student_data_all']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'add'
], function($routes){
    Route::post('courses', [CoursesController::class, 'registerCourses']);
});
Route::group([
    'middleware'=>'api',
    'prefix'=>'get'
], function($routes){
    Route::post('courses', [CoursesController::class, 'getCourse']);
    Route::post('all/courses', [CoursesController::class, 'allCourses']);
});
Route::group([
    "middleware"=>"api",
    "prefix"=>"add"
], function($routes){
    Route::post('employee-profile', [EmployeeInfoController::class, 'craete_lecturer_details']);
});
