<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UnitsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    public function registerUnits(Request $request){

        $data = $request->only('unit_code', 'unit_title');
        $validate = Validator::make($data,[
            "unit_title" => "required",
            "unit_code" => "required"
        ]);
        if ($validate->fails()){
            return response()->json([
                "status"=>"Error",
                "message"=>$validate->messages()
            ]);
        }
        $user = Auth::user();
        $student_id = $user->student->student_id;
        $course = Courses::where("student_id", "=", $student_id)->first();
        $course_id = $course->course_id;
        if (!$course_id){
            return response()->json([
                "status"=>"Unsuccessful",
                "registered"=>false,                
            ], 404);
        }
        $new_unit = $course->units()->create(
            [
                "unit_title" => $request->input('unit_title'),
                "unit_code" => $request->input("unit_code")
            ]
        );
        return response()->json([
            "status" => "success",
            "message" => "units added successfully",
            "Units" => [
                "units details" => $new_unit
            ]
        ], 201);
    }
}
