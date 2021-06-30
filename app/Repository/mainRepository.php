<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Role;
use Hash;

class mainRepository{

    public static function registerUser($data){
        return User::create([
            'name'              =>  $data->name,
            'email'             =>  $data->email,
            'password'          =>  Hash::make($data->password),
            'confirm_password'  =>  Hash::make($data->confirm_password),
            'role_id'           =>  $data->role_id
        ]);
    }

    public static function createtoken($data){
        $issuetoken = $data->createToken($data->name);
        $plaintext = $issuetoken->plainTextToken;

        return [
            $issuetoken,
            $plaintext
        ];
    }

    public static function getUser($user = null){
        if($user > ''){
            return User::with(['roles'])->where('name', 'like', "%{$user}%")->get();
        }

        return User::get();

    }

    public static function edituser($id, $data){
        return User::query()
            ->where('id', $id)
            ->update([
                'name'              =>  $data->name,
                'email'             =>  $data->email,
                'role_id'           =>  $data->role_id
        ]);  
    }

    public static function editpassword($id, $data){
        return User::query()
            ->where('id', $id)
            ->update([
                'password'          =>  Hash::make($data->password),
                'confirm_password'  =>  Hash::make($data->confirm_password),
               
        ]); 
    }

    public static function deleteUser($id){
        return User::where('id', $id)->delete();
    }

    public static function getAllUsersRecords($user = null){
        if($user > ''){
            return User::where('name', 'like', "%{$user}%")->withTrashed()->get();
        }

        return User::withTrashed()->get();

    }

    public static function createRole($data){

        return Role::create([
            'role_name'     =>  $data->role_name,
            'description'   =>  $data->description
        ]);
    }

    public static function getRoles($role = null){
        if($role > ''){
            return Role::where('role_name', 'like', "%{$role}%")->get();
        }

        return Role::get();
    }

    public static function editRoles($id, $data){
        return User::query()
            ->where('id', $id)
            ->update([
                'role_name'              =>  $data->role_name,
                'description'             =>  $data->description,
        ]);  
    }


    public static function deleteRoles($id){
        return Role::where('id', $id)->delete();
    }

    public static function getAllRole($role = null){
        if($role > ''){
            return Role::where('name', 'like', "%{$role}%")->withTrashed()->get();
        }

        return Role::withTrashed()->get();

    }


}