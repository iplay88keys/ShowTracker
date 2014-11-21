@extends('site.default')

@section('header')
	@include('partials.table')
@stop

@section('content')
	@include('partials.overview')
@stop

@section('footer')
	{{HTML::script('assets/js/search.js')}}
	<script>
		$(document).ready(function() {
			$("div.toolbar").html(
				"<div id='message' class='alert alert-info pull-left'>"
					+ "Choose an item from the list to use this button &#8594"
				+ "</div> <div class='pull-right'>"
				+ "<button id='add' class='btn btn-primary' disabled='true' href='test'>"
					+ "Add Series to WatchList"
				+ "</button></div>"
			);
			
			var table = $('#table').DataTable();
			var oTT = TableTools.fnGetInstance('table');			

			$('#table').delegate('tr', 'click', function(e) {
				var data = [];
				var data = oTT.fnGetSelected();
				if(data.length == 0)	{
					$('#add').attr('disabled', true);
				} else {
					$('#add').attr('disabled', false);
				}
			});

			$('#add').click(function() {
				var URL_ROOT = "app.two50sixstudios.com/";
				var oTT = TableTools.fnGetInstance('table');
				var data = oTT.fnGetSelectedData();
				var id = data[0][0];
				if(typeof Passed.data !== 'undefined') {
					$.post('/list/add_series', {id:id}, function(data){
						if(data == 'saved') {
							$(document).trigger('add-alerts', [{
								'message': 'Successfuly added series to watchlist',
								'priority': 'success'
							}]);
						} else if (data == 'exists') {
							$(document).trigger('add-alerts', [{
								'message': 'Series already exists on your watchlist',
								'priority': 'info'
							}]);
						} else {
							$(document).trigger('add-alerts', [{
								'message': 'There was an error.',
								'priority': 'error'
							}]);
						}
					});
				}
			});
		});
	</script>
@stop
