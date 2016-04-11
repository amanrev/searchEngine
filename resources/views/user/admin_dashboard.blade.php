@extends('layouts.master')
@section('title', 'Smart Serach | Admin Dashboard')
@section('content')
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Dashboard <small>statistics & reports</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="<?= HTTP_ROOT. 'dashboard' ?>">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Dashboard
				</li>
			</ul>
			<div class="row margin-top-10">
				<!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-green-sharp"></h3>
								<small>Customers</small>
							</div>
							<div class="icon">
								<i class="icon-pie-chart"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: %;" class="progress-bar progress-bar-success green-sharp">
								<span class="sr-only">% progress</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="<?= HTTP_ROOT. 'Customers' ?>">View More...</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					 <div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-red-haze"></h3>
								<small>Orders</small>
							</div>
							<div class="icon">
								<i class="icon-basket"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: %;" class="progress-bar progress-bar-success red-haze">
									<span class="sr-only">% change</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="<?= HTTP_ROOT. 'Orders' ?>">View More...</a>
								</div>
							</div>
						</div>
					</div> 
				</div>-->
			<!-- 	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-blue-sharp"></h3>
								<small>Staff Member</small>
							</div>
							<div class="icon">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: %;" class="progress-bar progress-bar-success blue-sharp">
								<span class="sr-only">% grow</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="<?= HTTP_ROOT. 'StaffMembers' ?>">View More...</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-purple-soft"></h3>
								<small>Products</small>
							</div>
							<div class="icon">
								<i class="icon-like"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: %" class="progress-bar progress-bar-success purple-soft">
								<span class="sr-only">% change</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="<?= HTTP_ROOT. 'Products' ?>">View More...</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>

		</div>
	</div>
</div>
@stop()
