<?php

namespace App\Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;

class Users extends Controller {

    public function index() {
        return view('users::user_list');
    }

    public function getUsers() {
        $limit = (Input::get('length') != '') ? Input::get('length') : 10;
        $offset = (Input::get('start') != '') ? Input::get('start') : 0;
        $search = Input::get('search')['value'];
        $query = User::where(function($qry) use ($search) {
                    $qry->where('name', 'like', $search . '%');
                    $qry->orWhere('email', 'like', $search . '%');
                });
        $count = $query->count();
        $data = $query->skip($offset)->take($limit)->get();
        $result = ["iTotalDisplayRecords" => $count, 'data' => $data, "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        return response()->json($result);
    }
    
    public function getUserDetails() {
        $id = Input::get('id') ;
        $result = User::find($id);
        return response()->json($result);
    }
    
    public function deleteUser() {
        $id = Input::get('id') ;
        $name = Input::get('name') ;
        $status = Input::get('status') ;
        $result = User::where('id',$id)->update();
        return response()->json($result);
    }
    
    public function updateUserDetails() {
        $id = Input::get('id') ;
        $name = Input::get('name') ;
        $status = Input::get('status') ;
        $result = User::where('id',$id)->update(['name' => $name, 'status' => $status]);
        return response()->json(['status' => 1, 'msg' => 'User details updated successfully']);
    }

}
