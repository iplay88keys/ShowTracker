@extends('site.default')

@section('header')
	@include('partials.table')
@stop

@section('content')
	<div id='search-info' class='alert alert-info text-center'>
		Looks like there's nothing here. Why don't you try <button id='toSearch' class='btn btn-info'> searching </button> for for a show to start tracking?
	</div>
	@include('partials.overview')
@stop

@section('footer')
	{{HTML::script('assets/js/search.js')}}
	{{HTML::script('assets/js/list.js')}}
@stop
