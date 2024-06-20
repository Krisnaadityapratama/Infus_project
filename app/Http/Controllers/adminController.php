<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\user;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function list(){
        $user = user::all();
        return view('listAdmin', ['key' => $user]);
    }

    public function delete($id){
        $user = user::where('id', $id)->first();
        $user->delete();
        return redirect()->route('admins');
    }
}
