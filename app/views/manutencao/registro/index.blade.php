@extends('layouts.layout_foundation')
@section('content')

<div ng-controller="RequiredCtrl">

@if($hide == 'false')
<h2 class="cabecalho"><strong>Registrar Manutenção</strong></h2>
<form method="post" action="{{URL::to('/manutencao/registro/create');}}">
	<div class="large-12 columns">
		<div class="row">
			<div class="large-6 columns">
				<label><p class="titulo">Polo:</p>
					<select name="poloid" id="intpoloid" required>
						<option value="" disabled>--- SELECIONE UM POLO ---</option>
						@foreach($polos as $polo)
						<option onclick="selectPolo();" ng-click="select = true; id = {{ $polo->intpoloid }}" value="{{ $polo->intpoloid }}">{{ $polo->strpolo }}</option>
						@endforeach
					</select>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<label><p class="titulo">Computador:</p>
					<select name="cpuid" required>
						<option value="" disabled>--- SELECIONE UM COMPUTADOR ---</option>
						<span ng-if="select == true">
						<?php $id = ;?>[[ poloid ]]
						@foreach($cpus as $cpu)
						@if($cpu->intpoloid == $id)
						<option value="{{ $cpu->idcpu }}">{{ $cpu->strnomecpu }}</option>
						@endif
						@endforeach
						<span>
						<span ng-if="select != true"></span>
					</select>
				</label>
			</div>
		</div>

		<!--<div class="large-6 columns">            
        	<label><p class="titulo">Funcionário(a) para Atendimento:</p>
				<select name="funcid" required>
				<option value="" disabled>--- SELECIONE UM FUNCIONÁRIO(A) ---</option>
				  @foreach($funcionarios as $func)
				      <option value="{{ $func->intfuncionarioid }}">{{ $func->strfuncionario }}</option>
					@endforeach
				</select>
			</label>
		</div>-->

		<div class="row">
			<div class="large-12 columns">
				<input type="submit" value="Registrar" class="button small success" />
				<input type="reset" value="Limpar" class="button small alert" />
			</div>
		</div>
	</div>
</form>
@else
<h2 class="cabecalho"><strong>Editar Manutenção</strong></h2>
<form method="post" action="{{URL::to('/manutencao/registro/update');}}">
	<div class="large-12 columns">
		<div class="large-6 columns">
			<label><p class="titulo">Polo:</p>
				<select name="poloid" required>
					<option value="{{ $poloid }}" selected>{{ $polo }}</option>
					@foreach($polos as $polo)
					<option value="{{ $polo->intpoloid }}">{{ $polo->strpolo }}</option>
					@endforeach
				</select>
			</label>
		</div>

		<div class="large-6 columns">
			<label><p class="titulo">Computador:</p>
				<select name="cpuid" required>
					<option value="{{ $cpuid }}" selected>{{ $cpu }}</option>
					@foreach($cpus as $cpu)
					<option value="{{ $cpu->idcpu }}">{{ $cpu->strnomecpu }}</option>
					@endforeach
				</select>
			</label>
		</div>

		<!--<div class="large-6 columns">            
        	<label><p class="titulo">Funcionário(a) para Atendimento:</p>
				<select name="funcid" required>
				<option value="funcid" selected>{{ $func }}</option>
				  @foreach($funcionarios as $func)
				      <option value="{{ $func->intfuncionarioid }}">{{ $func->strfuncionario }}</option>
					@endforeach
				</select>
			</label>
		</div>-->

		<div class="large-3 columns" ng-model="checked" ng-init="checked={{ $show }}">
			<label><p class="titulo">Equipamento Recolhido?</p></label>
			<label>
				<input type="radio" id="recolhido" name="recolhido" value="s" ng-click="checked=true; required=required" @if($check == 1) checked @endif /> Sim
			</label>
			<label>
				<input type="radio" id="recolhido" name="recolhido" value="n" ng-click="checked=false; required= ' '" @if($check == 0) checked @endif /> Não
			</label>
		</div>

		<div class="large-3 columns">
			<label><p class="titulo">Finalizar Manutenção?</p></label>
			<label>
				<input type="radio" id="finalizar" name="finalizar" value="s" /> Sim
			</label>
			<label>
				<input type="radio" id="finalizar" name="finalizar" value="n" checked /> Não
			</label>
		</div>

	    <div class="large-6 columns">
			<label><p class="titulo">Laudo:</p>
				<textarea name="obs" />{{ $observacao }}</textarea>
			</label>
		</div>

		<div ng-if="checked">
			<div class="large-6 columns">
				<label><p class="titulo">Problemas:</p>
					<select name="problem" [[ required ]]>
						<option value="" disabled>--- SELECIONE UM PROBLEMA ---</option>
						@foreach($problems as $problem)
						<option value="{{ $problem->intproblemid }}">{{ $problem->strproblem }}</option>
						@endforeach
					</select>
				</label>
			</div>

			<div class="large-6 columns">
				<label><p class="titulo">Subproblemas:</p>
					<select name="subproblem" <% required %>>
						<option value="" disabled>--- SELECIONE UM SUBPROBLEMA ---</option>
						@foreach($subproblems as $subproblem)
						<option value="{{ $subproblem->intsubproblemid }}">{{ $subproblem->strsubproblem }}</option>
						@endforeach
					</select>
				</label>
			</div>
		</div>

		<div class="large-12 columns">
			<input type="hidden" name="manutencaoid" value="{{ $id }}" required />
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
			<th colspan="7"><center>::: MANUTENÇÕES EM ABERTO :::</center></th>
		</tr>

		<tr>
			<th width="100">Data da Manutenção</th>
			<th width="100">Polo</th>
			<th width="100">Computador</th>
			<th width="100">Responsavel pela Manutenção</th>
			<th width="200">Laudo</th>
			<th width="100">Editar / Finalizar</th>
			<th width="100">Excluir</th>
		</tr>
	</thead>

	<tbody>
	@foreach($query as $data)
	<tr>
		<td>{{ date("d/m/Y", strtotime($data->dta_manutencao)) }}</td>
		<td>{{ $data->strpolo }}</td>
		<td>{{ $data->strnomecpu }}</td>
		<td>{{ $data->strfuncionario }}</td>
		<td>{{ $data->laudo_manutencao }}</td>
		<td><center><a href="{{ URL::to('/manutencao/registro/data?id='.$data->intmanutencaopreventivaid.'&poloid='.$data->intpoloid.'&polo='.$data->strpolo.'&cpuid='.$data->idcpu.'&cpu='.$data->strnomecpu.'&funcid='.$data->intfuncionarioid.'&func='.$data->strfuncionario.'&obs='.$data->laudo_manutencao.'&check='.$data->bolrecolhido);}}"><img src="{{ asset('public/assets/img/edit.png') }}" width="25%" /></a></center></td>
		<td><center><a href="{{ URL::to('/manutencao/registro/delete?id='.$data->intmanutencaopreventivaid);}}" onclick="return confirm('Você tem certeza disto?')"><img src="{{ asset('public/assets/img/delete.png') }}" width="25%" /></a></center></td>
	</tr>
	<tr>
		<td colspan="7"></td>
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
<script>
	function selectPolo() {

		var id = getElementById('intpoloid').value;

		var url = ("{{URL::to('/manutencao/registro/selectCpuAjax');}}/"+id);
		alert(url);

		load_page(url,"","cpu");

	}
</script>
@stop