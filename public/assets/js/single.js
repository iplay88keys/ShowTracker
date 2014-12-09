$(document).ready(function() {
	$('#table').dataTable({
		'paging': false,
		'order': [2, 'asc'],
		'tableTools': {
			'aButtons': []
		},
		'columnDefs': [{
			'targets': 0,
			'visible': false
		},
		{
			'targets': 1,
			'searchable': false,
			'sortable' : false,
			'width' : '10%'
		}]
	});

	var oTable = $('#table').dataTable();

	$('#table tfoot th').each(function() {
		if($(this).index() != 0) {
			var title = $('#table thead th').eq($(this).index()).text();
			$(this).html('<input type="text" placeholder="Search '+title+'" />');
		} else {
			$(this).html('');
		}
	});

	var table = $('#table').DataTable();
	table.columns().eq(0).each(function(colIdx) {
		if($(this).index() != 0) {
			$('input', table.column(colIdx).footer()).on('keyup change', function() {
				table.column(colIdx).search(this.value).draw();
			});
		}
	});

	$(':checkbox').change(function(e) {
		console.log(this.checked);
		if($(this).is(":not(:checked)")) {
			if(confirm("Are you sure?")) {
				var rowData = oTable.fnGetData($(this).closest('tr')[0]);
				var id = rowData[0];
				var series = $('#series').html();
				$.post('/list/remove_episode', {id:id, series:series}, function(data){
					if(data == 'done') {
						$(document).trigger("clear-alerts");
						$(document).trigger('add-alerts', [{
							'message': 'Successfuly removed episode from watched',
							'priority': 'success'
						}]);
					} else {
						$(document).trigger("clear-alerts");
						$(document).trigger('add-alerts', [{
								'message': 'An error occured',
								'priority': 'error'
							}]);
						}
					});
			} else {
				this.checked = true;
			}
		} else {
			var rowData = oTable.fnGetData($(this).closest('tr')[0]);
			var id = rowData[0];
			var series = $('#series').html();
			$.post('/list/add_episode', {id:id, series:series}, function(data){
				if(data == 'done') {
						$(document).trigger("clear-alerts");
						$(document).trigger('add-alerts', [{
							'message': 'Successfuly added episode as watched',
							'priority': 'success'
						}]);
				}
			});
		}
	});
});
