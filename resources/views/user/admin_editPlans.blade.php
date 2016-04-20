@extends('layouts.master')
@section('title', 'Boutique | Admin Profile')
@section('content')
<style>
#sample_2_filter > label
{
	float: right;
}
.dataTables_paginate.paging_simple_numbers
{
	float: right;
}
</style>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Plans </h1>
				</div>
			</div>
			 <?php  if(Session::has('flash_message_error')) { ?>
             <div role="alert" class="alert alert-danger alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" style="text-indent: 0;" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>Error!</strong> {!! session('flash_message_error') !!} </div>
           <?php  }
              elseif(Session::has('flash_message_success')){ ?>
               <div role="alert" class="alert alert-success alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" style="text-indent: 0;" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>Success!</strong> {!! session('flash_message_success') !!} </div>
             <?php } ?>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Edit Plans
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<!-- <div class="btn-group">
											<a href="addCustomers">
												<button id="sample_editable_1_new" class="btn green">
												Add New <i class="fa fa-plus"></i>
												</button>
											</a>
										</div> -->
									</div>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
							<tr>
								<th></th>
								<th>
									 Plan 
								</th>
								<th>
									 Validity
								</th>
								<th>
									 Price
								</th>
								<th>
									 URL's
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($plans as $data) {?>
							<tr class="odd gradeX">
							
								
								<td></td>
								<td><?= $data->heading ?>
								</td>
								<td>
								<?= $data->validity ?>
								</td>
								<td>
								<?= "$".$data->price ?>
								</td>
								<td class="center">
								<?= $data->urls ?>
								</td>
								
								<td>
									<a style="color:green;text-decoration:none" href="<?= HTTP_ROOT ?>edit_plan/<?= base64_encode(convert_uuencode($data->id)) ?>">Edit </a>
									<!-- <a class="delete" style="color:red;text-decoration:none" href="">Delete</a> -->
								</td>
							</tr>
							<?php }?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			</div>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function() {       
   TableManaged.init();
    $('.delete').click(function(){
   	 if(!confirm('Are You Sure ?'))
   	 {
        return false;
   	 }
   });
});
</script>
@endsection()