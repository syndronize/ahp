<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class AuthenticationController extends Controller
{
    public function register(){
        return view('backend.auth.register');
    }

    public function storeRegister(Request $req){
        // dd($req->all());
        $this->validate($req,[
            'fullname'  => 'required',
            'email'     => 'required|email|unique:users',
            'birthday'     => 'required',
            'password'  => 'required|min:8'
        ]);
        
        $date = \DateTime::createFromFormat('d F Y', $req->birthday);
        $formattedDate = $date->format('Y-m-d');
        
        $data = array(
            'fullname'  => $req->fullname,
            'email'  => $req->email,
            'birthday'     => $formattedDate,
            'password'  => Hash::make($req->password)
        );

        $save = DB::table('users')->insert($data);
        if ($save) {
            return response()->json([
                'message' => 'success',
                'text'    => 'your data has been saved !' 
            ],200);
        }else{
            return response()->json([
                'message' => 'error',
                'text'    => 'your data failed to save'
            ], 500);
        }
    }

    public function login(){
        return view('backend.auth.login');
    }

    public function session(Request $req){
        $this->validate($req,[
            'email'  => 'required|email',
            'password'  => 'required|min:8'
        ]);

        $account = DB::table('users')
                    ->where('email',$req->email)
                    ->first();
        if($account){
            if (Hash::check($req->password,$account->password)) {
                session()->put('id',$account->id);
                session()->put('fullname',$account->fullname);
                session()->put('priv',$account->priv);
                session()->put('email',$account->email);
                session()->put('isfilled',$account->isfilled);

                return response()->json([
                    'isFilled' => $account->isfilled,
                    'isPriv' => $account->priv,
                    'message' => 'success',
                    'text'    => 'Welcome Back ' . $account->fullname . ' !' 
                ],200);
            }else{
                return response()->json([
                    'message' => 'error',
                    'text'    => 'Wrong password, please try again !'
                ], 500);
            }
            
        }else{
            return response()->json([
                'message' => 'error',
                'text'    => 'E-Mail isnt registered yet'
            ], 500);
        }
        
    }

    public function logout(){
        session()->flush();
        return redirect('/')->with("success","Logged Out");
    }

}
