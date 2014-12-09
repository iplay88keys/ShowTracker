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
			'targets': [2, 4],
			'orderable': false
		},
		{
			'targets': 4,
			"mRender": function(data, type, full){
                 return '<div class="col-md-4 text-center"><button id="remove" class="btn btn-danger center"><i class="glyphicon glyphicon-trash"></i></button></div>';
                }
		}]
	});

	$("div.toolbar").html(
		"<div id='message' class='alert alert-info pull-left'>"
			+ "Select an series to view information about it"
		+ "</div>"
	);

	var table = $('#table').DataTable();
	var oTable = $('#table').dataTable();
	var URL_ROOT = "app.two50sixstudios.com/";
	var oTT = TableTools.fnGetInstance('table');

	$('#search-info').hide();

	$('#toSearch').click(function() {
		$('#search').focus();
	});

	$('#table').click(function(e) {
		var rowData = oTable.fnGetData($(this).closest('tr')[0])
		var id = rowData[0][0];
		var url = '/list/' + id
		window.location.href = url;
	});

	$('#remove').click(function() {
		if(deleteItem()) {
			var rowData = oTable.fnGetData($(this).closest('tr')[0]);
			var id = rowData[0];
			$.post('/list/remove_series', {id:id}, function(data){
				if(data == "deleted") {
					$(document).trigger('add-alerts', [{
						'message': 'Successfuly removed series from watchlist',
						'priority': 'success'
					}]);
					oTable.fnDeleteRow($(this).parentNode,null,true);
					table.draw();
					checkLength();
				}
			});
		}
	});

	function deleteItem() {
		if (confirm("Are you sure? This cannot be undone.")) {
			return true;
		}
		return false;
	}

	function checkLength() {
		if(table.data().length == 0) {
			$('#search-info').show();
			$('#message').hide();
		}
	}

	checkLength();
});
