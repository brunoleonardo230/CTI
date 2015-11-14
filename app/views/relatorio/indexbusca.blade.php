@extends('layouts.layout_foundation')
@section('content')

<h2 class="cabecalho">{{$title}}</h2>

<form method="post" action="{{URL::to('/relatorio/buscar_atendimento');}}">
	<div class="row">
		<div class="large-4 columns" align="right">
			Núcleo:
		</div>
		<div class="large-4 columns">
			<select name="intpoloid" required>
				<option>--selecione o polo--</option>
				@foreach($select_polo as $row)
				<option value="{{$row->intpoloid }}" onclick="adicionar_setor({{$row->intpoloid }})">{{$row->strpolo}}</option>
				@endforeach
			</select>
		</div>
		<div class="large-4 columns">

		</div>
	</div>

	<div id="div_setor" style="display=none"></div>

	<div class="row">
		<div class="large-4 columns" align="right">Problema</div>
		<div class="large-4 columns">
			<select>
				@foreach($select_problema as $row)
					<option value="{{$row->intproblemid}}" onclick="adicionar_subproblema({{$row->intproblemid}})">{{$row->strproblem}}</option>
				@endforeach
			</select>
		</div>
		<div class="large-4 columns"></div>
	</div>

	<div id="div_subproblema" style="display=none"></div>

	<div class="row">
		<div class="large-4 columns" align="right">Funcionário que Atendeu</div>
		<div class="large-4 columns">
			<select>
				<option></option>
			</select>
		</div>
		<div class="large-4 columns"></div>
	</div>

	<div class="row">
		<div class="large-4 columns" align="right">Data Inicial</div>
		<div class="large-4 columns"><input type="text" name="dtainicial" id="datepicker" required /></div>
		<div class="large-4 columns"></div>
	</div>
	<div class="row">
		<div class="large-4 columns" align="right">Data Final</div>
		<div class="large-4 columns"><input type="text" name="dtafinal" id="datepicker1" required /></div>
		<div class="large-4 columns"></div>
	</div>
	<div class="row">
		<div class="large-4 columns">&nbsp;</div>
		<div class="large-4 columns">
			<input id="button" class="button radius success" value="Buscar" type="submit">
			<input value="Limpar" class="button radius alert" type="reset">
		</div>
		<div class="large-4 columns"></div>
    </div>

</form>


@if(isset($select_busca))
	<div class="row">
		<div class="large-4 columns"></div>
		<div class="large-4 columns">
		@foreach($select_busca as $row)
			<table>
				<caption>SETOR: {{$row->strproblem}}</caption>
				<thead>
					<tr>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr></tr>
					<tr></tr>
				</tbody>
			</table>
		@endforeach
		</div>
		<div class="large-4 columns"></div>
	</div>
@endif



<script>
function adicionar_setor(id)
{
	load_page("{{URL::to('/relatorio/select_setor_ajax');}}/"+id,"","div_setor");
		
}

function adicionar_subproblema(idsub)
{
	load_page("{{URL::to('/relatorio/select_subproblema_ajax');}}/"+idsub,"","div_subproblema");
		
}
</script>

@stop