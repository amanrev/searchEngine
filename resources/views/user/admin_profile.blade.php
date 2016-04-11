\@extends('layouts.master')
@section('title', 'Smart Search | Admin Profile')
@section('content')
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Admin Account </h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dashboard">Home</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="profile">Profile</a>
					<i class="fa fa-circle"></i>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar" style="width:250px;">
						<!-- PORTLET MAIN -->
						<div style="height:353px" class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
								<img 
								<?php if(!empty($data->image)){ ?>
								src="{{URL::asset('profilepics')}}<?= '/'.$data->image.'/'.$data->image; ?>" 
								<?php } else { ?>
								src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								<?php } ?>
								class="img-responsive" alt="">
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									<?= @(ucfirst($data->fullname)); ?>
								</div>
								<div class="profile-usertitle-job">
									 Admin
								</div>
							</div>
							<div class="profile-usermenu">
								<ul class="nav">
									<li class="active">
										<a href="">
										<i class="icon-home"></i>
										Overview </a>
									</li>
									
								</ul>
							</div>
							<!-- END MENU -->
						</div>
					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
										</div>
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
											</li>
											<li>
												<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
											</li>
											<li>
												<a href="#tab_1_3" data-toggle="tab">Change Password</a>
											</li>
										</ul>
									</div>
									<div class="portlet-body">
										<div class="tab-content">
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
												<form role="form"  id="loginForm" method="post" action="{{action('UserController@admin_saveProfile')}}">
													<div class="form-group">
														<label class="control-label">Full Name</label>
														<input type="text" value="<?= @($data->fullname); ?>" name="fullname" placeholder="Full name" class="form-control"/>
													      <input type="hidden" name="_token" value="{{ csrf_token() }}">
													</div>
													<div class="form-group">
														<label class="control-label">User Name</label>
														<input type="text" value="<?= @($data->username); ?>" name="username" placeholder="User Name" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Email</label>
														<input type="text" value="<?= @($data->email_id); ?>" name="email_id" placeholder="Email" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Address</label>
														<textarea type="text"  name="address" placeholder="Address" class="form-control"/><?= @($data->address); ?></textarea>
													</div>
													<div class="margiv-top-10">
														<input type="submit" class="btn green-haze" value="Save Changes">
													</div>
												</form>
											</div>
											<!-- END PERSONAL INFO TAB -->
											<!-- CHANGE AVATAR TAB -->
											<div class="tab-pane" id="tab_1_2">
												<form id="imageForm"  method="post" enctype="multipart/form-data" action="{{action('UserController@admin_changeAdminImage')}}" role="form">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
															</div>
															 <input type="hidden" name="_token" value="{{ csrf_token() }}">
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
															</div>
															<div>
																<span class="btn de fault btn-file">
																<span class="fileinput-new">
																Select image </span>
																<span class="fileinput-exists">
																Change </span>
																<input type="file" name="image">
																</span>
																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
																Remove </a>
															</div>
														</div>
													</div>
													<div class="margin-top-10">
														<input type="button" value="Submit" class="btn green-haze">
														<a href="#" class="btn default">
														Cancel </a>
													</div>
												</form>
											</div>
											<!-- END CHANGE AVATAR TAB -->
											<!-- CHANGE PASSWORD TAB -->
											<div class="tab-pane" id="tab_1_3">
												<form  id="changePasswordForm" method="post" action="{{action('UserController@admin_changePassword')}}" role="form">
													<div class="form-group">
														<label class="control-label">Current Password</label>
														<input id="pass"  name="password" type="password" class="form-control"/>
													     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
													</div>
													<div class="form-group">
														<label class="control-label">New Password</label>
														<input type="password"  name="new_password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Re-type New Password</label>
														<input type="password" name="re_password" class="form-control"/>
													</div>
													<div class="margin-top-10">
														<input type="submit" value="Change Password" class="btn green-haze">
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
@endsection 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){


    	/*$('#pass').blur(function(){
    		var pass=$(this).val();
    		var token=$('#token').val();
    		var n=pass.length;
    		if(n>=3){
    			$.ajax({
    				method:'post',
    				data:{password:pass,_token:token},
    				url:'<?= HTTP_ROOT ?>checkAdminPassword',
    				success:function(resp){
    					$('#changePasswordForm').data('formValidation').validate();
    				}
    			});
    		}
    	});*/

        $('#loginForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                "email_id": 
                {
                
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: 'Email is required'
                        },
                        stringLength: 
                        {
                            message: 'email length must be less than 50 characters',
                            max: function (value, validator, $field) 
                            {
                                return 50 - (value.match(/\r/g) || []).length;
                            }
                        },
                        emailAddress: 
                        {
                            message: 'This email is not a valid email address'
                        },
                        regexp: 
                        {  
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',                            
                            message: 'The value is not a valid email address'                         
                        }
                        
                    }
                },
                "fullname": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'FullName is required'
                          }
                      }
                  },
                "username": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'UserName is required'
                          },
                          stringLength: 
		                    {
		                        min: 5,
		                        max: 30,
		                        message: 'The Username must be more than 6 and less than 30 characters long'
		                    },
		                    regexp: 
		                    {
		                        regexp: /^[a-zA-Z0-9_]+$/,
		                        message: 'The Username can only consist of alphabetical, number and underscore'
		                    }
                      }
                  },
                "address": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Address is required'
                          }
                      }
                  }
            }
        })
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
 $('#changePasswordForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                 "password": 
           		 {
		                validators: 
		                {
		                    notEmpty: 
		                    {
		                        message: 'Current password is required'
		                    },
			                remote: {
			                	message: 'This password is not the password of admin, please enter valid password.',
			                    url: '<?= HTTP_ROOT ?>checkAdminPassword?_token=bzyL5MZP3WkVtLw6u0th9KVpRWGVlRzB6DWaEIHz',
			                    type: 'Get',
			                    delay: 1000     // Send Ajax request every 2 seconds
			                }
		                }
		            },
                "new_password": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'New Password is required'
                          }
                      }
                  },
                "re_password": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Re-type Password is required'
                          },
		                    identical: {
		                        field: 'new_password',
		                        message: 'Password and its confirm are not the same'
		                    }
                      }
                  }
            }
        })
});
</script>
<script>
$(document).ready(function(){
$('#imageForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                "image": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Image is required'
                          }
                      }
                  }
            }
        })
});
</script>

