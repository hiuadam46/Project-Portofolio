<?php 

require ('utama.php');

if ($_POST['mTform']=='setkaryawan')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=5;$mwd3=25;$mwd4=30;$mwd5=15;$mwd6=15;$mwd7=30;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> Kode </th>
<th> Nama </th>
<th> Alamat </th>
<th> Telp. </th>
<th> Jabatan </th>
<th> Catatan </th>
<th> <input size=$mwd7 type='checkbox' id='chkall' onclick='chkalls(this)' $msty> </th>
<th> Print Gaji </th>
</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='checkbox' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:450px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select *
from setkaryawan
where karnama like '%$_POST[mfilt]%'
order by karid";

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
		<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[karid]."' $nstt readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[alamat]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[telp]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[jabatan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".$rows[ket]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='checkbox' $midname size=$mwd79 class='chkhk' checked
		value='.$rows[print].' onclick=ambilprint(this);arah(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td size=$mwd5><button type='button' id='".$rows[karid]."' onclick='openPayroll(".$rows[karid].")' size=$mwd5>Print Slip Gaji :".$rows[karid]."</button></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

?>