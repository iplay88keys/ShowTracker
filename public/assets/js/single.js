$(document).ready(function() {
	$('#table').dataTable({
		'paging': false,
		'order': [1, 'asc'],
		'tableTools': {
			'aButtons': []
		},
		'columnDefs': [{
			'targets': 0,
			'visible': false
		}]
	});

	$('#table tfoot th').each(function() {
		var title = $('#table thead th').eq($(this).index()).text();
		$(this).html('<input type="text" placeholder="Search '+title+'" />');
	});
	 
	var table = $('#table').DataTable();
	table.columns().eq(0).each(function(colIdx) {
		$('input', table.column(colIdx).footer()).on('keyup change', function() {
			table.column(colIdx).search(this.value).draw();
		});
	});
});
