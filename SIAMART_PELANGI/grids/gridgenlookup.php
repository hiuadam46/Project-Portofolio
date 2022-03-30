<?php
require("../utama.php");

if ($maww=='')
{$maww=0;}

$query=$msqq." order by POSITION('$tcar' IN $morder) ,".$morder.' '.$mad.' limit '.$maww.',50';

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:white;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>");

echo("<th> No. </th>");


$rrw=executerow($query);
$jum=mysql_num_fields($rrw);

for ($ggm=0;$ggm<$jum;$ggm++)
{
$mnam=mysql_field_name($rrw,$ggm);
$mnam=str_replace("right","",$mnam);
$mnam=str_replace("cente","",$mnam);

if ($mnam=='QSALDO')
{
$mnam='Qty';
}
$mnam2=mysql_field_name($rrw,$ggm);

$moor=' ';
if($morder==$mnam2)
{

if ($mad=='asc')
{$moor='v';}
else
{$moor='^';}

}
else
{
$moor='-';
}

echo("<th rowspan=1> <input type=button value='$moor' id='$mnam2' $msty onclick=focuskan() onmousedown=urutkan(this)> $mnam <input type=button value=' ' $msty > </th>");
}
echo("</tr>
<th><input size=2 type='text' disabled $msty></th>
");

for ($ggm=0;$ggm<$jum;$ggm++)
{

$mpan=mysql_field_len($rrw,$ggm);
if (mysql_field_name($rrw,$ggm)=='QSALDO')
{
$mpan=15;
}

echo("<th><input size=$mpan type='text' disabled $msty></th>");
}

echo("
</tr>
</table>
</div>
<div id='backtabel2' style='background-image: url(images/backt.png);height:330px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

/*$query="select * from temporer limit 0,50";*/


$mnom=1;
$mnomx=$maww+1;
while ($rows=mysql_fetch_array($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:white;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:white;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:white;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeypress=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnomx.' type='text' $midname size=2 $nstt2 readonly></td>
		";
		
		for ($ggm=0;$ggm<$jum;$ggm++)
		{
		
		$maliggn=$nstt;
		$mmkl=mysql_field_type($rrw,$ggm);
		$misi=$rows[$ggm];
		
		
		if ($mmkl=='numeric' or $mmkl=='decimal' or $mmkl=='double' or $mmkl=='integer' or $mmkl=='real')
		{$maliggn=$nstt2;}

		$mmkl=mysql_field_name($rrw,$ggm);

		$mpan=mysql_field_len($rrw,$ggm);
		if ($mmkl=='QSALDO')
		{
		$msto=$rows['stoid'];
		$nnnt=execute("select  right(concat(truncate(sum(qtyin-qtyout)/isi,0),' ',satuan1,' ',truncate(mod(sum(qtyin-qtyout),isi),0),' ',satuan2),20) saldo from bkbesar b left join setstok a on b.bpid=a.stoid and a.stoid='$msto' where bpid2='$misi' and bpid='$msto'");
		$misi=$nnnt[saldo];
		$mpan=15;
		$maliggn=$nstt2;
		}

		$mdua=substr($mmkl,0,5);
		if ($mdua=='right')
		{

		$maliggn=$nstt2;
		$misi=$rows[$ggm];
		}

		if ($mdua=='cente')
		{
		$maliggn=$nstt3;
		}
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "  	
		<td><input type='text_$mnom' $midname size=$mpan
		value='$misi'  $maliggn readonly></td>
		";
		
		}

		
		echo "</tr>";

		$mnom++;
		$mnomx++;
	}

	$mjum=$mnom-1;
	
	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");


?>