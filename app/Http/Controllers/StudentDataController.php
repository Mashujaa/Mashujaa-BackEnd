<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Student;
use App\Models\AllCoursesModel;
use App\Models\AllUnitsModel;
use App\Models\Courses;

class StudentDataController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    public function add_student_details(Request $request){
        
        $userU = Auth::user();
        
        $data = $request->only('first_name', 'last_name',
        'national_id', 'birth_date',
        'gender', 'email_address', 'street_address',
        'city', 'state/province', 'postal/zipcode',
        'telephone_number'
        );
        $validate = Validator::make($data,
            [
                'first_name' => 'required', 'last_name' => 'required',
                'national_id' => 'required', 'birth_date' => 'required', 
                'gender' => 'required', 'email_address' => 'required', 
                'street_address' => 'required', 'city' => 'required', 
                'state/province' => 'required', 'postal/zipcode' => 'required',
                'telephone_number' => 'required'
            ]
        );
        if ($validate->fails()){
            return response()->json([
                "Error" => $validate->messages()
            ]);
        }
        // return response()->json([
        //     "The error is 1"
        // ]);
        $current_student = $userU->student();
        // return response()->json([
        //     "The error is 2",
        //     $current_student,
        //     $userU
        // ]);
        $new_profile = $current_student->create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'national_id' => $request->input('national_id'),
            'birth_date' => $request->input('birth_date'),
            'gender' => $request->input('gender'),
            'email_address'=>$request->input('email_address'),
            'street_address'=>$request->input('street_address'),
            'city' => $request->input('city'),
            'state/province' => $request->input('state/province'),
            'postal/zipcode' => $request->input('postal/zipcode'),
            'telephone_number' => $request->input('telephone_number')
        ]);
        $this->registerCourse();
        return response()->json([
            "status" => "success",
            "message" => "Student profile successfully added",
            "profile" => [
                "Student Data" => $new_profile
            ]

        ], 201);        
    }
    public function send_student_data(){
        $user = Auth::user();
        return response()->json([
            "student"=>$user->student
        ], 200);
    }
    public function send_student_data_all(){
        return response()->json([
            "students" => Student::all()
        ]);
    }
    public function registerCourse(){
        $user = Auth::user();        
        $course_code = substr(explode("/", $user->unique_identifier)[0], 2);
        $course = AllCoursesModel::where("course_code", "=",$course_code)->first();        
        $current_student = Student::where("student_id", "=", $user->student->student_id)->first();        
        $new_course = $current_student->course()->create([
            "course_id" => $course->id
        ]);
        $this->registerUnits($course);
    }
    public function registerUnits($code){
        $user = AUth::user();
        $course = Courses::where("student_id", "=", $user->student->student_id)->first();
        $units = AllUnitsModel::where("course_id", "=", $code->id)->all();
        return response()->json([
            $units
        ]);
        $new_unit = $course->units()->create(
            [
                "unit_id"=>1
            ]
            
        );
    }
}
