@extends('template')
@section('content')
<h1>DATA PARKIR</h1>
{!! link_to('parkir/create', 'Input Parkir Masuk', ['class' => 'btn btn-danger btn-sm']) !!}
<hr>
{{ Session::get('message')}}
<!-- table -->
<table class="table table-bordered">
	<tr>
		<th>Nama Konsumen</th>
		<th>No Polisi</th>
		<th>Jenis Kendaraan</th>
		<th>Tanggal Lahir</th>
		<th>Jenis Kelamin</th>
		<th>Nomer Handphone</th>
		<th>Masuk</th>
		<th>Keluar</th>
		<th>Biaya</th>
		<th></th>
	</tr>
		@foreach($data as $masuk)
	<tr>
		<td>{{ $masuk->konsumen }}</td>
		<td>{{ $masuk->no_pol }}</td>
		<td>{{ $masuk->jenis_kendaraan }}</td>
		<td>{{ $masuk->tgl }}</td>
		<td>{{ $masuk->jk }}</td>
		<td>{{ $masuk->no_hp }}</td>
		<td>{{ date('F d, Y G:i:s', strtotime($masuk->created_at)) }}</td>
		<td> </td>
		<td> </td>
		<td>
			{!! link_to('parkir/'.$masuk->id.'/edit','Edit',['class' => 'btn btn-danger btn-sm']) !!}
			{!! link_to('parkir/'.$masuk->id,'Detail',['class' => 'btn btn-danger btn-sm']) !!}
			{!! Form::open(array('method'=>'delete','url'=>'parkir/'.$masuk->id))!!}
			{!! Form::hidden('_delete', 'DELETE') !!}
			{!! Form::submit('Delete',['class'=>'btn btn-danger btn-sm']) !!}
			{!! Form::close() !!}
		</td>
	</tr>

@endforeach

</table>

@stop