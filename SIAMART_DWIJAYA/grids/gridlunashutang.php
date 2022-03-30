<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>");

echo("<th rowspan=1> No. </th>");$mwd1='2 disabled';
echo("<th rowspan=1> Nota </th>");$mwd2='10 disabled';
echo("<th rowspan=1> Tgl </th>");$mwd3='10 disabled';
echo("<th rowspan=1> Jumlah </th>");$mwd4='10 disabled';
echo("<th rowspan=1> Retur </th>");$mwd5='10 disabled';
echo("<th rowspan=1> Lunas </th>");$mwd6='10 disabled';
echo("<th rowspan=1> Saldo </th>");$mwd7='10 disabled';
echo("<th rowspan=1> Bayar </th>");$mwd8='10 ';
echo("<th rowspan=1> Sisa </th>");$mwd9='10 disabled';
echo("</tr>");
echo("
<tr>
<th  ><input size=$mwd1 type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='text' disabled $msty></th>
<th  ><input size=$mwd8 type='text' disabled $msty></th>
<th  ><input size=$mwd9 type='text' disabled $msty></th>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}


$query="select nid,tgl from bkbesar where nid='$mnid' and debet>0";
$mqwee=execute($query);
if ($mqwee[nid]=='')
{

$query="select nid,date_format(tgl,'%d-%m-%Y') tgl,
format(kredit ,0) kredit,format(ifnull(b.debet,0),0) lunas,format(ifnull(c.debet,0),0) retur,format(ifnull(d.debet,0),0) bayar,
format(kredit-ifnull(b.debet,0)-ifnull(c.debet,0)-ifnull(d.debet,0),0) saldo
from bkbesar a 
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans<>'TRANSRETURBELI' and nid<'$mnid' and bpid='$msupid' group by nid2) b on a.nid=b.nid2 
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans='TRANSRETURBELI'  and bpid='$msupid' group by nid2) c on a.nid=c.nid2
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans<>'TRANSRETURBELI' and nid='$mnid'  and bpid='$msupid' group by nid2) d on a.nid=d.nid2 
where rekid='20010' and a.kredit>0 and a.bpid='$msupid' and
(a.kredit-ifnull(b.debet,0)-ifnull(c.debet,0)-ifnull(d.debet,0)) >0
";

}
else
{

$query="select nid,date_format(tgl,'%d-%m-%Y') tgl,
format(kredit ,0) kredit,format(ifnull(b.debet,0),0) lunas,format(ifnull(c.debet,0),0) retur,format(ifnull(d.debet,0),0) bayar,
format(kredit-ifnull(b.debet,0)-ifnull(c.debet,0),0) saldo,
format(kredit-ifnull(b.debet,0)-ifnull(c.debet,0)-ifnull(d.debet,0),0) sisa
from bkbesar a 
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans<>'TRANSRETURBELI' and nid<'$mnid' and bpid='$msupid' group by nid2) b on a.nid=b.nid2 
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans='TRANSRETURBELI'  and bpid='$msupid' group by nid2) c on a.nid=c.nid2
left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and trans<>'TRANSRETURBELI' and nid='$mnid'  and bpid='$msupid' group by nid2) d on a.nid=d.nid2 
where rekid='20010' and a.kredit>0 and a.bpid='$msupid' and a.nid in (select nid2 from bkbesar where nid='$mnid') 
";

}
/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[kredit]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[retur]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[lunas]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[saldo]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd8
		value='".$rows[bayar]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd9
		value='".$rows[sisa]."' $nstt2 ></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	
	echo("</table>
	</div>
	
	");


?>