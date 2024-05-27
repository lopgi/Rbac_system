<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Hash;
class AdminController extends Controller
{

    public function editors(Request $requset)
    {
        //dd($requset->all());
        $data=[
          'role_name' => $requset->roleName,
           'permission_id' =>$requset->permission,
           'created_at'=>now(),
           'updated_at'=>now(),


        ];
   

        DB::table('table_role')->insert($data);

        return redirect('admin/dashboard')->withSuccess('role added successfully');
    }


    public function geteditor(Request $request)
    {
    
        $editor_details=DB::table('table_role')->get();

        $user_details = DB::table('users')
        ->select('users.id','name','email','table_role.role_name')
        ->leftjoin('table_role','table_role.id','=','users.role_id')
        ->where('user_type', '!=', '1')
        ->get();

        return view('admin.dashboard',compact('editor_details','user_details'));
    }

    
   
   
    public function add_user(Request $requset)
    {
         //dd( $requset->all());
        $password=Hash::make($requset->password);

        $user_type = 0;

       if($requset->role ==1){
        $user_type = 2;
       }
       elseif($requset->role ==2){
        $user_type = 3;
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
      //dd( $student_details);

        DB::table('users')->insert($user_details);

        return redirect('admin/dashboard')->withSuccess('user added successfully');
    }



    
}
