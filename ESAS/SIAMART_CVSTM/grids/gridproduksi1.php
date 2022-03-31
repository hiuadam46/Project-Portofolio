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
echo("<th rowspan=1> LOT [F5]</th>");$mwd2='10';
echo("<th rowspan=1> Kode </th>");$mwd3='8  disabled';
echo("<th rowspan=1> Uraian </th>");$mwd4='15 disabled';
echo("<th rowspan=1> Sat. </th>");$mwd5='4 disabled';
echo("<th rowspan=1> Qty </th>");$mwd6='8 disabled';
echo("<th rowspan=1> Thp </th>");$mwd7='3 disabled';
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
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select left(a.ket,2) tahap,a.nid2,a.bpid stoid,b.stonama,b.satuan1,FORMAT(a.qtyout,2) qtyout,nid2 
from bkbesar a left join setstok b on a.bpid=b.stoid and a.trans='TRANSPRODUKSI'
where a.qtyout>0 and a.nid='$mnid' and rekid like '103%' and a.ket like '%Bahan%'
order by a.bpid";

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
		value='".$rows[nid2]."' $nstt onblur='ambillot(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[stonama]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[qtyout]."' $nstt2 onblur=ceksaldo(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[tahap]."' $nstt ></td>
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
		value='".$rows[nid2]."' $nstt onblur='ambillot(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[stonama]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[qtyout]."' $nstt2 onblur=ceksaldo(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[tahap]."' $nstt ></td>
		";
		
		echo "</tr>";

		$mnom++;
	
	}
	
	echo("</table>
	</div>
	<div id='divsum' style='height:19px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
	<input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'>
	<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse'>

	<tr>
	<td  bgcolor='white' colspan=5 align=right>Total&nbsp;&nbsp;</td>
	<td  bgcolor='white'><input size=$mwd6 type='text'  $nstt2 readonly id='mtotal1'></td>
	</tr>
	
	<tr>
	<td  bgcolor='white'><input size=$mwd1 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd2 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd3 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd4 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd5 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd6 type='text'  $msty disabled></td>
	<td  bgcolor='white'><input size=$mwd7 type='text'  $msty disabled></td>
	</tr>

	</table>
	</div>
	
	");


?>