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
									 Plan Name
								</th>
								<th>
									 Validity
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
							<tr class="odd gradeX">
							
								
								<td></td>
								<td>
								</td>
								<td>
								</td>
								<td class="center">
								</td>
								<td>
								</td>
								<td>
									<a style="color:green;text-decoration:none" href="">Edit <span style="color:black">|</span></a>
									<a class="delete" style="color:red;text-decoration:none" href="">Delete</a>
								</td>
							</tr>
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