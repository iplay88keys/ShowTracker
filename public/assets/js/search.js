$(document).ready(function() {
	$('#table').dataTable({
		'paging': false,
		'searching': false,
		'responsive': true,
		'dom': 'T<"toolbar">frtip',
		'order': [1, 'asc'],
		'tableTools': {
			'aButtons': []
		},
		'columnDefs': [{
			'targets': 0,
			'visible': false
		},
		{
			'targets': 2,
			'orderable': false
		}]
	});
});
