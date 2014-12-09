<!doctype html>
<html>
	<head>
		<meta charset='utf-8'>
		@include('site.partial.header')
		<style>
			ul{
    				list-style-type: none;
			}
			.cd-top {
				position: fixed;
				height: 34px;
				width: 34px;
				bottom: 20px;
				right: 20px;
				display: none;
				z-index: 999;
				cursor: pointer;
			}
			a {
				color: #111;
			}
			.cd-top .glyphicon {
				color: #111;
				width: auto;
			}
			.img-box {
				max-width: 600px;
				min-width: 300px;
			}
			td img {
				max-height: 100%;
				max-width: 100%;
			}
			div.overview {
				max-width: 500px;
				max-height: 100px;
				overflow: hidden;
				text-overflow: ellipsis;
			}
			tfoot {
    			display: table-header-group;
			}
			tr {
				cursor: pointer;
			}
		</style>
		@yield('header')
	</head>
	<body>
		<div class='container-fluid'>
			<nav class='navbar navbar-default'>
				<div class='container'>
					<div class='navbar-header'>
						<a class='navbar-brand' href='#'>Show Tracker</a>
					</div>
					<ul class='nav navbar-nav navbar-left'>
						<li class='active'><a href='/'>Home</a></li>
					</ul>
					<ul class='nav navbar-nav navbar-right'>
						@if (Auth::guest())
							<li><a href='/login'>Login</a></li>
						@else
							<li><a href='/list'>Watchlist</a></li>
							<li><a href='/logout'>Logout</a></li>
						@endif
					</ul>
					@if (! Auth::guest())
						{{Form::open(array('url'=>'search','class'=>'navbar-form pull-right'))}}
							<div class='input-group'>
								{{Form::text('term', null, array('id'=>'search', 'class'=>'form-control','placeholder'=>'Search for Series'))}}
								<div class='input-group-btn'>
									{{Form::button("<i class='glyphicon glyphicon-search'></i>&nbsp;", array('class'=>'btn btn-default', 'type'=>'submit'))}}
								</div>
							</div>
						{{Form::close()}}
					@endif
				</nav>
			</nav>
			<a href='#0' class='cd-top pull-right'><i class='fa fa-chevron-circle-up fa-3x'></i></a>
			<div class='container'>
				<div id='alert-box' data-alerts='alerts' data-ids='alerts' data-fade='2000' class='text-center'></div>
				@yield('content')
			</div>
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
			$(function() {
    				$("img.lazy").lazyload();
			});

			$('.overview').each(function() {
				$(this).qtip({
					content: $(this).text(),
					show: {
						event: 'mouseover',
						delay: 750
					},
					hide: {
						fixed: true,
						delay: 2000
					},
					style: {
						classes: 'qtip-youtube',
						tip: {
							corner: true,
							width: 10,
							height: 10
						}
					},
					position: {
						my: 'left center',
						at: 'right center',
						adjust: {
							x: 10
						}
					}
				});
			});
		</script>
	</body>
	<footer>
		@yield('footer')
	</footer>
</html>
