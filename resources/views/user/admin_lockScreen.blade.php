<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Boutique: Admin Lock </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="<?= HTTP_ROOT_ROO ?>assets/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>

<link href="<?= HTTP_ROOT_ROO ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?= HTTP_ROOT_ROO ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="page-lock">
	<div class="page-logo">
		<a class="brand" href="index.html">
		<img style="width:200px;" src="{{URL::asset('assets/image/logo.png')}}">
		</a>
	</div>
	<div class="page-body">
		<div class="lock-head">
			 Locked
		</div>
		<div class="lock-body">
			<div class="pull-left lock-avatar-block">
				<img <?php if(!empty($_SESSION['UserInfo']->image)){ ?>
								src="{{URL::asset('profilepics')}}<?= '/'.$_SESSION['UserInfo']->image.'/'.$_SESSION['UserInfo']->image; ?>" 
								<?php } else { ?>
								src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								<?php } ?> class="lock-avatar">
			</div>
			<form class="lock-form pull-left" action="{{action('UserController@admin_unlockScreen')}}" method="post">
				<h4><?= @ucfirst($_SESSION['UserInfo']->fullname); ?></h4>
				<div class="form-group">
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-success uppercase">Login</button>
				</div>
			</form>
		</div>
		<div class="lock-bottom">
			<a href="">Not <?= @ucfirst($_SESSION['UserInfo']->fullname); ?>?</a>
		</div>
	</div>
	<div class="page-footer-custom">
		 2014 &copy; Metronic. Admin Dashboard Template.
	</div>
</div>

<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="<?= HTTP_ROOT_ROO ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?= HTTP_ROOT_ROO ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init();
});
</script>
</body>
</html>