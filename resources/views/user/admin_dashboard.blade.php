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
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-green-sharp">0</h3>
								<small>Users</small>
							</div>
							<div class="icon">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: 20%;" class="progress-bar progress-bar-success green-sharp">
								<span class="sr-only">0 % progress</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="javascript:void(0);">View More...</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					 <div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-red-haze">0</h3>
								<small>Business</small>
							</div>
							<div class="icon">
								<i class="icon-basket"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: 30%;" class="progress-bar progress-bar-success red-haze">
									<span class="sr-only">30 % change</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="javascript:void(0);">View More...</a>
								</div>
							</div>
						</div>
					</div> 
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2">
						<div class="display">
							<div class="number">
								<h3 class="font-blue-sharp">0</h3>
								<small>Events</small>
							</div>
							<div class="icon">
								<i class="icon-pie-chart"></i>
							</div>
						</div>
						<div class="progress-info">
							<div class="progress">
								<span style="width: 40%;" class="progress-bar progress-bar-success blue-sharp">
								<span class="sr-only">40% grow</span>
								</span>
							</div>
							<div class="status">
								<div class="status-number">
									 <a style="text-decoration:none" href="javascript:void(0)">View More...</a>
								</div>
							</div>
						</div>
					</div>
				</div>
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
