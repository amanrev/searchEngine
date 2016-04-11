@extends('layouts.loginLayout')
 @section('title', 'Admin Login')
<style>
.login{
	background-image:url("{{URL::asset('assets/image/bg.png')}}");
}
</style>
@section('content')
<div class="logo">
    <a href="">
        <img style="width:200px;" src="{{URL::asset('assets/image/logo.gif')}}">
    </a>
</div>
<div class="menu-toggler sidebar-toggler">
</div>
<div class="content">
    <form class="login-form" action="{{action('UserController@admin_log')}}" method="post">
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>
            Enter any username and password. </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me </label>
            <button type="submit" class="btn green-haze pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>

            </button>
        </div>
        
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p>
                 no worries, click <a href="javascript:;" id="forget-password">
                here </a>
                to reset your password.
            </p>
        </div>
    </form>
    <form class="forget-form" action="index.html" method="post">
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn green-haze pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
</div>
@stop()



