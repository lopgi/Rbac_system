<?php
namespace App\Models;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\forgotpasswordmail;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;

class AuthController extends Controller
{
    //return 
    public function login()
    {
     //dd(Hash::make(12345));
    //    if(!empty(Auth::check()))
    //    return redirect('admin/dashboard');
   return view('auth.login');

    }
    public function AuthLogin(Request $request)
    {
    //    dd($request->all());
       $remember= !empty($request->remember)?true:false;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->pasword],true)){
            if(Auth::User()->user_type==1){
                return redirect('admin/dashboard');

            }
            else if(Auth::User()->user_type == 2){
                return redirect('editor/dashboard');

            }
            else if(Auth::User()->user_type == 3){
                return redirect('editor/dashboard');

            }
            else if(Auth::User()->user_type == 4){
                return redirect('editor/dashboard');

            }
            else if(Auth::User()->user_type == 5){
                return redirect('editor/dashboard');

            }
            
           
        }
        else{
            return redirect('/')->withFail('please enter correct email and password');
        }
        
      
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    
 
    
}
