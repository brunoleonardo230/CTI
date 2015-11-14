@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<?php
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if($msg == 1){
			echo '<div data-alert class="alert-box success radius">
				  ATENDIMENTO FINALIZADO COM SUCESSO.
				  <a href="#" class="close">&times;</a>
				  </div>';
		}
	}
?>

<ul class="button-group even-3">
  <li><a href="{{URL::to('/atendimento/atendimentopendente');}}" class="button secondary">Pendente</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoandamento');}}" class="button secondary">Andamento</a></li>
  <li><a href="{{URL::to('/atendimento/atendimentoconcluido');}}" class="button secondary">Concluidos</a></li>
</ul>

<div class="row">
  <div class="large-12 columns">     
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
		@foreach($select_atendimento_andamento as $atendimento)
			<tr>
				<td>{{ $atendimento->intatendimentoid }}</td>
				<td>{{ date("d/m/Y (H:i",strtotime($atendimento->dta_solicitacao)) }}h)</td>
				<td>{{ $atendimento->strprioridade }}</td>
				<td>{{ $atendimento->strsetor }}</td>
				<td>{{ $atendimento->strproblema }}</td>
				<td>{{ $atendimento->strsubproblema }}</td>
				<td>{{ $atendimento->strfuncionario }}</td>
				<td><a href="#" onclick="finalizar(<?=$atendimento->intatendimentoid?>)" class="button tiny success">Finalizar</a></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td colspan="3">
					<div id="<?=$atendimento->intatendimentoid?>" style="display:none;">
					<form method="post" action="{{URL::to('/atendimento/finalizar');}}">
						<input type="hidden" name="intatendimentoid" value="<?=$atendimento->intatendimentoid?>">
						<div>
						<label>Atendimento Remoto?</label>
						<input type="radio" name="bolatendimentoremoto" value="1"> Sim
						<input type="radio" name="bolatendimentoremoto" value="0" checked="checked"> Não
						</div>
						<div>
						<label>Atendimento por Telefone?</label>
						<input type="radio" name="bolatendimentotelefone" value="1"> Sim
						<input type="radio" name="bolatendimentotelefone" value="0" checked="checked"> Não
						</div>
						<label>Laudo Técnico</label>
						<textarea name="laudo" rows="5" required></textarea>
						<input id="button" class="button radius" value="Finalizar" type="submit">
					</form>
					</div>
				</td>
				<td></td>
				<td></td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div id="outer">
		<div id="inner">
			<?=$select_atendimento_andamento->links();?>
		</div>
	</div>

  </div>
</div>
<script type="text/javascript">
	
	function finalizar(id)
{
	document.getElementById(id).style.display = "block";
}

</script>
@stop