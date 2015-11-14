<?
header("Content-type: text/html; charset=iso-8859-1");	
if(!empty($_GET['dtadia'])) { $dtadia = $_GET['dtadia']; }
else { $dtadia = date("d"); } 

if(!empty($_GET['dtames'])) { $dtames = $_GET['dtames']; }
else { $dtames = date("m"); } 

if(!empty($_GET['dtaano'])) { $dtaano = $_GET['dtaano']; }
else { $dtaano = date("Y"); }

$id = $_GET['id'];

$diadasemana = date("w", mktime(0,0,0,$dtames,1,$dtaano))+1;
$ultdia = date("d", mktime(0,0,0,$dtames+1,0,$dtaano));



$mes = array(
                   '01' => 'JANEIRO',
                   '02' => 'FEVEREIRO',
                   '03' => 'MAR&Ccedil;O',
                   '04' => 'ABRIL',
                   '05' => 'MAIO',
                   '06' => 'JUNHO',
                   '07' => 'JULHO',
                   '08' => 'AGOSTO',
                   '09' => 'SETEMBRO',
                   '10' => 'OUTUBRO',
                   '11' => 'NOVEMBRO',
                   '12' => 'DEZEMBRO'
                  );

?>

<div>
<select name="dtames" id="<?=$id?>dtames" onchange="add_mes(this.value)">
	<? for($intmes = 1; $intmes <= 12; $intmes++) { ?><option value="<? if($intmes < 10) { echo('0'.$intmes); } else { echo ($intmes); } ?>" <? if($intmes == $dtames ){ ?> selected="selected" <? } ?> >
<? if($intmes < 10) { echo($mes['0'.$intmes]); } else { echo ($mes[$intmes]); } ?>
</option> <? } ?>
</select>
<select name="dtaano" id="<?=$id?>dtaano" onchange="add_ano(this.value)">
	<? for($intano = 1900; $intano <= 2020; $intano++) { ?><option value="<?=$intano?>" <? if($intano == $dtaano ){ ?> selected="selected" <? } ?> ><?=$intano?></option> <? } ?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="fechar_calendario('<?=$id?>')">(fechar)</a>
</div>
<table >
<tr id="<?=$id?>calendario_cabecalho">
<td>D</td>
<td>S</td>
<td>T</td>
<td>Q</td>
<td>Q</td>
<td>S</td>
<td>S</td>
</tr>
<?
$dia = 1;
for($em=1; $em <= 6; $em++)
{
	echo("<tr>");
	for($sem = 1; $sem <= 7; $sem++ )
	{
		if($dia<10) { $dd = "0".$dia; }
		else { $dd = $dia; }
		if( ($em == 1) && ($sem >= $diadasemana) ) { echo("<td "); if($dtadia == $dd) { echo('class="diasele"'); } else { echo("class='dia'"); } echo(" onclick='selecionar_dia(".'"'.$dd.'","'.$dtames.'","'.$dtaano.'","'.$id.'"'.")' >$dd</td>"); $dia++; }
		else if(($em > 1) && ( $ultdia >= $dia) )  { echo("<td "); if($dtadia == $dd) { echo('class="diasele"'); } else { echo("class='dia'"); } echo(" onclick='selecionar_dia(".'"'.$dd.'","'.$dtames.'","'.$dtaano.'","'.$id.'"'.")' >$dd</td>"); $dia++; }
		else { echo("<td>&nbsp;</td>"); }
	}
	echo("</tr>");
}
?>
</table>
