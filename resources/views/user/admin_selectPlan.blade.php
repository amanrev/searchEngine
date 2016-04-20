@extends('layouts.master')
@section('title', 'Smart Serach | Admin Panel')
@section('content')
<link href="{{URL:: asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/css/normalize.css') }}" rel="stylesheet" type="text/css"/>

	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
			
			</div>
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="<?= HTTP_ROOT. 'dashboard' ?>">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Dashboard
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12 ">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Select Plan
							</div>
						</div>
						<form>
						<div class="row margin-top-10">
						 <div class="plans">
						 <?php foreach($plans as $result) { 
						 	if($result->heading=="Recommended"){ ?>
					 			<div class="col-md-3 col-sm-3 col-xs-8 plan plan-highlight">
							      <p class="plan-recommended"><?= $result->heading ?></p>
							      <h3 class="plan-title">Team</h3>
							      <p class="plan-price">$<?= $result->price ?> <span class="plan-unit">per <?= $result->validity ?></span></p>
							      <ul class="plan-features">
							        <li class="plan-feature">5 <span class="plan-feature-name">Events</span></li>
							        <li class="plan-feature"><?= $result->urls ?> <span class="plan-feature-name"> URL's</span></li>
							      </ul>
							      <a href="<?= HTTP_ROOT ?>selectMethod/<?= base64_encode(convert_uuencode($result->id)) ?>" class="plan-button">Choose Plan</a>
							    </div>
                             <?php  }
                               else
                               {?>

                              
						    <div class="col-md-3 col-sm-3 col-xs-8 plan">
						      <h3 class="plan-title"><?= $result->heading?></h3>
						      <p class="plan-price">$<?= $result->price ?> <span class="plan-unit">per <?= $result->validity ?></span></p>
						      <ul class="plan-features">
						        <li class="plan-feature">2 <span class="plan-feature-name">Events</span></li>
						        <li class="plan-feature"><?= $result->urls ?> <span class="plan-feature-name"> URL's</span></li>
						      </ul>
						      <a href="<?= HTTP_ROOT ?>selectMethod/<?= base64_encode(convert_uuencode($result->id)) ?>" class="plan-button">Choose Plan</a>
						    </div>
						    <?php }} ?>
						   
						  </div>
						</div>
						</form>

					</div>
				</div>
			</div>
	</div>
</div>
@stop()
