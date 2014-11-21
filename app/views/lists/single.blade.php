@extends('site.default')

@section('header')
	@include('partials.table')
@stop

@section('content')
	@include('partials.series')
@stop

@section('footer')
	{{HTML::script('assets/js/single.js')}}
	<script>
		$(document).ready(function() {
			var table = $('#table').DataTable();

			$('#view').click(function() {
				var URL_ROOT = "app.two50sixstudios.com/";
				var oTT = TableTools.fnGetInstance('table');
				var data = oTT.fnGetSelectedData();
				var id = data[0][0];
			});
		});
	</script>
@stop
