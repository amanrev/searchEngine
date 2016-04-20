@extends('layouts.master')
@section('title', 'Smart Search | Admin Add User')
@section('content')
<style type="text/css">
.editPrice{

	width: 98px;
}
.marg-off{margin: 0px!important;}
.padd-off{padding: 0px!important;}
</style>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Add Users </h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?= HTTP_ROOT .'dashboard' ?>">Home</a>
					<i class="fa fa-circle"></i>
				</li>
			
			</ul>
			<div class="row">
				<div class="col-md-12 ">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Add User
							</div>
						</div>
						<div class="portlet-body form">
							<form id="addUserForm" enctype="multipart/form-data" method="post" action="{{action('UserController@admin_addUser')}}" class="form-horizontal" role="form">
								   <h4 style="margin-left:22px;padding-top:20px">User Details</h4>
								 <hr>
								<div class="form-body">
								                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

									<div  class="form-group">
										<label class="col-md-3 control-label">Full Name <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="fullname"  class="form-control" placeholder="Full Name">
											<div style="padding-top:10px" ></div>
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">Email Address <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
												</span>
												<input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email Address">
											</div>
										</div>
									</div>

									

									<div  id="customerContact" class="form-group">
										<label class="col-md-3 control-label">Contact No. <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input  autocomplete="off"  type="tel" name="contact_number" class="form-control" placeholder="Contact No.">
											
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">UserName <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input id="username" autocomplete="off" type="text" autocomplete="off" name="username"  class="form-control" placeholder="User Name">
											
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">Password <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input  type="text" autocomplete="off" name="password"  class="form-control" placeholder="Password">
											<div style="padding-top:10px" id="NameResponse"></div>
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">Zip Code <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input  type="text" autocomplete="off" name="zip_code"  class="form-control" placeholder="Zip Code">
											<div style="padding-top:10px" id="NameResponse"></div>
										</div>
									</div>
								
									
									<div  id="customerAddress" class="form-group">
										<label class="col-md-3 control-label">Address <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<textarea id="customeraddressVal" class="form-control" name="address" placeholder="Enter Address" rows="3"></textarea>
										</div>
									</div>

									

									<h4 style="margin-left:22px;padding-top:20px"></h4>
								   <hr>
									<div class="form-group">
										<div class="col-md-12">
											<div class="col-md-10">
											</div>
											<div class="col-md-2">
											 <button class="btn blue" type="submit">Next</button>
											</div>
										</div>
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
<script src="{{URL::asset('assets/js/ajax.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

   
  $('#addUserForm').formValidation({
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
                "email": 
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
                  },
                  "password": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Password is required'
                          }
                      }
                  }
            }
        })


 		/*var token=$('#token').val();
        $('#username').keyup(function()
        {
            var value=$(this).val();

            var n=value.length;
            if(n>=5)
            {
            $.ajax({

                method:'Post',
                data:{_token:token,value:value},
                url:'<?= HTTP_ROOT ?>checkUsername',
                success:function(resp){
                    if(resp==1)
                    {
                        $(#).formValidation('revalidateField', fieldName);
                    }
                    else
                    {
                        //alert('Email Does not Exist');
                        $(#).formValidation('revalidateField', fieldName);

                    }
                }


            });
        }
            
        });*/
    });
</script>