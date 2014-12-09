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
					+ "Select a series to view more information"
				+ "</div>"
			);

			var table = $('#table').DataTable();
			var oTable = $('#table').dataTable();

			$('td').click(function(e) {
				var URL_ROOT = "app.two50sixstudios.com/";
				var rowData = oTable.fnGetData($(this).closest('tr')[0]);
				var id = rowData[0];
				if(typeof Passed.data !== 'undefined') {
					$.post('/list/add_series', {id:id}, function(data){
						if(data == 'saved') {
							$(document).trigger("clear-alerts");
							$(document).trigger('add-alerts', [{
								'message': 'Successfuly added series to watchlist',
								'priority': 'success'
							}]);
						} else if (data == 'exists') {
							$(document).trigger("clear-alerts");
							$(document).trigger('add-alerts', [{
								'message': 'Series already exists on your watchlist',
								'priority': 'info'
							}]);
						} else {
							$(document).trigger("clear-alerts");
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
