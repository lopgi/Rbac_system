<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
class AdminController extends Controller
{

    public function roles(Request $request)
    {
        //dd($request->all());

        $permissions=json_encode($request->permission);

        $data=[
            'role_name' => $request->roleName,
             'permission_name' =>  $permissions,
             'created_at'=>now(),
             'updated_at'=>now(),
  
  
          ];
        $id=$request->edit_role_id;
        if(isset($id)){
            DB::table('table_role')->where('id',$id)->update($data);
            return redirect('admin/dashboard')->withSuccess('role updated successfully');

        }
        else{
            DB::table('table_role')->insert($data);
            return redirect('admin/dashboard')->withSuccess('role added successfully');

        }
       
       
   
//dd(  $data);
      

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

    
   
   
    public function add_user(Request $request)
    {
         //dd($request->all());
         $id=$request->edit_user_id;
        $password=Hash::make($request->password);

        $user_type = 0;

       if($request->role == "1"){
        $user_type = 2; //user admin
       }
       elseif($request->role =="2"){
        $user_type = 3;//editor
       }
       elseif($request->role =="3"){
        $user_type = 4;//publisher
       }
       elseif($request->role =="4"){
        $user_type = 5;//deletor
       }
       elseif($request->role =="5"){
        $user_type = 6;//creator
       }
       else{
        $user_type = 7;
       }
        //dd($password);
      
        $user_details=[
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $password,
            'user_type'=>$user_type,
            'role_id' =>$request->role,
            'created_at'=>date('Y-m-d H:i:s'),
           
        ];
        $update_details=[
            'name'=> $request->name,
            'email'=> $request->email,
            'user_type'=>$user_type,
            'role_id' =>$request->role,

        ];
       // dd( $update_details);
        if(isset($id)){
            DB::table('users')->where('id',$id)->update($update_details);
            return redirect('admin/dashboard')->withSuccess('user update successfully');

        }
    else{
        DB::table('users')->insert($user_details);

        return redirect('admin/dashboard')->withSuccess('user added successfully');

    }

            }
    public function addposts(Request $request)
    {
       // dd($requset->all());
        $posts=[

            'post_name'=>$request->name,
            'status'=> 0 //created;
        ];
       
        
         DB::table('table_post')->insert($posts);

        return redirect('editor/dashboard')->withSuccess('post added successfully');
    }
   
    public function geteditorpost(Request $request)
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
    public function publish_post(Request $request) 
    {
        $id = $request->id;

        $post = DB::table('table_post')->where('id', $id)->first();
    
        if ($post) {
            $newStatus = $post->status == 1 ? 0 : 1;
    
            $posts_details = DB::table('table_post')->where('id', $id)->update(['status' => $newStatus]);
        }

        return redirect('editor/dashboard')->withSuccess('successfully updated');

    }
    public function editpost(Request $request)
    {
        //dd($request->all());
        $edit_post_id=$request->edit_post_id;
        $name=$request->edit_post_name;

        $update_data=[
            'post_name'=> $name,

        ];
        $posts_details= DB::table('table_post')->where('id',$edit_post_id)
        ->update($update_data);
        
       
        return redirect('editor/dashboard')->withSuccess('successfully updated');
    } 
    public function deletepost(Request $request)
    {
        //dd($request->all());
        $delete_post_id=$request->id;
        
        $posts_details= DB::table('table_post')->where('id',$delete_post_id)
        ->delete();
        
       
        return redirect('editor/dashboard')->withSuccess('successfully deleted');
    } 
    public function deleteuser(Request $request)
    {
        //dd($request->all());
        $delete_user_id=$request->id;
        
        $user_details= DB::table('users')->where('id',$delete_user_id)
        ->delete();
        
       
        return redirect('admin/dashboard')->withSuccess('successfully deleted');
    } 
    public function deletrole(Request $request)
    {
       // dd($request->all());
        $delete_role_id=$request->id;
        
        $role_details= DB::table('table_role')->where('id',$delete_role_id)
        ->delete();
        
       
        return redirect('admin/dashboard')->withSuccess('successfully deleted');
    } 
    
        
        
        


    
}