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
<td bgcolor=lightblue align=center><b>Qty Aktual</td> 

<td bgcolor=lightblue align=center><b>Unit</td> 
<td bgcolor=lightblue align=center><b>Sat.</td> 
<td bgcolor=lightblue align=center><b>Unit Aktual</td> 
<td bgcolor=lightblue align=center><b>Isi Barang</td>

</tr>

<tr id='bodiv_$mnom' $mhii>
<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' readonly $msty2></td>
<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[rekid]."' readonly $msty ></td>
<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[reknama]."' readonly $msty></td>
<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='".$rows[jumlah]."' readonly $msty2></td>
<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=5 value='".$rows[bpid]."' readonly $msty  onblur=ambilbp(this)></td>
<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=10 value='".$rows[jumlah2]."' readonly $msty2></td>
<td><input type='text' id='7_$mnom' name='7_$mnom' class='rcell'  size=10 value='".$rows[jumlah2]."' readonly $msty2></td>
<td><input type='text' id='8_$mnom' name='8_$mnom' class='rcell'  size=5 value='".$rows[jumlah2]."' readonly $msty2></td>
<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=10 value='".$rows[jumlah2]."' readonly $msty2></td>

</tr>
		
</table>
</div>

<div id='backtabel2' style='background-image: url(../images/backt.png);height:400px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="
select a.*,b.stonama,b.satuan1,b.satuan2,b.isi from transsesuai a left join setstok b on a.stoid=b.stoid
where a.nid='$mnid'

";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';

		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' readonly $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty  onblur=ambilstok(this)></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[stonama]."' readonly $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='".$rows[qty]."' readonly $msty2  readonly></td>
		<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=5 value='".$rows[satuan1]."' $msty readonly></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=10 value='".$rows[qtya]."' $msty2 ></td>
		<td><input type='text' id='7_$mnom' name='7_$mnom' class='rcell'  size=10 value='".$rows[unit]."' readonly $msty2  readonly></td>
		<td><input type='text_$mnom' id='8_$mnom' name='8_$mnom' class='rcell' size=5 value='".$rows[satuan2]."' $msty  readonly></td>
		<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=10 value='".$rows[unita]."' $msty2></td>
		<td><input type='text' id='10_$mnom' name='10_$mnom' class='rcell'  size=10 value='".$rows[isi]."' $msty2 readonly></td>
		

		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';

		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' readonly $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty  onblur=ambilstok(this)></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=30 value='".$rows[stonama]."' readonly $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='".$rows[qty]."' readonly $msty2  readonly></td>
		<td><input type='text_$mnom' id='5_$mnom' name='5_$mnom' class='rcell' size=5 value='".$rows[satuan1]."' $msty readonly></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=10 value='".$rows[qty2]."' $msty2 ></td>

		<td><input type='text' id='7_$mnom' name='7_$mnom' class='rcell'  size=10 value='".$rows[unit]."' readonly $msty2  readonly></td>
		<td><input type='text_$mnom' id='8_$mnom' name='8_$mnom' class='rcell' size=5 value='".$rows[satuan2]."' $msty  readonly></td>
		<td><input type='text' id='9_$mnom' name='9_$mnom' class='rcell'  size=10 value='".$rows[unit2]."' $msty2></td>
		<td><input type='text' id='10_$mnom' name='10_$mnom' class='rcell'  size=8 value='".$rows[isi]."' $msty2 readonly></td>
		

		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");



?>