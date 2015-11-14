@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<ul class="button-group even-3">
  <li><a href="{{URL::to('/atendimento/atendimentopendente');}}" class="button secondary">Pendente</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoandamento');}}" class="button secondary">Andamento</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoconcluido');}}" class="button secondary">Concluidos</a></li>
</ul>	

 <center>
  	<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
  	<div class="row">
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
		@foreach($select_atendimento_concluidos as $atendimento)
			<tr>
				<td>{{ $atendimento->intatendimentoid }}</td>
				<td>{{ date("d/m/Y (H:i",strtotime($atendimento->dta_solicitacao)) }}h)</td>
				<td>{{ $atendimento->strprioridade }}</td>
				<td>{{ $atendimento->strsetor }}</td>
				<td>{{ $atendimento->strproblema }}</td>
				<td>{{ $atendimento->strsubproblema }}</td>
				<td>{{ $atendimento->strfuncionario }}</td>
				<td width="9%"><a href="#" onclick="laudo(<?=$atendimento->intatendimentoid?>)">Ver Laudo</a></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td colspan="4">
					<div id="<?=$atendimento->intatendimentoid?>" style="display:none;">
						<div class="panel radius">
						<table width="100%">
							<thead>
								<tr>
									<th>Atendimento por telefone?</th>
									<th><?php if($atendimento->bolatendimentotelefone == 1){ echo "SIM"; }else{ echo "NÃO";} ?></th>
								</tr>
								<tr>
									<th>Atendimento remoto?</th>
									<th><?php if($atendimento->bolatendimentoremoto == 1){ echo "SIM"; }else{ echo "NÃO";} ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2"><strong><center>Laudo Técnico</center></strong></td>
								</tr>
								<tr>
									<td colspan="2">{{ $atendimento->strlaudo_atend }}</td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
			</tr>
		@endforeach
		</tbody>
		</div>
	</table>
</center>
	<div id="outer">
		<div id="inner">
			<?=$select_atendimento_concluidos->links();?>
		</div>
	</div>

<script type="text/javascript">
var isOpen = false;	
function laudo(id)
{
	//document.getElementById(id).style.display = "block";

	if(isOpen)
	{
		document.getElementById(id).style.display = "none";
	
	}
	else
	{
		document.getElementById(id).style.display = "block";
	}
	isOpen = !isOpen;
}

</script>
@stop