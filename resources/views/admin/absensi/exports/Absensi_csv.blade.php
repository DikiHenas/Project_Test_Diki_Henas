<table>
	<thead>
		<tr>
			<th>NO</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Tanggal</th>
			<th>Jam</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@php
		$no=0;
		@endphp
		@foreach ($datas as $data)
		<tr>
			<td>{{$no=$no+1}}			
			<td>{{$data->nik}}</td>
			<td>{{$data->full_name}}</td>
			<td>{{date("d-m-Y", strtotime($data->date_time));}}</td>
			<td>{{date("H:i:s", strtotime($data->date_time));}}</td>
			<td>{{$data->in_out}}</td>
		</tr>
		@endforeach
	</tbody>
</table>