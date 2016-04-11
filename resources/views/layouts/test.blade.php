<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="{{URL:: asset('aman/plugins/simple-line-icons/simple-line-icons.min.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('aman/files/plugins/font-awesome/css/font-awesome.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('aman/files/css/frontend_css/bootstrap.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('aman/files/css/frontend_css/sumoselect.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{URL:: asset('aman/files/css/frontend_css/formValidation.min.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<script src="{{URL:: asset('aman/files/js/frontend_js/jquery-1.11.3.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('aman/files/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('aman/files/js/frontend_js/formValidation.min.js') }}" type="text/javascript"></script>
<script src="{{URL:: asset('aman/files/js/frontend_js/Framework/bootstrap.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features 
   Index.init(); // init index page
   Tasks.initDashboardWidget(); // init tash dashboard widget  
});
</script>
</head>
</html>
