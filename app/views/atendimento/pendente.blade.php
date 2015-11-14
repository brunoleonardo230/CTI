@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<ul class="button-group even-3">
  <li><a href="{{URL::to('/atendimento/atendimentopendente');}}" class="button secondary">Pendente</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoandamento');}}" class="button secondary">Andamento</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoconcluido');}}" class="button secondary">Concluidos</a></li>
</ul>

<div class="row">
  <div class="large-6 columns">
    <a href="{{URL::to('/atendimento');}}" class="button radius">Novo Atendimento</a>
  </div>
</div>

<div class="tabs-content">
	<div class="content active" id="panel1">
		<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
			<thead>
				<tr>
					<th>Protocolo</th>
					<th>Data e Hora da Solicitação</th>
					<th>Prioridade</th>
					<th>Setor</th>
					<th>Tipo Problema</th>
					<th>Sub-Problema</th>
					<th>Funcionário Solicitado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($select_atendimento_pendente as $atendimento)
				<tr>
					<td>{{ $atendimento->intatendimentoid }}</td>
					<td>{{ date("d/m/Y (H:i",strtotime($atendimento->dta_solicitacao)) }}h)</td>
					<td>{{ $atendimento->strprioridade }}</td>
					<td>{{ $atendimento->strsetor }}</td>
					<td>{{ $atendimento->strproblema }}</td>
					<td>{{ $atendimento->strsubproblema }}</td>
					<td>{{ $atendimento->strfuncionario }}</td>
					<td><a href="{{URL::to('/atendimento/atender?id='.$atendimento->intatendimentoid);}}" class="button tiny success" onclick="return confirm('Confirmar Atendimento?')">Atender</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div id="outer">
			<div id="inner">
				<?=$select_atendimento_pendente->links();?>
			</div>
		</div>
	</div>
</div>

@stop