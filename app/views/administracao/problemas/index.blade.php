@extends('layouts.layout_foundation')
@section('content')

@if($hide == 'false')
<h2 class="cabecalho"><strong>Cadastrar Problema</strong></h2>
<form method="post" action="{{URL::to('/administracao/problemas/create');}}">
<div class="large-10 large-centered">
	<div class="row">
	<div class="large-6 columns">
		<label><p class="titulo">Problema:</p>
			<select name="problemid" required>
				<option value="" disabled>--- SELECIONE UM PROBLEMA ---</option>
				@foreach($problems as $problem)
				<option value="{{ $problem->intproblemid }}">{{ $problem->strproblema }}</option>
				@endforeach
			</select>
		</label>
	</div>
	</div>
	<div class="row">
	<div class="large-6 columns">
		<label><p class="titulo">Subproblema:</p>
			<input type="text" name="subproblem" placeholder="Especifique o subproblema" required />
		</label>
	</div>
	</div>
	<div class="row large-6 columns">
		<input type="submit" value="Cadastrar" class="button small success" />
		<input type="reset" value="Limpar" class="button small alert" />
	</div>
</div>
</form>
@else
<h2 class="cabecalho"><strong>Editar Problema</strong></h2>
<form method="post" action="{{ URL::to('/administracao/problemas/update'); }}">
<div class="large-10 large-centered">
	<div class="row">
		<div class="large-6 columns">
			<label><p class="titulo">Subproblema:</p>
				<input type="text" name="subproblem" value="{{ $item }}" required />
			</label>
				<input type="hidden" name="problemid" value="{{ $id }}" required />
		</div>
	</div>
	<div class="row large-6 columns">
		<input type="submit" value="Salvar" class="button small success" />
		<input type="button" value="Cancelar" onclick="window.history.back()" class="button small alert" />
	</div>
</div>
</form>
@endif
<hr style="border: .1em solid rgba(0,0,0,.1);" />
<center>
<table style="box-shadow: .25em .25em .5em rgba(0,0,0,.6);">
	<div class="row">
		<thead>
			<tr>
				<th colspan="3"><center>::: PROBLEMAS CADASTRADOS :::</center></th>
			</tr>

			<tr>
				<th>Problema / Subproblema</th>
				<th width="100">Editar</th>
				<th width="100">Excluir</th>
			</tr>
		</thead>

		<tbody>
		<?php $new = ''; $old = ''; ?>
		@foreach($query as $subproblem)
		@if($subproblem->strsubproblema!=null)				
		<tr>
		<?php $new = $subproblem->intproblemid; ?>
			@if(($new!=$old) || ($new==null))
				<th colspan="3"><strong><center>--- {{ $subproblem->strproblema }} ---</center></strong></th>
			@else
				{{ "<tr></tr>" }}
			@endif
		</tr>	
		<tr>
			<td>{{ $subproblem->strsubproblema }}</td>
			<td><center><a href="{{URL::to('/administracao/problemas/data?id='.$subproblem->intsubproblemid.'&item='.$subproblem->strsubproblema);}}"><img src="{{ asset('public/assets/img/edit.png') }}" width="25%" /></a></center></td>
			<td><center><a href="{{URL::to('/administracao/problemas/delete?id='.$subproblem->intsubproblemid);}}" onclick="return confirm('Você tem certeza disto?')"><img src="{{ asset('public/assets/img/delete.png') }}" width="25%" /></a></center></td>
		</tr>
		@endif
		<?php $old = $new; ?>
		<tr>
			<td colspan="3"></td>
		</tr>
		@endforeach
		</tbody>
	</div>
</table>
</center>
</div>
@stop