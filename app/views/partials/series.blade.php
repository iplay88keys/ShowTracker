<a href='/list'>&#8592; Back</a>
<div class='row text-center'>
	<img id='banner' src='http://thetvdb.com/banners/{{$data["serie"]->banner}}' data-src='holder.js/758x140/text:{{$data["serie"]->name}}' alt='{{$data["serie"]->id}}'/>
</div>
<table id="table" class="display dataTable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Watched</th>
			<th>Season</th>
			<th>Episode</th>
			<th>Title</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Watched</th>
			<th>Season</th>
			<th>Episode</th>
			<th>Title</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($data['episodes'] as $episode)
			<tr>
				<td>{{$episode->id}}</td>
				<td>
					<div class="text-center">
						<input type='checkbox' name='{{$episode->id}}'
							@if(count($watched) > 0)
								@if(array_key_exists($episode->id, $watched))
									checked='true'
								@endif
							@endif
						>
					</div>
				</td>
				@if($episode->season == '0')
					<td>Special</td>
				@else
					<td>{{$episode->season}}</td>
				@endif
				<td>{{$episode->number}}</td>
				<td>{{$episode->name}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
