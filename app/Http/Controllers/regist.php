<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;

class regist extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function create(Request $request ){
        
     
        $cek = User::where('email', $request->email)->count();
        if($cek == 1){
            return redirect('regist')-> with('fail', 'email sudah digunakan');
        }
        else{
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
            
             return redirect('regist')-> with('success', 'akun berhasil ditambahkan');
        }
      
        
        
    }
}
