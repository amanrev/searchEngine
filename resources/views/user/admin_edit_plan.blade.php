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
<?php 
 $currentRoute = Route::current();
         $params = $currentRoute->parameters(); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Edit Plan </h1>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 ">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Edit Plan
							</div>
						</div>
						<div class="portlet-body form">
							<form id="addUserForm" enctype="multipart/form-data" method="post" action="<?= HTTP_ROOT ?>edit_plan/<?= $params['id'] ?>" class="form-horizontal" role="form">
								<div class="form-body">
								                <input type="hidden" name="_token" value="{{ csrf_token() }}">

									<div  class="form-group">
										<label class="col-md-3 control-label">Plan <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input autofocus type="text" autocomplete="off" name="heading" value="<?= $record->heading ?>"  class="form-control" placeholder="Plan">
											<div style="padding-top:10px" ></div>
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">Price <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="price" value="<?= $record->price ?>"  class="form-control" placeholder="Price">
											<div style="padding-top:10px" ></div>
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">URL's <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="urls" value="<?= $record->urls ?>"  class="form-control" placeholder="URL's">
											<div style="padding-top:10px" ></div>
										</div>
									</div>

									<div  class="form-group">
										<label class="col-md-3 control-label">Validity <!-- <span style="color:#850400">*</span> --></label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="validity" value="<?= $record->validity ?>"  class="form-control" placeholder="Validity">
											<div style="padding-top:10px" ></div>
										</div>
									</div>

								

									

									<h4 style="margin-left:22px;padding-top:20px"></h4>
								   <hr>
									<div class="form-group">
										<div class="col-md-12">
											<div class="col-md-10">
											</div>
											<div class="col-md-2">
											 <button class="btn blue" type="submit">Submit</button>
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
               
                "heading": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Plan is required'
                          }
                      }
                  },
                "price": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Price is required'
                          }
                      }
                  },
                "urls": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'URLs is required'
                          }
                      }
                  },
                  "validity": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Validity is required'
                          }
                      }
                  }
            }
        })
    });
</script>