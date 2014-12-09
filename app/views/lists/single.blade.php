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
		});
	</script>
@stop
