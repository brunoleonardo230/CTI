@extends('layouts.layout_foundation')
@section('content')

@if($hide == 'false')
<h2 class="cabecalho"><strong>Cadastrar Computadores</strong></h2>
<form method="post" action="{{URL::to('/administracao/computadores/create');}}">
	<div class="large-10 large-centered">
		<div class="row">
			<div class="large-6 columns">
				<label><p class="titulo">Polo:</p>
					<select name="poloid" required>
						<option value="" disabled>--- SELECIONE UM POLO ---</option>
						@foreach($polos as $polo)
							<option value="{{ $polo->intpoloid }}">{{ $polo->strpolo }}</option>
						@endforeach
					</select>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				<label><p class="titulo">Computador:</p>
					<input type="text" name="cpu" placeholder="Nome do Computador" required />
				</label>
			</div>
		</div>
		<div class="row large-4 columns">
			<input type="submit" value="Cadastrar" class="button small success" />
			<input type="reset" value="Limpar" class="button small alert" />
		</div>
	</div>
</form>
@else
<h2 class="cabecalho"><strong>Editar Computadores</strong></h2>
<form method="post" action="{{URL::to('/administracao/computadores/update');}}">
	<div class="large-10 large-centered">
		<div class="row">
			<div class="large-6 columns">
				<label><p class="titulo">Computador:</p>
					<input type="text" name="cpu" value="{{ $item }}" required />
				</label>
					<input type="hidden" name="cpuid" value="{{ $id }}" required />
			</div>
		</div>
		<div class="row large-4 columns">
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
				<th colspan="4"><center>::: COMPUTADORES CADASTRADOS :::</center></th>
			</tr>

			<tr>
				<th colspan="2">Polo / Computador</th>
				<th width="120">Editar</th>
				<th width="120">Excluir</th>
			</tr>
		</thead>

		<tbody>
		<?php $new = ''; $old = ''; ?>
		@foreach($query as $cpu)
		@if($cpu->strnomecpu!=null)
			<tr>
			<?php $new = $cpu->intpoloid; ?>
				@if(($new!=$old) || ($new==null))
					<th colspan="4"><strong><center>--- {{ $cpu->strpolo }} ---</center></strong></th>
				@else
					{{ "<tr></tr>" }}
				@endif
			</tr>	
			<tr>
				<td colspan="2">{{ $cpu->strnomecpu }}</td>
				<td><center><a href="{{URL::to('/administracao/computadores/data?id='.$cpu->idcpu.'&item='.$cpu->strnomecpu);}}"><img src="{{ asset('public/assets/img/edit.png') }}" width="25%" /></a></center></td>
				<td><center><a href="{{URL::to('/administracao/computadores/delete?id='.$cpu->idcpu);}}" onclick="return confirm('Você tem certeza disto?')"><img src="{{ asset('public/assets/img/delete.png') }}" width="25%" /></a></center></td>
			</tr>
		@endif
		<?php $old = $new; ?>
		<tr>
			<td colspan="4"></td>
		</tr>
		@endforeach
		</tbody>
	</div>
</table>
</center>
</div>
@stop