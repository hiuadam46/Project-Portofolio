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
echo("<th rowspan=1> Kode </th>");$mwd2='10 ';
echo("<th rowspan=1> Tgl. Cair </th>");$mwd3='10 ';
echo("<th rowspan=1> Keterangan </th>");$mwd4='40 ';
echo("<th rowspan=1> Jumlah </th>");$mwd5='10 ';
echo("<th rowspan=1> Bank [F5]</th>");$mwd6='12 ';
echo("<th rowspan=1> yang dipakai</th>");$mwd7='15 disabled ';
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
<div id='backtabel' style='background-image: url(images/backt.png);height:100px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.bpid2,a.nid2,b.reknama,date_format(a.tgl2,'%d-%m-%Y') tgl2,a.ket,format(a.kredit+a.debet,0) kredit
from bkbesar a left join setrek b on a.bpid2=b.rekid
where a.nid='$mnid' and a.rekid='20110' ";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=200;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		$mnomjx=$mnom-199;
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnomjx.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid2]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3 
		value='".$rows[tgl2]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[ket]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[kredit]."' $nstt2 ></td>
		";


		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[bpid2]."' $nstt onblur='ambilrek(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[reknama]."' $nstt ></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	for ($mgg=$mnom;$mgg<301;$mgg++)
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";

		$mnomjx=$mnom-199;
		
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnomjx.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid2]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3 
		value='".$rows[tgl2]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[ket]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[kredit]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[bpid2]."' $nstt   onblur='ambilrek(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[reknama]."' $nstt></td>
		";
		
		echo "</tr>";

		$mnom++;
	
	}
	
	echo("</table>
	</div>
	
	");


?>