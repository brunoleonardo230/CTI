@extends('layouts.layout_foundation')
@section('content')

@if($hide == 'false')
<h2 ng-hide="editar = {{ $hide }}" class="cabecalho"><strong>Cadastrar Evento</strong></h2>
<form ng-hide="editar = {{ $hide }}" method="post" action="{{URL::to('/eventos/registro/create');}}">
<div class="large-12 columns">
	<div class="large-6 columns">
		<label><p class="titulo">Funcionários(as):</p>
			<select name="funcid" required>
				<option value="" disabled>--- SELECIONAR FUNCIONÁRIO(A) ---</option>
				@foreach($funcionarios as $funcionario)
				<option value="{{ $funcionario->intfuncionarioid }}">{{ $funcionario->strfuncionario }}</option>
				@endforeach
			</select>
		</label>
	</div>

	<div class="large-6 columns">
		<label><p class="titulo">Evento:</p>
			<input type="text" name="evento" placeholder="Nome do Evento" required />
		</label>
	</div>

	<div class="large-6 columns">
		<label><p class="titulo">Local:</p>
			<input type="text" name="local" placeholder="Local do Evento" required />
		</label>
	</div>

	<div class="large-3 columns">
		<label><p class="titulo">Data:</p>
			<input type="text" name="data" id="datepicker" required />
		</label>
	</div>

	<div class="large-3 columns">
		<label><p class="titulo">Hora:</p>
			<input type="time" name="hora" id="campoHora" required />
		</label>
	</div>

	<div class="large-12 columns">
		<input type="submit" value="Registrar" class="button small success" />
		<input type="reset" value="Limpar" class="button small alert" />
	</div>
</div>
</form>
@else
<h2 ng-show="editar = {{ $hide }}" class="cabecalho"><strong>Editar Evento</strong></h2>
<form ng-show="editar = {{ $hide }}" method="post" action="{{ URL::to('/eventos/registro/update'); }}">
<div class="large-12 columns">
	<div class="large-6 columns">
		<label><p class="titulo">Funcionário(a):</p>
			<select name="funcid" required>
				<option value="{{ $funcid }}" selected="selected">{{ $func }}</option>
				@foreach($funcionarios as $funcionario)
				<option value="{{ $funcionario->intfuncionarioid }}">{{ $funcionario->strfuncionario }}</option>
				@endforeach
			</select>
		</label>
	</div>

	<div class="large-6 columns">
		<label><p class="titulo">Evento:</p>
			<input type="text" name="evento" value="{{ $evento }}" required />
		</label>
	</div>

	<div class="large-6 columns">
		<label><p class="titulo">Local:</p>
			<input type="text" name="local" value="{{ $local }}" required />
		</label>
	</div>

	<div class="large-3 columns">
		<label><p class="titulo">Data:</p>
			<input type="text" name="data" id="datepicker" value="{{ $data }}" required />
		</label>
	</div>

	<div class="large-3 columns">
		<label><p class="titulo">Hora:</p>
			<input type="time" name="hora" value="{{ $hora }}" required />
		</label>
	</div>

	<div class="large-6 columns">
		<label><p class="titulo">Observaçõs:</p>
			<textarea name="obs" />{{ $observacao }}</textarea>
		</label>
	</div>

	<div class="large-6 columns">
			<label><p class="titulo">Finalizar Evento?</p></label>
			<label>
				<input type="radio" id="finalizar" name="finalizar" value="s" /> Sim
			</label>
			<label>
				<input type="radio" id="finalizar" name="finalizar" value="n" checked /> Não 
			</label>
		</div>

	<div class="large-12 columns">
		<input type="hidden" name="eventoid" value="{{ $id }}" required />
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
			<th colspan="8"><center>::: EVENTOS EM ABERTO :::</center></th>
		</tr>

		<tr>
			<th width="100">Evento</th>
			<th width="100">Funcionário(a)</th>
			<th width="100">Local</th>
			<th width="100">Data</th>
			<th width="100">Hora</th>
			<th width="150">Observações</th>
			<th width="100">Editar / Finalizar</th>
			<th width="100">Excluir</th>
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
		<td><center><a href="{{ URL::to('/eventos/registro/data?id='.$evento->inteventoid.'&evento='.$evento->strevento.'&funcid='.$evento->intfuncionarioid.'&local='.$evento->strlocalevento.'&data='.$evento->dta_inicioevento.'&hora='.$evento->hora_evento.'&func='.$evento->strfuncionario.'&obser='.$evento->strobservacao);}}"><img src="{{ asset('public/assets/img/edit.png') }}" width="25%" /></a></center></td>
		<td><center><a href="{{ URL::to('/eventos/registro/delete?id='.$evento->inteventoid);}}" onclick="return confirm('Você tem certeza disto?')"><img src="{{ asset('public/assets/img/delete.png') }}" width="25%" /></a></center></td>
	</tr>
	<tr>
		<td colspan="8"></td>
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
</div>
@stop