<?php 
require ('../utama.php');

$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
$msty=" style='background-color:transparent;border:0;' ";
$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

echo("
<div id='backtabel' style='height:21px;overflow:hidden;background-image: url(../images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode [F5]</td> 
<td bgcolor=lightblue align=center><b>Nama Rekening</td> 
<td bgcolor=lightblue align=center><b>Jumlah</td> 
<td bgcolor=lightblue align=center hidden><b>BP[F5]</td> 
<td bgcolor=lightblue align=center hidden><b>Nama</td> 
</tr>

<tr id='bodiv_$mnom' $mhii>
<td align=right><input type='text2_$mnom' id='12_$mnom' name='12_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
<td><input type='text2_$mnom' id='22_$mnom' name='22_$mnom' class='rcell' size=12 value='".$rows[rekid]."' disabled $msty ></td>
<td><input type='text' id='32_$mnom' name='32_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
<td><input type='text' id='42_$mnom' name='42_$mnom' class='rcell'  size=10 value='".$rows[jumlah]."' disabled $msty2></td>
<td hidden><input type='text2_$mnom' id='52_$mnom' name='52_$mnom' class='rcell' size=12 value='".$rows[bpid]."' disabled $msty  onblur=ambilbp(this)></td>
<td hidden><input type='text' id='62_$mnom' name='62_$mnom' class='rcell'  size=20 value='".$rows[bpnama]."' disabled $msty></td>
</tr>
		
</table>
</div>

<div id='backtabel2' style='background-image: url(../images/backt.png);height:150px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="
select a.rekid,b.reknama,FORMAT(a.debet+kredit,0) jumlah,a.bpid,concat(ifnull(c.supnama,''),ifnull(d.karnama,''),ifnull(e.lgnnama,'')) bpnama 
from bkbesar a  
left join setrek b on a.rekid=b.rekid 
left join setsup c on a.bpid=c.supid 
left join setkaryawan d on a.bpid=d.karid 
left join setlgn e on a.bpid=e.lgnid 
where a.nid='$mnnid' and nid2='I' order by rekid
";

	$rrw=executerow($query);
	$mnom=200;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$mnomx=$mnom-199;;
		echo "
		<tr id='bodiv_$mnom' $mhii  class='thediv'>
		<td align=right><input type='text2_$mnom' id='12_$mnom' name='12_$mnom' class='rcell' size=5 value='".$mnomx.".' disabled $msty2></td>
		<td><input type='text2_$mnom' id='22_$mnom' name='22_$mnom' class='rcell' size=12 value='".$rows[rekid]."' $msty  onblur=ambilrek(this)></td>
		<td><input type='text' id='32_$mnom' name='32_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
		<td><input type='text' id='42_$mnom' name='42_$mnom' class='rcell'  size=10 value='".$rows[jumlah]."' $msty2></td>
		<td hidden><input type='text2_$mnom' id='52_$mnom' name='52_$mnom' class='rcell' size=12 value='".$rows[bpid]."' $msty  onblur=ambilbp(this)></td>
		<td hidden><input type='text' id='62_$mnom' name='62_$mnom' class='rcell'  size=20 value='".$rows[bpnama]."' disabled $msty></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<300;$mii++)
	{
		$mhii='';

		$mnomx=$mnom-199;;
		echo "
		<tr id='bodiv_$mnom' $mhii  class='thediv'>
		<td align=right><input type='text2_$mnom' id='12_$mnom' name='12_$mnom' class='rcell' size=5 value='".$mnomx.".' disabled $msty2></td>
		<td><input type='text2_$mnom' id='22_$mnom' name='22_$mnom' class='rcell' size=12 value='' $msty'  onblur=ambilrek(this)></td>
		<td><input type='text' id='32_$mnom' name='32_$mnom' class='rcell'  size=50 value='' disabled $msty'></td>
		<td><input type='text' id='42_$mnom' name='42_$mnom' class='rcell'  size=10 value='' $msty2'></td>
		<td hidden><input type='text2_$mnom' id='52_$mnom' name='52_$mnom' class='rcell' size=12 value='' $msty' onblur=ambilbp(this)></td>
		<td hidden><input type='text' id='62_$mnom' name='62_$mnom' class='rcell'  size=20 value='' disabled $msty'></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");



?>