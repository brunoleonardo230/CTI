@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho"><strong>Histórico de Eventos</strong></h2>

<center>
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<div class="row">
	<thead>
		<tr>
			<th width="100">Evento</th>
			<th width="100">Funcionário(a)</th>
			<th width="100">Local</th>
			<th width="100">Data</th>
			<th width="100">Hora</th>
			<th width="150">Observações</th>
			<th width="100">Finalizado</th>
		</tr>
	</thead>

	<tbody>
	@foreach($query as $evento)
	<tr>
		<td>{{ $evento->strevento }}</td>
		<td>{{ $evento->strfuncionario }}</td>
		<td>{{ $evento->strlocalevento }}</td>
		<td>{{ date("d/m/Y", strtotime($evento->dta_inicioevento)) }}</td>
		<td>{{ date("H:i:s", strtotime($evento->hora_evento)) }}</td>
		<td>{{ $evento->strobservacao }}</td>
		<td><center><img src="{{ asset('public/assets/img/check.png') }}" width="25%" /></center></td>
	</tr>
	<tr>
		<td colspan="7"></td>
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