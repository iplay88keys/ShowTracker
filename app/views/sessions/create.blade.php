<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		@include('site.partial.header')
		{{HTML::style('assets/css/login.css')}}
	</head>
	<body>
		<div class='container'>
			{{Form::open(array('url' => 'login', 'method'=>'post', 'class'=>'form-signin'))}}
				<div id='alert-box' data-alerts='alerts' data-ids='alerts' data-fade='800' class='text-center'></div>
				<h2 class="form-signin-heading">Please sign in</h2>
				{{Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address'))}}
				{{Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password'))}}
				{{Form::submit('Sign in', array('class'=>'btn btn-lg btn-primary btn-block', 'type'=>'submit'))}}
			{{Form::close()}}
		</div>
		<script type="text/javascript">
			@if(isset($js_config))
				var messageInfo = {{json_encode($js_config)}};
				$('#alert-box').bsAlerts();
				if(typeof(messageInfo.message) != 'undefined' && typeof(messageInfo.message_type) != 'undefined') {
					$(document).trigger('add-alerts', [{
						'message': messageInfo.message,
						'priority': messageInfo.message_type
					}]);
				}
			@endif
		</script>
  	</body>	
</html>
