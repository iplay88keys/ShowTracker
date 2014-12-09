<table id="table" class="display dataTable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Series</th>
			<th>Banner</th>
			<th>Overview</th>
			@if(isset($type) && $type == 'list')
				<th>Remove</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@foreach($data as $series)
				<tr>
					<td>{{$series->id}}</td>
					<td>{{$series->name}}</td>
					<td>
						<div class='img-box'>
							<img src='http://thetvdb.com/banners/{{$series->banner}}' data-src='holder.js/758x140/text:No Banner Found'/>
						</div>
					</td>
					<td>
						<div class='overview'>
							{{$series->overview}}
						</div>
					</td>
					@if(isset($type) && $type == 'list')
						<td></td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</trbody>
</table>
