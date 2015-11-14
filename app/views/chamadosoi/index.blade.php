@extends('layouts.layout_foundation')
@section('content')

<?php
if(isset($select_chamado)){
?>

<h2 class="cabecalho">{{$title}}</h2>

<form method="post" action="{{URL::to('/chamadosoi/salvareditar');}}">
    @foreach($select_chamado as $chamado)
    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Data abertura:</div>
        <input type="text" name="dtaabertura" value=" {{ date("d/m/Y (H:i:s)",strtotime($chamado->dtaabertura)) }}" readonly="true">
        <input type="hidden" name="intchamadoid" value="{{$chamado->intchamadoid}}">
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">    
        <div class="titulo">Polo:</div>
          <select required name="strpolo">
            @foreach($select_polo as $polo)
              <?php
              $new = $polo->intpoloid; 
                if($polo->intpoloid == $chamado->strpolo){
                  $selected= 'selected="select"';
                }else{
                  $selected= '';
                }
              ?>
                <option value="{{ $polo->intpoloid }}" <?=$selected?> > {{ strtoupper($polo->strpolo) }}</option>
            @endforeach
          </select>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Solicitante:</div>
          <input type="text" name="strsolicitante" placeholder="Funcionário solicitante" value="{{ $chamado->strsolicitante }}" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Nº Protocolo:</div>
          <input type="text" name="strprotocolo" placeholder="Número de protocolo" value="{{ $chamado->strprotocolo }}" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Data prevista do encerramento:</div>
          <input type="text" name="dtaprevisaoencerramento" readonly="true" placeholder="Inserir data prevista para encerramento Ex:(dd/mm/yyyy)" value="{{ date("d/m/Y",strtotime($chamado->dtaprevisaoencerramento)) }}" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Hora prevista do encerramento:</div>
          <input type="text" name="horaprevisaoencerramento" readonly="true" placeholder="Inserir hora prevista para encerramento Ex:(hh:mm)" value="{{ $chamado->horaprevisaoencerramento }}" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Descrição:</div>
          <textarea placeholder="Descrição do prolema" name="descricao">{{ $chamado->descricao }}</textarea>
      </div>  
    </div>
    
    <div class="row">
      <div  class="large-6 columns">
        <input type="submit" value="Editar Chamado" class="button success" />
      </div>
    </div>
    @endforeach
</form>

<?php
}else{
?>

<h2 class="cabecalho">{{$title}}</h2>

<form method="post" action="{{URL::to('/chamadosoi/salvarchamado');}}">
    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Data abertura:</div>
        <input type="text" name="dtaabertura" value=" {{ date('d/m/Y H:i:s')}}" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">    
        <div class="titulo">Polo:</div>
          <select required name="strpolo">
            @foreach($select_polo as $polo)
              <?php $new = $polo->intpoloid; ?>
                <option value="{{ $polo->intpoloid }}">{{ strtoupper($polo->strpolo) }}</option>
            @endforeach
          </select>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Solicitante:</div>
          <input type="text" name="strsolicitante" placeholder="Funcionário solicitante" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Nº Protocolo:</div>
          <input type="text" name="strprotocolo" placeholder="Número de protocolo" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Data prevista do encerramento:</div>
          <input type="text" name="dtaprevisaoencerramento" id="datepicker" required />
          
      </div>  
    </div>
    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Hora prevista do encerramento:</div>
          <input type="time" name="horaprevisaoencerramento" placeholder="Inserir hora prevista para encerramento Ex:(hh:mm)" required>
      </div>  
    </div>

    <div class="row">
      <div class="large-6 columns">            
        <div class="titulo">Descrição:</div>
          <textarea placeholder="Descrição do prolema" name="descricao"></textarea>
      </div>  
    </div>
    
    <div class="row">
      <div  class="large-6 columns">
        <input type="submit" value="Abrir Chamado" class="button success" />
      </div>
    </div>
</form>

<?php
}
?> 


@stop