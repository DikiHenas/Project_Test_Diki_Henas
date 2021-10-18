<table>
	<thead>
		<tr>
			<th>NO</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Nomer Handphone</th>
			<th>Alamat</th>
		</tr>
	</thead>
	<tbody>
		@php
		$no=0;
		@endphp
		@foreach ($pegawai as $p)
		<tr>
			<td>{{$no=$no+1}}			
			<td>{{$p->nik}}</td>
			<td>{{$p->full_name}}</td>
			<td>{{$p->email}}</td>
			<td>{{$p->mobile_number}}</td>
			<td>{{$p->address}}</td>
		</tr>
		@endforeach
	</tbody>
</table>