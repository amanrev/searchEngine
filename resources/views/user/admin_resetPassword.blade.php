@extends('layouts.loginLayout')
 @section('title', 'Admin Reset Password')
<style>
.login{
	background-image:url("{{URL::asset('assets/image/bg.png')}}");
}
</style>
@section('content')
<?php  
          $currentRoute = Route::current();
         $params = $currentRoute->parameters();

?>
<div class="logo">
    <a href="">
        <img style="width:200px;" src="{{URL::asset('assets/image/logo.gif')}}">
    </a>
</div>
<div class="menu-toggler sidebar-toggler">
</div>
<div class="content">
    <form id="changePasswordForm" class="login-form" action="{{action('UserController@admin_setNewPassword')}}" method="post">
            <?php  if(Session::has('flash_message_error')) { ?>
             <div role="alert" class="alert alert-danger alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" style="text-indent: 0;" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>Error!</strong> {!! session('flash_message_error') !!} </div>
           <?php  }
              elseif(Session::has('flash_message_success')){ ?>
               <div role="alert" class="alert alert-success alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" style="text-indent: 0;" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>Success!</strong> {!! session('flash_message_success') !!} </div>
             <?php } ?>
        <h3 class="form-title">Reset Your Password Here </h3>
       
      
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">New Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" value="" autocomplete="off" placeholder="New Password" name="password"/>
            </div>
        </div>
<input type="hidden" value="<?= $params['id']; ?>" name="id">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" value="<?= $params['key']; ?>" name="key">
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" value="" autocomplete="off" placeholder="Confirm Password" name="re_password"/>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" id="btnDis" class="btn green-haze pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    
    </form>
 
</div>
@stop()
<script src="{{URL::asset('assets/js/ajax.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){



    });

</script>



