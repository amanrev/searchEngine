<style type="text/css">
.modal-content
{
	padding: 0 0 0 11px;
}
.modal-dialog
{
	width: 600px;
}
#sample_2_a_filter > label
{
	float: right;
}
#sample_2_b_filter > label
{
	float: right;
}
#sample_2_c_filter > label
{
	float: right;
}
#sample_2_aa_filter > label
{
	float: right;
}
#sample_2_bb_filter > label
{
	float: right;
}
#sample_2_cc_filter > label
{
	float: right;
}

#sample_2_aaa_filter > label
{
	float: right;
}
#sample_2_bbb_filter > label
{
	float: right;
}
#sample_2_ccc_filter > label
{
	float: right;
}

#sample_2_aaaa_filter > label
{
	float: right;
}
#sample_2_bbbb_filter > label
{
	float: right;
}
#sample_2_cccc_filter > label
{
	float: right;
}

</style>

<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="dashboard">
			<img style="width:150px;margin:1px 0 0 16px" src="{{URL::asset('assets/image/logo.gif')}}" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-success">
						7 </span>
						</a>
					</li>
					<li class="separator hide">
					</li>
					<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-envelope-open"></i>
						<span class="badge badge-danger">
						4 </span>
						</a>
						
					</li>
					<li class="separator hide">
					</li>
					<li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-primary">
						3 </span>
						</a>
					
					</li>
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						<?= @ucfirst($_SESSION['AdminInfo']->fullname); ?> </span>
						<img 
								<?php if(!empty($_SESSION['AdminInfo']->image)){ ?>
								src="{{URL::asset('profilepics')}}<?= '/'.$_SESSION['AdminInfo']->image.'/'.$_SESSION['AdminInfo']->image; ?>" 
								<?php } else { ?>
								src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								<?php } ?>
								class="img-circle" alt="">
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="profile">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="javascript:void(0);">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>
							<li>
								<a href="<?= HTTP_ROOT ?>logout">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	</div>