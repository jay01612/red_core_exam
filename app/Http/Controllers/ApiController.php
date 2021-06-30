<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mainRepository, Validator, Auth;

class ApiController extends Controller
{
    public function userRegister(Request $request){
        $validation  = Validator::make($request->all(), [
            'name'              =>  'required|string|unique:users,name',
            'email'             =>  'required|email|unique:users,email',
            'password'          =>  'required|string|min:8',
            'confirm_password'  =>  'required_with:password|same:password|min:8',
            'role_id'           =>  'required|exists:roles,id'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       =>  $validation->messages()->first()
            ],422);
        }

        $data = mainRepository::registerUser($request);

        if($data){
            return response()->json([
                'response'      =>  true,
                'message'       =>  "Success"
            ],200);
        }

        return response()->json([
            'message'       =>  false,
            'nessage'       =>  "error"
        ],422);
    }

    public function userLogin(Request $request){
        $validation = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string',

        ]);

        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   =>  $validation->messages()->first()
            ],422);
        }

        $data = Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        if($data){
            return response()->json([
                'response'      =>  true,
                'data'          =>  mainRepository::createtoken(Auth::user())
            ],200);
        }

        return response()->json([
            'response'  =>  false,
            'message'   =>  'Something is wrong'
        ],422);
    }

    public function logout(){
        $data = Auth::user();
        return $data->currentAccessToken()->delete();
    }

    public function getUsers($user = null){

        if($user > ''){
            return response()->json([
                'response'  =>  true,
                'data'      =>  mainRepository::getUser($user)
            ],200);
        }
        return response()->json([
            'response'      =>  true,
            'data'          =>  mainRepository::getUser($user)
        ],200);
    }

    public function editUser($id = null, Request $request){
        $validation = Validator::make($request->all(), [
            'name'      =>  'required|string',
            'email'     =>  'required|email',
            'role_id'   =>  'required|exists:roles,id'
        
        ]);

        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ],422);
        }

        return response()->json([
            'response'  => true,
            'data'      => mainRepository::edituser($id, $request)
        ],200);
    }

    public function editPassword($id = null, Request $request){
        $validation = Validator::make($request->all(), [
            'password'          =>  'required|string|min:8',
            'confirm_password'  =>  'required_with:password|same:password|min:8',
        ]);

        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ],422);
        }

        return response()->json([
            'response'  => true,
            'data'      => mainRepository::editpassword($id, $request)
        ],200);
    }

    

    public function deleteUser($id){
        return response()->json([
            'response'  =>  true,
            'data'      =>  mainRepository::deleteUser($id)
        ],200);
    }

    public function getAllUsersRecords($user = null){

        if($user > ''){
            return response()->json([
                'response'  =>  true,
                'data'      =>  mainRepository::getAllUsersRecords($user)
            ],200);
        }
        return response()->json([
            'response'      =>  true,
            'data'          =>  mainRepository::getAllUsersRecords($user)
        ],200);
    }

    public function createRoles(Request $request){
        $validation = Validator::make($request->all(),[
            'role_name'     =>      'required|string',
            'description'   =>      'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      =>  false,
                'message'       =>  $validation->messages()->first()
            ],200);
        }

        $data = mainRepository::createRole($request);

        if($data){
            return response()->json([
                'response'      =>  true,
                'data'          =>  $data
            ],200);
        }

        return response()->json([
            'response'      =>  false,
            'message'       =>  "there is something wrong"
        ],422);
    }

    public function getRole($role = null){

        if($role > ''){
            return response()->json([
                'response'  =>  true,
                'data'      =>  mainRepository::getRoles($role)
            ],200);
        }
        return response()->json([
            'response'      =>  true,
            'data'          =>  mainRepository::getRoles($role)
        ],200);
    }

    public function editRole($id = null, Request $request){
        $validation = Validator::make($request->all(), [
            'role_name'         =>  'required|string',
            'description'       =>  'required|string',
            
        ]);

        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ],422);
        }

        return response()->json([
            'response'  => true,
            'data'      => mainRepository::editRoles($id, $request)
        ],200);
    }

    public function deleteRole($id){
        return response()->json([
            'response'  =>  true,
            'data'      =>  mainRepository::deleteRoles($id)
        ],200);
    }

    public function getAllRoles($role = null){

        if($role > ''){
            return response()->json([
                'response'  =>  true,
                'data'      =>  mainRepository::getAllRole($role)
            ],200);
        }
        return response()->json([
            'response'      =>  true,
            'data'          =>  mainRepository::getAllRole($role)
        ],200);
    }



}
