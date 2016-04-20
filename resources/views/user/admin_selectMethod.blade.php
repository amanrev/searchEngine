@extends('layouts.master')
@section('title', 'Smart Search | Admin Select Payment Method')
@section('content')
<style type="text/css">
.editPrice{

	width: 98px;
}
.radio-list {
    padding: 25px 0 0 33px;
}
.form-horizontal .radio-list > label {
    margin-bottom: 15px;
}
.marg-off{margin: 0px!important;}
.padd-off{padding: 0px!important;}
</style>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				
			</div>
			
			<div class="row">
				<div class="col-md-6 ">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Select Payment Method
							</div>
						</div>
						<div class="portlet-body form">
							<form id="addUserForm" enctype="multipart/form-data" method="post" action="" class="form-horizontal" role="form">
								<div class="form-body">
								 <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 
									<div  class="form-group">
										<label class="col-md-3 control-label"> </label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="fullname"  class="form-control" placeholder="Full Name">
											<div style="padding-top:10px" ></div>
										</div>
									</div>
									<div  class="form-group">
										<label class="col-md-3 control-label">Pay via Stripe </label>
										<div class="col-md-5">
											<input type="text" autocomplete="off" name="fullname"  class="form-control" placeholder="Full Name">
											<div style="padding-top:10px" ></div>
										</div>
									</div> -->

								<!-- 	<div class="radio-list">
											<label>
											<div class="" id="uniform-optionsRadios1"><span class=""><input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"></span></div> Pay via PayPal</label>
											<label>
											<div class="" id="uniform-optionsRadios2"><span class="checked"><input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"></span></div> Pay via Stripe </label>
								   </div> -->
								   <div class="radio-list">
											<label class="radio-inline">
											<div class="" id="uniform-optionsRadios4"><span class=""><input type="radio" checked="" value="option1" id="optionsRadios4" name="optionsRadios"></span></div> Pay via PayPal </label>
											<label class="radio-inline">
											<div class="" id="uniform-optionsRadios5"><span class="checked"><input type="radio" value="option2" id="optionsRadios5" name="optionsRadios"></span></div> Pay via Stripe </label>
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

  });
</script>