@extends('template')
@section('content')

<h1> Input Data Parkir</h1>
{!! Html::ul($errors->all()) !!}
{!! Form::open(array('url'=>'parkir')) !!}


<table class="table table-bordered" action="/kendaraan" method="post">
	<tr>
		<td>Nama Konsumen</td>
		<td>{!! Form::text('konsumen',null,['class'=>'form-control']) !!}</td>
	</tr>
	<tr>
		<td>Jenis Kendaraan</td>
		<td>
		{!! Form::select('jenis_kendaraan', array('P' => 'Pilih Jenis Kendaraan','Motor' => 'Motor', 'Mobil' => 'Mobil'), 'Jenis Kendaraan') !!}</td>
	</tr>
	<tr>
		<td>No Polisi</td>
		<td>{!! Form::text('no_pol',null,['class'=>'form-control']) !!}</td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td>{!! 
			Form::date('tgl',null,['class'=>'form-control']) !!}</td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>
		{!! Form::select('jk', array('T' => 'Pilih Jenis Kelamin','L' => 'Laki Laki', 'P' => 'Perempuan'), 'Jenis Pilih Kelamin') !!}</td>
	</tr>
	<tr>
		<td>Nomer Handphone</td>
		<td>{!! Form::number('no_hp',null,['class'=>'form-control']) !!}</td>
	</tr>
	<tr>
		<td colspan="2">
			{!! Form::submit('Submit',['class'=>'btn btn-danger btn-sm']) !!}
			{!! link_to('parkir','Kembali',['class'=>'btn btn-danger btn-sm']) !!}
		</td>
	</tr>
</table>

{!! Form::close() !!}

@stop