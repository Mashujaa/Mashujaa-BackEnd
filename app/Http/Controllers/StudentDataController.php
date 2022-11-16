<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Student;
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
        //     "The error is "
        // ]);
        
        $new_profile = $userU->student()->create([
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
}
