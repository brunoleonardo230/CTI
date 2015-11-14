@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<form method="post" action="{{URL::to('/chamadosoi/salvarocorrencia');}}">
	<div class="row">
		<div class="large-6 columns">
			<div class="titulo">Data Prevista Antiga:</div>
			<input type="hidden" name="intchamadoid" value="<?=$_GET['id']?>">
				@foreach($select_dtaprevista as $data)
		    		<input type="text" name="dta_previstaantiga" value="{{ date("d/m/Y",strtotime($data->dtaprevisaoencerramento)) }}" readonly="true">
		    	@endforeach
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<div class="titulo">Hora Prevista Antiga:</div>
			@foreach($select_dtaprevista as $data)
				<input type="text" name="horaprevisaoencerramento" value="{{ date("H:i", strtotime($data->horaprevisaoencerramento))}}h" readonly="true">
			@endforeach
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<div class="titulo">Ocorrência</div>
				<textarea name="strocorrenciaoi"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<div class="titulo">Nova Data</div>
				<input type="text" name="dta_previstanova" id="datepicker" required>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<div class="titulo">Nova Hora</div>
				<input type="time" name="horanova" placeholder="Ex: HH:mm">
		</div>
	</div>
	<div class="row">
      <div  class="large-6 columns">
        <input type="submit" value="Salvar Ocorrência" class="button success" />
      </div>
    </div>
</form>
<div class="row">
	<div class="large-12 columns" align="center">
		<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);" width="90%" >
			<thead>
				<tr>
					<th colspan="4"><center>Ocorrência do Chamado</center></th>
				</tr>
				<tr>
					<th>Data/Hora Antiga</th>
					<th>Ocorrência</th>
					<th>Nova Data</th>
					<th>Nova Hora</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($select_ocorrencias){
					foreach($select_ocorrencias as $ocorrencias){
						
					?>
					<tr>
						<td>{{ date("d/m/Y H:i",strtotime($ocorrencias->dta_previstaantiga)) }}h</td>
						<td>{{ $ocorrencias->strocorrenciaoi}}</td>
						<td>{{ date("d/m/Y",strtotime($ocorrencias->dta_previstanova))}}</td>
						<td>{{ date("H:i",strtotime($ocorrencias->dta_previstanova))}}h</td>
					</tr>
					<?php
					}
				}else{
				?>
				<tr>
					<td colspan="4"><p align="center"><strong>Não existe ocorrências para este chamado</strong></p></td>
				</tr>
				<?php
				}		
					?>
			</tbody>
		</table>
	</div>
</div>
@stop