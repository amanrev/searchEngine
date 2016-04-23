<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link href="{{URL:: asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}"/>

<link href="{{URL:: asset('assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css"/>

<link href="{{URL:: asset('aman/files/css/frontend_css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>


<link href="{{URL:: asset('aman/files/css/frontend_css/formValidation.min.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/admin/layout4/css/layout.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/admin/layout4/css/themes/light.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{URL:: asset('assets/admin/layout4/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/admin/pages/css/profile.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<script src="{{URL:: asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script src="{{URL:: asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{URL:: asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

<script src="{{URL:: asset('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/admin/layout4/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/admin/layout4/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/js/formValidation.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/js/Framework/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('assets/admin/pages/scripts/table-managed.js') }}"></script>

<script>
jQuery(document).ready(function() {    
	
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features 
   TableManaged.init();
});
</script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
@include('admin_header')
<div class="page-container">
@include('admin_sidebar')
@yield('content')
</body>
</html>
