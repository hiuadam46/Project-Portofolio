<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:39px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>");

echo("<th rowspan=2> No. </th>");$mwd1='2 disabled';
echo("<th rowspan=2> Kode<br>[F5]</th>");$mwd2='8';
echo("<th rowspan=2> Uraian </th>");$mwd3='40 disabled';
echo("<th colspan=4> Qty Retur </th>");$mwd4567='6';
echo("<th rowspan=2> Harga </th>");$mwd12='6';
echo("<th rowspan=2> Dis<br>% </th>");$mwd13='3';
echo("<th rowspan=2> Jumlah </th>");$mwd14='8 disabled';
echo("</tr>");

echo("<tr>");

echo("<th colspan=2> Qty </th>");$mwd4='4';
$mwd5='4 disabled';
echo("<th colspan=2> Unit </th>");$mwd6='4';
$mwd7='4 disabled';

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
<th  ><input size=$mwd12 type='text' disabled $msty></th>
<th  ><input size=$mwd13 type='text' disabled $msty></th>
<th  ><input size=$mwd14 type='text' disabled $msty></th>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:300px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select 
a.stoid,
FORMAT(a.qty,0) qty,FORMAT(a.unit,0) unit,
FORMAT(a.extra,0) extra,FORMAT(a.extraunit,0) extraunit,
FORMAT(hrgsat,0) hrgsat,FORMAT(diskonp,2) diskon,FORMAT(jmlhrg,0) jmlhrg
from transreturbeli2 a 
where a.nid='$mnid' 
order by nomor";

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
		
		$mtoid=$rows[stoid];
		$nng=execute("select stonama,satuan1,satuan2,isi from setstok where stoid='$mtoid'");

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
		value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$nng[stonama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[qty]."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$nng[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[unit]."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$nng[satuan2]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd12
		value='".$rows[hrgsat]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd13
		value='".$rows[diskon]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd14
		value='".$rows[jmlhrg]."' $nstt2 ><input type=hidden id='misi_$mnom' name='misi_$mnom' value='$nng[isi]'></td>
		";

		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;
	
	for ($mgg=$mnom;$mgg<100;$mgg++)
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
		value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[stonama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[qty]."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[unit]."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[satuan2]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd12
		value='".$rows[hrgsat]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd13
		value='".$rows[diskon]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd14
		value='".$rows[jmlhrg]."' $nstt2 ><input type=hidden id='misi_$mnom' name='misi_$mnom'></td>
		";

		$mnom++;
	
	}
	
	echo("</table>
	</div>
	<div id='divsum' style='height:99px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
	<input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'>
	<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse'>

	<tr>
	<td bgcolor='white' rowspan=5 colspan=7 align=center>&nbsp;<font color=red><span id='spanket'></span></td>
	<td bgcolor='white' colspan=2 align=right>Total&nbsp;&nbsp;</td>
	<td bgcolor='white'><input size=$mwd14 type='text'  $nstt2 readonly id='mtotal'></td>
	</tr>

	<tr>
	<td  bgcolor='white' colspan=2 align=right>&nbsp;&nbsp;</td>
	<td  bgcolor='white'><input size=8 type='hidden'  $nstt2 id='mongkos'></td>
	</tr>
	
	<tr>
	<td  bgcolor='white' colspan=2 align=right>&nbsp;&nbsp;</td>
	<td  bgcolor='white'><input size=8 type='hidden'  $nstt2 id='mtunai'></td>
	</tr>

	<tr>
	<td  bgcolor='white' colspan=2 align=right>&nbsp;&nbsp;</td>
	<td  bgcolor='white'><input size=$mwd14 type='hidden'  $nstt2 readonly id='mhutang'></td>
	</tr>

	<tr>
	<td  bgcolor='white' colspan=2 align=right>&nbsp;&nbsp;</td>
	<td  bgcolor='white'><input size=$mwd14 type='hidden'  $nstt2 readonly id='mjt'></td>
	</tr>

	<tr>
	<td  bgcolor='white'><input size=$mwd1 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd2 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd3 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd4 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd5 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd6 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd7 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd12 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd13 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd14 type='text'  $msty disabled></td>
	</tr>

	</table>
	</div>
	
	");


?>