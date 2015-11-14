<?
header("Content-type: text/html; charset=iso-8859-1");	
class Calendario
{
	private $dtadia_ent; 
	private $dtames_ent;  
	private $dtaano_ent;
	private $id;

	private $mes;

	function __construct($id)
	{
		$this->id = $id;
		$this->mes = array('JANEIRO', 'FEVEREIRO', 'MAR&Ccedil;O', 'ABRIL', 'MAIO', 'JUNHO', 'JULHO', 'AGOSTO', 'SETEMBRO', 'OUTUBRO', 'NOVEMBRO', 'DEZEMBRO');
		$this->dtadia_ent = date("d");
		$this->dtames_ent = date("m");
		$this->dtaano_ent = date("Y");
?>
<div id="<?=$id?>Calend_div">

<?="id=".$id?>
<input type="hidden" id="<?=$id?>" name="<?=$id?>" value="<?=$this->dtaano_ent?>-<?=$this->dtames_ent?>-<?=$this->dtadia_ent?>"  >
<select name="<?=$id?>dtadia" id="<?=$id?>dtadia" onchange="data_selecionada('<?=$id?>')" >
	<? for($intdia = 1; $intdia <= 31; $intdia++) { 

?><option value="<? if($intdia < 10) { echo('0'.$intdia); } else { echo ($intdia); } ?>"<? if($intdia == $this->dtadia_ent ){ ?> selected="selected" <? } ?>  ><?=$intdia?></option> <? } ?> 
</select>

<select name="<?=$id?>dtames" id="<?=$id?>dtames" onchange="data_selecionada('<?=$id?>')" >
	<? for($intmes = 1; $intmes <= 12; $intmes++) { ?><option value="<? if($intmes < 10) { echo('0'.$intmes); } else { echo ($intmes); } ?>" <? if($intmes == $this->dtames_ent ){ ?> selected="selected" <? } ?> ><?=$this->mes[$intmes-1]?></option> <? } ?>
</select>

<select name="<?=$id?>dtaano" id="<?=$id?>dtaano" onchange="data_selecionada('<?=$id?>')">
	<? for($intano = 1900; $intano <= 2020; $intano++) { ?><option value="<?=$intano?>" <? if($intano == $this->dtaano_ent ){ ?> selected="selected" <? } ?> ><?=$intano?></option> <? } ?>
</select>

<img src="<?php echo base_url()."public/images/" ?>1day.png" onclick="abrir_calendario('<?=$id?>')" />
<div id="<?=$id?>calendario"></div>
</div>

<script>


var calendario = GetRequest();

function data_selecionada(id) { document.getElementById(id).value = document.getElementById(id+'dtaano').value +"-"+document.getElementById(id+'dtames').value +"-"+document.getElementById(id+'dtadia').value; }

function add_mes(ms) { mes = ms; selecionar_data(); }
function add_ano(an) { ano = an; selecionar_data(); }

function selecionar_data()
{
	
	data_selecionada(id);
	Ajax(calendario,"<?php echo "public/calendario/" ?>calendario.php?dtadia="+dia+"&dtames="+mes+"&dtaano="+ano+"&id="+id,id+"calendario");
}
function abrir_calendario(idd)
{
	
	id = idd;
	if ( ( document.getElementById(id+'calendario').style.display == "none" ) || ( document.getElementById(id+'calendario').style.display == "") )
	{ 
		dia = document.getElementById(id+'dtadia').value;
		mes = document.getElementById(id+'dtames').value;
		ano = document.getElementById(id+'dtaano').value;
		document.getElementById(id+'calendario').style.display = "block";
		selecionar_data();	
	}
	else
	{
		document.getElementById(id+'calendario').style.display = "none";	
	}
}
function fechar_calendario(id)
{
	document.getElementById(id+'calendario').style.display = "none";
}
function selecionar_dia(di,ms,an,id)
{
	document.getElementById(id+'dtadia').value = di;
	document.getElementById(id+'dtames').value = ms;
	document.getElementById(id+'dtaano').value = an;
	dia = di;
	mes = ms;
	ano = an;
	data_selecionada(id);
	document.getElementById(id+'calendario').style.display = "none";
}

</script>

<style>
#<?=$id?>Calend_div img { cursor: pointer; }
#<?=$id?>calendario { background:url('<?php echo base_url()."public/calendario/img/" ?>fundo.png') no-repeat; padding:11px; font-align:center; font-size: 12px; width:284px; height:224px; position: absolute; display:none; text-align:left; }
#<?=$id?>calendario div { margin-left:10px; margin-bottom:5px; }
#<?=$id?>calendario .fechar { float:rigth; margin-rigth:10px;  }

#<?=$id?>calendario table { padding:10px; font-size:12px; }
#<?=$id?>calendario .dia { padding-left:8px; font-size:11px; padding-right:8px; padding-top:4px; text-align:center; border: 1px solid #C0C0C0; cursor:pointer; }
#<?=$id?>calendario .dia:hover { background:#C0C0C0; font-size:11px; }
#<?=$id?>calendario .diasele { padding-left:7px; font-size:11px; padding-right:7px; padding-top:4px; text-align:center; border: 1px solid #C0C0C0; background:#CCFFCC; }

#<?=$id?>calendario_cabecalho td { border:1px solid #C0C0C0; background:#A0FFA0; text-weight:blod; text-align:center;  }
#<?=$id?>calendario_cabecalho td:hover { border:1px solid #C0C0C0; background:#A0FFA0; }
</style>

<?
}
function Data_separada($dia,$mes,$ano)
{
	?><script>selecionar_dia(<?='"'.$dia.'"'?>,<?='"'.$mes.'"'?>,<?='"'.$ano.'"'?>,"<?=$this->id?>");</script> <?
}
function Data($dta)
{

	$dta = explode('-',$dta);
	?><script>selecionar_dia("<?=$dta[2]?>","<?=$dta[1]?>","<?=$dta[0]?>","<?=$this->id?>");</script> <? 
}
}
 ?>
