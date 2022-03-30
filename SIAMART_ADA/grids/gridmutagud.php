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
<td bgcolor=lightblue align=center><b>Nama Stok</td> 
<td bgcolor=lightblue align=center><b>Qty</td> 
<td bgcolor=lightblue align=center><b>Sat.</td> 
<td bgcolor=lightblue align=center><b>Unit</td> 
<td bgcolor=lightblue align=center><b>Sat.</td> 
<td bgcolor=lightblue align=center><b>Ket</td> 
<td bgcolor=lightblue align=center><b>Isi</td> 
</tr>

<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty  onblur=ambilstok(this)></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[stonama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=5 value='".$rows[qty]."' $msty2></td>
		<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=7 value='".$rows[satid]."' $msty   disabled ></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=5 value='".$rows[unit]."' $msty2></td>
		<td><input type='text_$mnom' id='7_$mnom' name='7_$mnom' class='rcell' size=7 value='".$rows[satid2]."' $msty   disabled ></td>
		<td><input type='text' id='8_$mnom' name='8_$mnom' class='rcell'  size=20 value='".$rows[ket]."' $msty></td>
		<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=3 value='".$rows[isi]."' $msty  disabled ></td>
</tr>
		
</table>
</div>

<div id='backtabel2' style='background-image: url(../images/backt.png);height:400px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="
select a.*,b.stonama,satuan1,satuan2 from transmutasigudang a left join setstok b on a.stoid=b.stoid
where a.nid='$mnid' order by nomor
";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty  onblur=ambilstok(this)></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[stonama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=5 value='".$rows[qty]."' $msty2></td>
		<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=7 value='".$rows[satuan1]."' $msty   disabled ></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=5 value='".$rows[unit]."' $msty2></td>
		<td><input type='text_$mnom' id='7_$mnom' name='7_$mnom' class='rcell' size=7 value='".$rows[satuan2]."' $msty   disabled ></td>
		<td><input type='text' id='8_$mnom' name='8_$mnom' class='rcell'  size=20 value='".$rows[ket]."' $msty></td>
		<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=3 value='".$rows[isi]."' $msty  disabled ></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';

		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty  onblur=ambilstok(this)></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[stonama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=5 value='".$rows[qty]."' $msty2></td>
		<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=7 value='".$rows[satid]."' $msty   disabled ></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=5 value='".$rows[unit]."' $msty2></td>
		<td><input type='text_$mnom' id='7_$mnom' name='7_$mnom' class='rcell' size=7 value='".$rows[satid2]."' $msty   disabled ></td>
		<td><input type='text' id='8_$mnom' name='8_$mnom' class='rcell'  size=20 value='".$rows[ket]."' $msty></td>
		<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=3 value='".$rows[isi]."' $msty  disabled ></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");



?>