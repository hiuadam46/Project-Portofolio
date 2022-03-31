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
echo("<th rowspan=1> Kode </th>");$mwd2='8';
echo("<th rowspan=1> Nama </th>");$mwd3='30 disabled';
echo("<th rowspan=1> Bagian </th>");$mwd4='50 disabled';
echo("<th rowspan=1> Pilih </th>");$mwd5='8';
echo("</tr>");
echo("
<tr>
<th  ><input size=$mwd1 type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<td>&nbsp;&nbsp;&nbsp;
<input type='checkbox' $midname size=$mwd5
value='".$rows[pilih]."' $nstt2 >&nbsp;&nbsp;&nbsp;</td>
</tr>

</table>
</div>

<div id='backtabel' style='background-image: url(images/backt.png);height:150px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="
select a.karid,a.karnama,a.bagian,if(b.bpid is null,false,true) pilih from setkaryawan a 
left join bkbesar b on a.karid=b.bpid and b.rekid='20110' and b.nid='$mnid' 
where a.grup like '$mgrup%' and prosesid like '%$mbagian%'
order by if(ifnull(b.bpid,true),2,1),a.karid
";
/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=300;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onfocus=arah(this);this.select()";
		$mjrow=40;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";

		$mnomx=$mnom-299;
		
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnomx.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[karid]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[bagian]."' $nstt ></td>
		";
		
		$mch='';
		
		if ($rows[pilih]==1)
		{
		$mch='checked';
		}

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td>&nbsp;&nbsp;&nbsp;
		<input type='checkbox' $midname size=$mwd5
		value='".$rows[pilih]."' $mch onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select() >&nbsp;&nbsp;&nbsp;
		</td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;
		
	echo("</table>
	");


?>