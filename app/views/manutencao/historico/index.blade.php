@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho"><strong>Histórico de Manutenções</strong></h2>

<center>
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<div class="row">
	<thead>
		<tr>
			<th width="100">Data</th>
			<th width="100">Inicio</th>
			<th width="100">Polo</th>
			<th width="100">Cpu</th>
			<th width="100">Responsavel pela Manutenção</th>
			<th width="100">Fim</th>
			<th width="150">Laudo</th>
			<th width="100">Finalizado</th>
		</tr>
	</thead>

	<tbody>
	@foreach($query as $data)
	<tr>
		<td>{{ date("d/m/Y", strtotime($data->dta_manutencao)) }}</td>
		<td>{{ date("H:i:s", strtotime($data->hora_inicial)) }}</td>
		<td>{{ $data->strpolo }}</td>
		<td>{{ $data->strnomecpu }}</td>
		<td>{{ $data->strfuncionario }}</td>
		<td>{{ date("H:i:s", strtotime($data->hora_final)) }}</td>
		<td>{{ $data->laudo_manutencao }}</td>
		<td><center><img src="{{ asset('public/assets/img/check.png') }}" width="25%" /></center></td>
	</tr>
	<tr>
		<td colspan="8"></td>
	</tr>
	@endforeach
	</tbody>
	</div>
</table>
<div id="outer">
	<div id="inner">
		<?=$query->links();?>
	</div>
</div>
</center>
@stop