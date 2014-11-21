$(document).ready(function() {
	var table = $('#table').DataTable();
	var URL_ROOT = "app.two50sixstudios.com/";
	var oTT = TableTools.fnGetInstance('table');
	
	$('#search-info').hide();

	$("div.toolbar").html(
		"<div id='message' class='alert alert-info pull-left'>"
			+ "Choose an item from the list to use these buttons &#8594"
		+ "</div> <div class='pull-right'>"
		+ "<button id='remove' class='btn btn-danger' disabled='true'>"
			+ "Remove from WatchList"
		+ "</button> <button id='view' class='btn btn-primary' disabled='true'>"
			+ "View Series Information"
		+ "</button> </div>"
	);
	
	if(table.data().length == 0) {
		$('#search-info').show();
		$('#message').hide();
	}
	
	$('#toSearch').click(function() {
		$('#search').focus();
	});
	
	$('#table').delegate('tr', 'click', function(e) {
		var data = [];
		data = oTT.fnGetSelected();
		if(data.length == 0)	{
			$('#view').attr('disabled', true);
			$('#remove').attr('disabled', true);
		} else {
			$('#view').attr('disabled', false);
			$('#remove').attr('disabled', false);
		}
	});
	
	$('#view').click(function() {
		var data = oTT.fnGetSelectedData();
		var id = data[0][0];
		var url = '/list/' + id
		window.location.href = url;
	});
	
	$('#remove').click(function() {
		if(deleteItem()) {
			var rowData  = oTT.fnGetSelectedData();
			var index = oTT.fnGetSelectedIndexes();
			var id = rowData[0][0];
			$.post('/list/remove_series', {id:id}, function(data){
				if(data == "deleted") {
					$(document).trigger('add-alerts', [{
						'message': 'Successfuly removed series from watchlist',
						'priority': 'success'
					}]);
					table.row(index).remove().draw();
					$('#view').attr('disabled', true);
					$('#remove').attr('disabled', true);
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
});
