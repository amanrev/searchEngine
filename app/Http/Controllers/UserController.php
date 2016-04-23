<?php
namespace App\Http\Controllers;
ob_start();
session_start();

use Illuminate\Http\Request;
use DB;
use Session;
use Cookie;
use Crypt;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

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

  public function admin_log(CookieJar $cookieJar)
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
      if(!empty($_POST['remember']))
      {
        $cookieJar->queue(cookie('username', $_SESSION['AdminInfo']->username, 45000));
        $cookieJar->queue(cookie('password', $_POST['password'], 45000));
      }
      else
      {
        $cookieJar->queue(cookie('username', "", 45000));
        $cookieJar->queue(cookie('password', "", 45000));
      }
      
      return Redirect::action('UserController@admin_dashboard');
    }
    else
    {
      Session::flash('flash_message_error', 'Please Check Email or Password.');
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
     Session::flash('flash_message_success', 'Logout Successfully.');
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

    public function admin_changeAdminImage()
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
            $_SESSION['AdminInfo']=$UserUpdatedDat;
            return Redirect::action('UserController@admin_profile');
           }
    }

   public function admin_addUser()
    {
     
        if(!empty($_POST))
        {
          $_POST['created']=date('Y-m-d');
          DB::table('users')->insert($_POST);
          return Redirect::action('UserController@admin_selectPlan');
        }
        else
        {
          return view('user.admin_addUser');
        }
      
    }

    public function admin_selectPlan(){
      $plans= DB::table('plans')->get();
       return view('user.admin_selectPlan')->with('plans',$plans);
    }

    public function admin_editPlans(){
      $plans= DB::table('plans')->get();
       return view('user.admin_editPlans')->with('plans',$plans);
    }

    public function admin_selectMethod($id=null){

       $planId=convert_uudecode(base64_decode($id));
       return view('user.admin_selectMethod')->with('planId',$planId);
    }
    public function admin_edit_plan($id=null){

      $ide=convert_uudecode(base64_decode($id));
      $record=DB::table('plans')->where('id',$ide)->first();
     // echo "<pre>"; print_r($record);die;
      if(!empty($_POST)){
          DB::table('plans')->where('id',$ide)->update($_POST);
         $plans= DB::table('plans')->get();
          Session::flash('flash_message_success', 'Record Updated Successfully.');
          return Redirect::action('UserController@admin_editPlans')->with('plans',$plans);

      }
      else
      {
        return view('user.admin_edit_plan')->with('record',$record);
      }
    }

    public function admin_checkEmail()
    {

      $data=DB::table('admins')->where('email_id',$_POST['value'])->first();
      if(!empty($data))
      {
        echo 1;die;
      }
      else
      {
        echo 0;die;
      }
    
    }

     public function admin_checkUsername()
    {
        //echo $_POST['value'];die;
      $data=DB::table('users')->where('username',$_POST['value'])->first();
      if(!empty($data))
      {
        echo 1;die;
      }
      else
      {
        echo 0;die;
      }
    
    }


    public function admin_forgotPassword()
    {
        $userInfo  = DB::table('admins')
                    ->where('email_id', $_POST['email'])
                    ->first();
            if(!empty($userInfo))
            {
              //echo "<pre>"; print_r($userInfo);die;
              $key=mt_rand(6,1000);
              $encode_key=Crypt::encrypt($key);
              $id=$userInfo->id;
              $email=$userInfo->email_id;
              $encode_id=Crypt::encrypt($id);
              $messageData = [
                    'encode_key' => $encode_key,
                    'encode_id' => $encode_id
                ];
              DB::table('admins')->where('id',$userInfo->id)->update(array('admins.activation_key'=>$encode_key));
              /*Mail::send('emails.UserChangePassword', $messageData, function($message) use ($email){
                    $message->to($email)->subject('Change Your Password');
                });*/

              Mail::send('emails.UserChangePassword', $messageData, function($message) {
              $message->to('singh.amanpreet288@gmail.com', 'Aman')->subject('Change Your Password');
            });
              Session::flash('flash_message_success', 'Change Password link has been sent to your email address.');
              return redirect('/admin');
              
             
            }
    }


      public function admin_resetPassword($id = null,$Key = null){
       if(!empty($id) && !empty($Key)){
            $detail['id']=$id;
            $detail['key']=$Key;
            $ide=Crypt::decrypt($id);
            $userInfo  = DB::table('admins')
                        ->where('id',$ide)
                        ->first();
            $userInfo  =  json_decode( json_encode($userInfo), true);
            $detail['email'] = $userInfo['email_id'];
            $key=Crypt::decrypt($Key);
            if($Key!=$userInfo['activation_key'] || $ide!=$userInfo['id'])
              {  
                  Session::flash('flash_message_error', 'This link has been expired.');
                  return redirect('/admin');
              }
             else
              {
                 return view('user.admin_resetPassword')->with('details',$detail);
              }
            }
            else
            {
                 Session::flash('flash_message_error', 'Some Error occured, Try Later.');
                 return redirect('/admin');
            }
            
    }

    public function admin_setNewPassword(){

      if(!empty($_POST))
      {
        if($_POST['password']!=$_POST['re_password']){
             Session::flash('flash_message_error', 'New Password and confirm Password does not match.');
             return Redirect::back();
        }
        else
        {
            $ide=Crypt::decrypt($_POST['id']);
            $userInfo  = DB::table('admins')
                            ->where('id',$ide)
                            ->first();
            $userInfo  =  json_decode( json_encode($userInfo), true);
            if(!empty($userInfo)){
            $dataNew=array(
              'activation_key'=>"",
              'password'=>md5($_POST['password'])
              );
            DB::table('admins')->where('id',$ide)->update($dataNew);
            Session::flash('flash_message_success', 'Password has been updated successfully.');
            return redirect('/admin');
          }
          Session::flash('flash_message_error', 'Some Error occured,Try Lateradmin');
         return redirect('/admin');
        }
      }
    }

    public function admin_thanks(){
      
       return view('user.admin_thanks');
    }


    public function admin_payment(){

      if(!empty($_POST)){
        // DB::table('admins')->insert(array('username'=>'hello'));
           /* if(empty($paymentCheck)){
                $employerPayment['EmployerPayment']['employer_id'] = $employer_id;
                $employerPayment['EmployerPayment']['payment_status'] = $_POST['payment_status'];
                $employerPayment['EmployerPayment']['txn_id'] = $_POST['txn_id'];
                $employerPayment['EmployerPayment']['mc_gross'] = $_POST['mc_gross'];
                $employerPayment['EmployerPayment']['payment_fees'] = $_POST['payment_fee'];
                $employerPayment['EmployerPayment']['business'] = $_POST['business'];
                $employerPayment['EmployerPayment']['payer_email'] = $_POST['payer_email'];
                $employerPayment['EmployerPayment']['receiver_email'] = $_POST['receiver_email'];
                $employerPayment['EmployerPayment']['payer_id'] = $_POST['payer_id'];
                $employerPayment['EmployerPayment']['receiver_id'] = $_POST['receiver_id'];
                $employerPayment['EmployerPayment']['ipn_track_id'] = $_POST['ipn_track_id'];
                if($this->EmployerPayment->save($employerPayment)){
       }
      */
        $data=array(
          'payment_status'=>$_POST['payment_status'],
          'txn_id'=>$_POST['txn_id'],
          'mc_gross'=>$_POST['mc_gross'],
          'payment_fees'=>$_POST['payment_fees']
          );
        DB::table('payment')->insert($data);

    }
  }

}
