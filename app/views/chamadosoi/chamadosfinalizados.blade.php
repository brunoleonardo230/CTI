@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>
	

 <center>
  	<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
  	<div class="row">
		<thead>
			<tr>
				<th colspan="6"><center>CHAMADOS FINALIZADOS</center></th>
			</tr>
			<tr>
				<th>Protocolo</th>
				<th>Data e Hora da Solicitação</th>
				<th>Polo</th>
				<th>Solicitante</th>
				<th>Data e Hora encerramento</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($select_chamados_finalizados as $finalizados)
			<tr>
				<td>{{ $finalizados->strprotocolo }}</td>
				<td>{{ date("d/m/Y (H:i",strtotime($finalizados->dtaabertura)) }}h)</td>
				<td>{{ $finalizados->strpolo }}</td>
				<td>{{ $finalizados->strsolicitante }}</td>
				<td>{{ date("d/m/Y (H:i",strtotime($finalizados->dtaencerramento)) }}h)</td>
				<td width="9%">
					@foreach($select_intchamadoid as $chamado)
						@if($finalizados->intchamadoid == $chamado->intchamadoid)
							<a href="javascript:ocorrencias(<?=$finalizados->intchamadoid?>)" > Ocorrências</a>
						@endif
					@endforeach
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<div id="<?=$finalizados->intchamadoid?>" style="display:none;">
						<div class="panel radius">
							<table width="100%">
								<thead>
									<tr>
										<td>Data/Hora Antiga</td>
										<td>Ocorrência</td>
										<td>Data/Hora Nova</td>
									</tr>
								</thead>
								<tbody>
									@foreach($select_ocorrencias as $ocorrencias)
										@if($finalizados->intchamadoid == $ocorrencias->intchamadoid)
											<tr>
												<td>{{ date("d/m/Y (H:i",strtotime($ocorrencias->dta_previstaantiga)) }}h)</td>
												<td>{{ $ocorrencias->strocorrenciaoi}}</td>
												<td>{{ date("d/m/Y (H:i",strtotime($ocorrencias->dta_previstanova)) }}h)</td>
											</tr>
									  	@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
		</div>
	</table>
</center>

	<div id="outer">
		<div id="inner">
			<?=$select_chamados_finalizados->links();?>
		</div>
	</div>

<script>
var isOpen = false;	
function ocorrencias(id)
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