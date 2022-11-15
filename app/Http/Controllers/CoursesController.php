<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;
class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    public function registerCourses(Request $request){
        $user = Auth::user();
        $data = $request->only('course_title');
        $validate = Validator::make($data, [
            'course_title'=>'required'
        ]);
        if ($validate->fails()){
            return response()->json([
                "status" => "Error",
                "message" => $validate->messages()
            ]);
        }
        // $user = User::find(auth()->id);
        
        $student_id = $user->student->student_id;
        $registered = Courses::where("student_id", "=", $student_id)->first();
        if ($registered){
            return response()->json([
                "status" => "Unsuccessful",
                "registered"=>true,
                "Message" => "Already registered for ".$registered->course_title
            ], 403);
        }
        $current_student = Student::where("student_id", "=", $student_id)->first();
        
        $new_course = $current_student->course()->create([
            'course_title' => $request->input('course_title')
        ]);
        return response()->json([
            "status"=>"success",
            "message"=>"Course successfully added",
            "Course" => [
                "course Details" => $new_course
            ]
        ], 201);
    }
    public function getCourse(){
        $user = Auth::user();
        $current_student = Student::where("student_id", '=', $user->student->student_id)->first();
        $course = $current_student->course;
        return response()->json([
            "course"=>$course
        ], 200);
    }
    public function allCourses(){
        return response()->json([
            "All Courses"=>Courses::all(['course_title'])
        ], 200);
    }
}
