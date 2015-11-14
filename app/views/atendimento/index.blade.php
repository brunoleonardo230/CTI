@extends('layouts.layout_foundation')
@section('content')
<h2 class="cabecalho">Registro de Atendimento</h2>


<form method="post" action="{{URL::to('/atendimento/create');}}">
    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Escolher Funcionário para Atendimento:</div>
          <select required name="intfuncionario_solicitadoid">
            <option value="" disabled>--- SELECIONE UM FUNCIONÁRIO ---</option>
              @foreach($select_funcionario as $func)
                <?php $new = $func->strfuncionario; ?>
                  <option value="{{ $func->intfuncionarioid }}">{{ $func->strfuncionario }}</option>
            @endforeach
          </select>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">    
        <div class="titulo">Problema:</div>
          <select required name="intproblemid">
            <option value="" disabled>--- SELECIONE UM PROBLEMA ---</option>
            @foreach($select_problemas as $problem)
              <?php $new = $problem->intproblemid; ?>
                <option value="{{ $problem->intproblemid }}">{{ $problem->strproblema }}</option>
            @endforeach
          </select>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">   
        <div class="titulo">Subproblema:</div>
          <select required name="intsubproblemid">
            <option value="" disabled>--- SELECIONE UM SUBPROBLEMA ---</option>
            @foreach($select_subproblemas as $subproblem)
              <?php $new = $subproblem->intsubproblemid; ?>
                <option value="{{ $subproblem->intsubproblemid }}">{{ $subproblem->strsubproblema }}</option>
            @endforeach
          </select>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">     
        <div class="titulo">Setor:</div>         
          <select required name="intsetorid">
            <option value="" disabled>--- SELECIONE UM SETOR ---</option>
            @foreach($select_setor as $setor)
              <?php $new = $setor->intsetorid; ?>
                <option value="{{ $setor->intsetorid }}">{{ $setor->strsetor }}</option>
            @endforeach
          </select>
      </div>
    </div>

    <div class="row">
      <div class="large-6 columns">    
        <div class="titulo">Funcionario Solicitante:</div>
          <select required name="intfuncionario_solic_id">
            <option value="" disabled>--- SELECIONE UM FUNCIONÁRIO ---</option>
              @foreach($select_funcionario as $func)
                <?php $new = $func->strfuncionario; ?>
                  <option value="{{ $func->intfuncionarioid }}">{{ $func->strfuncionario }}</option>
            @endforeach
          </select>            
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">
        <div class="titulo">Tipo de Priodidade:</div>
          <input type="radio" name="intprioridadeatendimentoid" value="1" id="prioridadeUrgente"><label for="prioridadeUrgente">Urgente</label>
          <input type="radio" name="intprioridadeatendimentoid" value="2" id="prioridadeImportante"><label for="prioridadeImportante">Importante</label>
          <input type="radio" name="intprioridadeatendimentoid" value="3" id="prioridadeNormal" checked="checked"><label for="prioridadeNormal">Normal</label>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="large-6 columns">
        <input id="button" class="button radius success" value="Cadastrar" type="submit">
        <input value="Limpar" class="button radius alert" type="reset">
      </div>
    </div>
  
</form>
    
@stop