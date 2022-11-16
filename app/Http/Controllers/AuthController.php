<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\LecturerNo;
use App\Models\StudentAdmNo;
use App\Models\AllCoursesModel;
use App\Models\Courses;
use App\Models\Student;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except'=>['register', 'login']]);
    }
    public function register(Request $request){
        $data = $request->only('unique_identifier', 'password');
        if ($request->input("unique_identifier")[0]== "L"){
            $isGiven = LecturerNo::where("employee_no", "=", $request->input("unique_identifier"))->first();
            if(!$isGiven){
                return response()->json([
                    "status"=>"error",
                    "message"=>"Lecturer Number Does Not Exist"
                ]);
            }
        }else if($request->input("unique_identifier")[0]== "S"){
            // return response()->json([
            //     "Errot"
            // ]);
            $isGiven = StudentAdmNo::where("student_no", "=", $request->input("unique_identifier"))->first();
            if(!$isGiven){
                return response()->json([
                    "status"=>"error",
                    "message"=>"Student Number Does Not Exist"
                ]);
            }
        }
        
        $validate = Validator::make($data,
            [                
                'unique_identifier' => 'required',
                'password' => 'required'
            ]
        );
        if ($validate->fails()){
            return response()->json([
                "Error" => $validate->messages()
            ], 400);
        }
        $exists = User::where("unique_identifier", '=', $request->input("unique_identifier"))->first();
        if ($exists){
            return response()->json([
                "status"=>"Exists",
                "message"=>"User already exists!"
            ], 403);
        }
        
        $user = User::create([
            'unique_identifier' => $request->input('unique_identifier'),
            'password' => Hash::make($request->input('password'))
        ]);
        $token = Auth::login($user);
        return response()->json([
            "status" => "success",
            "message" => ucwords($request->input("type"))." created successfully",
            "user" => $user,
            "authorization" =>[
                "token" => $token,
                "type" => "bearer"
            ]
        ], 201);                        
    }
    public function login(Request $request){
        $data = $request->only('unique_identifier',  'password');
        $validate = Validator::make($data, [
            
            'unique_identifier' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()){
            return response()->json([
                "Error" => $validate->messages()
            ]);
        }
        $credentials = $request->only('unique_identifier', 'password');
        $token = Auth::attempt($credentials);
        if (!$token){
            return response()->json([
                "status" => "Error",
                "message" => "Unauthorized",
                'token' => $token
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            "status" => "success",
            "message" => ucwords($request->input('type'))." authenticated successfully",
            "user" => $user,
            "authorization" => [
                "token" => $token,
                "type" => "bearer"
            ]
        ], 200);
    }
    public function refresh(){
        return response()->json([
            "status" => "Success",
            "user" => Auth::user(),
            "authorization" => [
                "token" => Auth::refresh(),
                "type" => 'bearer'
            ]
        ]);
    }
    public function logout(){
        Auth::logout();
        return response()->json([
            "status" => "Success",
            "message" => "Successfully logged out"
        ]);
    }
    
}
