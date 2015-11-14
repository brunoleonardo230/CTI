@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<div class="row">
  <div class="large-6 columns">
    <a href="{{URL::to('/chamadosoi');}}" class="button radius">Novo Chamado</a>
  </div>
</div>

<div class="row">
	<div class="large-12 columns">
		<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
			<thead>
				<tr>
					<th colspan="8"><center>CHAMADOS ABERTOS</center></th>
				</tr>
				<tr>
					<th>Protocolo</th>
					<th>Data e Hora da Solicitação</th>
					<th>Polo</th>
					<th>Solicitante</th>
					<th>Previsão encerramento</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($select_chamados_abertos as $chamados_abertos)
				<tr>
					<td>{{ $chamados_abertos->strprotocolo }}</td>
					<td>{{ date("d/m/Y (H:i",strtotime($chamados_abertos->dtaabertura)) }}h)</td>
					<td>{{ $chamados_abertos->strpolo }}</td>
					<td>{{ $chamados_abertos->strsolicitante }}</td>
					<td>{{ date("d/m/Y", strtotime($chamados_abertos->dtaprevisaoencerramento)) }}<br>{{ date("(H:i", strtotime($chamados_abertos->horaprevisaoencerramento)) }}h)</td>
					<td><a href="{{URL::to('/chamadosoi/editar?id='.$chamados_abertos->intchamadoid) }}" class="button success tiny"> Editar</a></td>
					<td><a href="{{URL::to('/chamadosoi/ocorrencia?id='.$chamados_abertos->intchamadoid) }}" class="button warning tiny">Ocorrência</a></td>
					<td><a href="{{URL::to('/chamadosoi/finalizarchamado?id='.$chamados_abertos->intchamadoid) }}" class="button alert tiny" onclick="return confirm('Confirmar Fechamento do Chamado?')">Finalizar</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div id="outer">
			<div id="inner">
				<?=$select_chamados_abertos->links();?>
			</div>
		</div>
	</div>
</div>

@stop