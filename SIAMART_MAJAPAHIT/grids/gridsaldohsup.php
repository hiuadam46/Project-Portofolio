<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:20px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>");
echo("<th > No. </th>");$mwd1='2 disabled';
echo("<th > Nota </th>");$mwd2='12';
echo("<th > Tgl. </th>");$mwd3='12';
echo("<th > Jumlah </th>");$mwd4='15';
echo("<th > Ket. </th>");$mwd5='20';
echo("</tr>");

echo("
<tr>
<td  ><input size=$mwd1 type='text' disabled $msty></td>
<td  ><input size=$mwd2 type='text' disabled $msty></td>
<td  ><input size=$mwd3 type='text' disabled $msty></td>
<td  ><input size=$mwd4 type='text' disabled $msty></td>
<td  ><input size=$mwd5 type='text' disabled $msty></td>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select nid,date_format(tgl,'%d-%m-%Y') tgl,kredit-debet saldo,ket from bkbesar where bpid='$msupid' and rekid='$mrekid' and trans='SA' ";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
$mtot=0;
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
		value='".number_format($rows[saldo],0,".",",")."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[ket]."' $nstt ></td>
		";

		echo "</tr>";

		$mnom++;
		$mtot=$mtot+$rows[saldo];
	}
	$mtot=number_format($mtot,0,".",",");

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
		value='".$rows[saldo]."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[ket]."' $nstt ></td>
		";

		$mnom++;
	
	}
	
	echo("</table>
	</div>
	<div id='divsum' style='overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
	<input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'>
	<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse'>

	<tr>
	<td bgcolor='white' colspan=2 align=center>&nbsp;<font color=red><span id='spanket'></span></td>
	<td bgcolor='white' align=right>Total&nbsp;&nbsp;</td>
	<td bgcolor='white' align=right><input size=8 type='text'  style='font-weight:bold;border:0;;text-align:right;background-color:transparent;' readonly id='mtotal' value=$mtot></td>
	</tr>

	<tr>
	<td  bgcolor='Grey'><input size=$mwd1 type='text'  $msty disabled></td>
	<td  bgcolor='Grey'><input size=$mwd2 type='text'  $msty disabled></td>
	<td  bgcolor='Grey'><input size=$mwd3 type='text'  $msty disabled></td>
	<td  bgcolor='Grey'><input size=$mwd4 type='text'  $msty disabled></td>
	<td  bgcolor='Grey'><input size=$mwd5 type='text'  $msty disabled></td>
	</tr>

	</table>
	</div>
	
	");


?>