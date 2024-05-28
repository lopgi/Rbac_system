<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
class AdminController extends Controller
{

    public function roles(Request $requset)
    {
        //dd($requset->all());
        $permissions=json_encode($requset->permission);
       
        $data=[
          'role_name' => $requset->roleName,
           'permission_name' =>  $permissions,
           'created_at'=>now(),
           'updated_at'=>now(),


        ];
   
//dd(  $data);
        DB::table('table_role')->insert($data);

        return redirect('admin/dashboard')->withSuccess('role added successfully');
    }


    public function getusers(Request $request)
    {
    
        $editor_details=DB::table('table_role')->get();
//dd($editor_details);
        $user_details = DB::table('users')
        ->select('users.id','name','email','table_role.role_name')
        ->leftjoin('table_role','table_role.id','=','users.role_id')
        ->where('user_type', '!=', '1')
        ->get();

        return view('admin.dashboard',compact('editor_details','user_details'));
    }

    
   
   
    public function add_user(Request $requset)
    {
        // dd( $requset->all());
        $password=Hash::make($requset->password);

        $user_type = 0;

       if($requset->role == "1"){
        $user_type = 2; //user admin
       }
       elseif($requset->role =="2"){
        $user_type = 3;//editor
       }
       elseif($requset->role =="3"){
        $user_type = 4;//publisher
       }
       elseif($requset->role =="4"){
        $user_type = 5;//deletor
       }
       elseif($requset->role =="5"){
        $user_type = 6;//creator
       }
        //dd($password);
      
        $user_details=[
            'name'=> $requset->name,
            'email'=> $requset->email,
            'password'=> $password,
            'user_type'=>$user_type,
            'role_id' =>$requset->role,
            'created_at'=>date('Y-m-d H:i:s'),
           
        ];
     // dd($user_details);

        DB::table('users')->insert($user_details);

        return redirect('admin/dashboard')->withSuccess('user added successfully');
    }
    public function addposts(Request $requset)
    {
        //dd($requset->all());
        $posts=[

            'post_name'=>$requset->name,
            'status'=> 0 //created;
        ];
       
        
         DB::table('table_post')->insert($posts);

        return redirect('useradmin/dashboard')->withSuccess('post added successfully');
    }
    public function getposts(Request $requset)
    {
        $posts_details= DB::table('table_post')->get();

        return view('useradmin.dashboard',compact('posts_details'));
    }  
    public function geteditorpost(Request $requset)
    {
        $posts_details= DB::table('table_post')
        ->get();
        
        $userType = Auth::user()->user_type;
        $user_id = Auth::user()->role_id;
        $getpermission=DB::table('table_role')
        ->select('permission_name')
        ->where('id', $user_id)->get();
        return view('editor.dashboard',compact('posts_details','getpermission'));
    }  
    
        
        
        


    
}
