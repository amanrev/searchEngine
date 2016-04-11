<?php
namespace App\Http\Controllers;
ob_start();
session_start();

use Illuminate\Http\Request;
use DB;
use Session;
use Cookie;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
  public function admin_login()
  {
    if(!empty($_SESSION['AdminId']))
    {
      return Redirect::action('UserController@admin_dashboard');
    }
    else
    {
        return view('user.admin_login');
      }
  }

  public function admin_log()
  {

    $password=md5($_POST['password']);
    $username=$_POST['username'];
    $Info= DB::table('admins')
          ->where('username',$username)
          ->where('password',$password)
          ->first();
    if(!empty($Info)){
      $_SESSION['AdminInfo'] = $Info;
      $_SESSION['AdminId']=$Info->id;
      return Redirect::action('UserController@admin_dashboard');
    }
    else
    {
      return Redirect::action('UserController@admin_login');
    }
  }

  public function admin_dashboard(){
    
    if(!empty($_SESSION['lockScreen']))
    {
      return Redirect::action('UserController@admin_lockScreen');
    }
      if(empty($_SESSION['AdminId']))
      {
        return Redirect::action('UserController@admin_login');
      }
      else
      {

        return view('user.admin_dashboard');
      }
    }

   
    public function admin_logout(){
    session_destroy();
    return Redirect::action('UserController@admin_login');
    }

    public function admin_profile(){
    
    if(!empty($_SESSION['lockScreen']))
    {
      return Redirect::action('UserController@admin_lockScreen');
    }
    if(empty($_SESSION['AdminId']))
    {
      return Redirect::action('UserController@admin_login');
    }
    else
    {
      $userProfile=DB::table('admins')->where('id',$_SESSION['AdminId'])->first();
      return view('user.admin_profile')->with('data',$userProfile);
    }
    }

    public function admin_saveProfile( )
    {
     
       $userProfile=DB::table('admins')->where('id',$_SESSION['AdminId'])->update($_POST);
       $UserUpdatedData=DB::table('admins')->where('id',$_SESSION['AdminId'])->first();
       $_SESSION['AdminInfo']=$UserUpdatedData;
       return Redirect::action('UserController@admin_profile');
    }

    public function admin_checkAdminPassword(){


      //echo "<pre>"; print_r($_POST);die;
      $password=md5($_GET['password']);
      $UserData=DB::table('admins')->where('id',$_SESSION['AdminId'])->first();
      $getPass=$UserData->password;
      if($getPass==$password)
      {
        echo '{ "valid": true }';die;
      }
      else
      {
        echo '{ "valid": false }';die;
      }
    }

    public function admin_changePassword(){
      
      $newPass= md5($_POST['new_password']);
      DB::table('admins')->where('id',$_SESSION['AdminId'])->update(array('password' => $newPass));
      return Redirect::action('UserController@admin_profile');
    }

    public function admin_changeAdminImage(Request $request)
    {
      if(Input::file())
        {
            $file = Input::file('image');
            // $name = $file->getClientOriginalName();
            $filename  = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('profilepics/' . $filename);
            $file->move($path, $filename);
            DB::table('admins')->where('id',$_SESSION['AdminId'])->update(array('image'=>$filename));
            $UserUpdatedDat=DB::table('admins')->where('id',$_SESSION['AdminId'])->first();
            $_SESSION['UserInfo']=$UserUpdatedDat;
            return Redirect::action('UserController@admin_profile');
           }
    }

    

}
