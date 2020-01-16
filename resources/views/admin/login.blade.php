<!DOCTYPE html>
<html lang="en">

<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Metro Admin Template - Metro UI Style Bootstrap Admin Template</title>
	<meta name="description" content="Metro Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="{{asset('backEnd')}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('backEnd')}}/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="{{asset('backEnd')}}/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="{{asset('backEnd')}}/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="{{URL::to('backEnd/img/favicon.ico')}}">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url({{URL::to('backEnd/img/bg-login.jpg')}}) !important; }
		</style>
		
	
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
<p class="alert-danger">
					@php
					    $message=Session::get('message');

                         if($message)
                         {
                         	echo $message;
                         	Session::put('message',null);
                         }


					@endphp
</p>

					<h2>Login to your account</h2>
					<form class="form-horizontal" action="{{url('admin-dashboard')}}" method="post">
						@csrf
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="admin_email"  type="text" placeholder="type email address"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>

								<input class="input-large span10" name="admin_password" id="password" type="password" placeholder="type password"/>
							</div>
							
							
							

							<div class="button-login">
							<button type="button" class="btn btn-primary" id="show_password">Show password</button>	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>
					<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="{{asset('backEnd')}}/js/jquery-1.9.1.min.js"></script>
	<script src="{{asset('backEnd')}}/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.ui.touch-punch.js"></script>
	
		<script src="{{asset('backEnd')}}/js/modernizr.js"></script>
	
		<script src="{{asset('backEnd')}}/js/bootstrap.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.cookie.js"></script>
			
		<script src="{{asset('backEnd')}}/js/jquery.chosen.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.uniform.min.js"></script>
		
		<script src="{{asset('backEnd')}}/js/jquery.cleditor.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.noty.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.elfinder.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.raty.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.iphone.toggle.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="{{asset('backEnd')}}/js/jquery.gritter.min.js"></script>
		
		<script src="{{asset('backEnd')}}/js/custom.js"></script>

 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
		<script >
			<!-- password show and hide -->
			$(document).ready(function(){  
				 $('#show_password').on('click', function(){  
				  var passwordField = $('#password');  
				  var passwordFieldType = passwordField.attr('type');
				  if(passwordField.val() != '')
				  {
				   if(passwordFieldType == 'password')  
				   {  
				    passwordField.attr('type', 'text');  
				    $(this).text('Hide Password');  
				   }  
				   else  
				   {  
				    passwordField.attr('type', 'password');  
				    $(this).text('Show Password');  
				   }
				  }
				  else
				  {
				   alert("Please Enter Password");
				  }
				 });  
				}); 
		</script>
		<!-- end password show and hide -->
	<!-- end: JavaScript-->
	
</body>

</html>
