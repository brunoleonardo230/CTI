@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho"><strong>Avisos</strong></h2>

<div class="medium-uncollapse large-collapse">

<div class="small-6 columns">
<h2 class="titulo"><strong>Eventos</strong></h2>
<hr class="bar" />

<div class="scroll">
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<thead>
		<tr>
    		<th>Data / hora</th>
    		<th>Evento</th>
    		<th>Local</th>
    		<th>Funcionario</th>
    	</tr>
	</thead>

	<tbody>
	@foreach($eventos as $evento)
	<tr>
		<td>{{ date("d/m/Y", strtotime($evento->dta_inicioevento)) }} <br /> {{ date("H:i:s", strtotime($evento->hora_evento)) }}</td>
		<td>{{ $evento->strevento }}</td>
		<td>{{ $evento->strlocalevento }}</td>
		<td>{{ $evento->strfuncionario }}</td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>
</div>

<div class="small-6 columns">
<h2 class="titulo"><strong>Chamados da OI em Aberto</strong></h2>
<hr class="bar" />

<div class="scroll">
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<thead>
		<tr>
    		<th>Data / Hora</th>
    		<th>Polo</th>
    		<th>Solicitante</th>
    		<th>Previsão de Encerramento</th>	
    	</tr>
	</thead>

	<tbody>
	@foreach($chamados as $chamado)
	<tr>
		<td>{{ date("d/m/Y H:i",strtotime($chamado->dtaabertura)) }}</td>
		<td>{{ $chamado->strpolo }}</td>
		<td>{{ $chamado->strsolicitante }}</td>
		<td>{{ date("d/m/Y", strtotime($chamado->dtaprevisaoencerramento)) }}<br>{{ date("H:i", strtotime($chamado->horaprevisaoencerramento)) }}</td>
	</tr>
	@endforeach		
	</tbody>
</table>
</div>
</div>

<hr style="border: rgba(0,0,0,0);" />
<br />

<h2 class="titulo"><strong>Atendimentos Pendentes ou Não Finalizados</strong></h2>
<hr class="bar" />

<div class="scroll">
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<thead>
		<tr>
    		<th>Data / hora</th>
    		<th>Setor</th>
    		<th>Problema / Subproblema</th>
    		<th>Funcionário</th>
    	</tr>
	</thead>

	<tbody>
	@foreach($atendimentos as $atendimento)
	<tr>
		<td>{{ date("d/m/Y H:i",strtotime($atendimento->dta_solicitacao)) }}</td>
		<td>{{ $atendimento->strsetor }}</td>
		<td>{{ $atendimento->strproblema }} / {{ $atendimento->strsubproblema }}</td>
		<td>{{ $atendimento->strfuncionario }}</td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>
</div>
<hr style="border: 1em rgba(0,0,0,0);" />
@stop