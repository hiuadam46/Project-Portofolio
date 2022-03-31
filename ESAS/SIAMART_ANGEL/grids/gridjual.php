<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:39px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
	<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse'>
		<tr>
");
echo("
			<th rowspan=2> No. </th>
");
$mwd1='2 readonly';
echo("
			<th rowspan=2> Kode<br>[F5]</th>
");
$mwd2='8';
echo("
			<th rowspan=2> Uraian </th>
");
$mwd3='45 readonly';
echo("
			<th colspan=6> Qty jual </th>
");
$mwd4567='6';
echo("
			<th colspan=2> Extra </th>
");
$mwd891011='6';
echo("
			<th rowspan=2> Harga </th>
");
$mwd12='6';
echo("
			<th rowspan=2> Dis<br>Rp. </th>
");
$mwd13='5';
echo("
			<th rowspan=2> Jumlah </th>
");
$mwd14='12 readonly';
echo("
			<th rowspan=2> isi 1</th>
");
$mwd14='12 readonly';
echo("
			<th rowspan=2> isi 2</th>
");
$mwd15='8 readonly';
echo("
		</tr>
");

echo("
		<tr>
");
echo("
			<th colspan=2> Qty 1</th>
");
$mwd4='6';
$mwd5='4 readonly';
echo("
			<th colspan=2> Unit </th>
");
$mwd6='4';
$mwd7='4 readonly';
echo("
			<th colspan=2> Qty 2</th>
");
$mwd8='6';
$mwd9='4 readonly';
echo("
			<th colspan=2> Unit </th>
");
$mwd10='4';
$mwd11='4 readonly';
echo("
		</tr>
");
echo("
		<tr>
			<th><input size=$mwd1 type='text' readonly $msty></th>
			<th><input size=$mwd2 type='text' readonly $msty></th>
			<th><input size=$mwd3 type='text' readonly $msty></th>
			<th><input size=$mwd4 type='text' readonly $msty></th>
			<th><input size=$mwd5 type='text' readonly $msty></th>
			<th><input size=$mwd6 type='text' readonly $msty></th>
			<th><input size=$mwd7 type='text' readonly $msty></th>
			<th><input size=$mwd8 type='text' readonly $msty></th>
			<th><input size=$mwd9 type='text' readonly $msty></th>
			<th><input size=$mwd10 type='text' readonly $msty></th>
			<th><input size=$mwd11 type='text' readonly $msty></th>
			<th><input size=$mwd12 type='text' readonly $msty></th>
			<th><input size=$mwd13 type='text' readonly $msty></th>
			<th><input size=$mwd14 type='text' readonly $msty></th>
			<th><input size=$mwd15 type='text' readonly $msty></th>
			<th><input size=$mwd15 type='text' readonly $msty></th>
		</tr>
	</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:300px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
	<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{
	$mst='';
}

$query="
select a.stoid, FORMAT(a.qty,0) qty, FORMAT(a.unit,0) unit, FORMAT(a.extra,0) extra, FORMAT(a.extraunit,0) extraunit, FORMAT(hrgsat,0) hrgsat, FORMAT(diskonrp,0) diskon, FORMAT(jmlhrg,0) jmlhrg, ratehrgjual
from transjual2 a
where a.nid='$mnid'
order by nomor
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
{
	$mhii='';
	$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
	$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
	$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
	$nstt4=" onkeydown=arah(this) onfocus=arah(this);this.select()";
	$mjrow=10;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	
	$mtoid=$rows[stoid];
	$nng=execute("select stonama,satuan1,satuan2,isi, isi2 from setstok where stoid='$mtoid'");
	
	echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd2 value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text_$mnom' $midname size=$mwd3 value='".$nng[stonama]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd4 value='".$rows[qty]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd5 value='".$nng[satuan1]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[unit]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd7 value='".$nng[satuan2]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd8 value='".$rows[extra]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd9 value='".$nng[satuan1]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd10 value='".$rows[extraunit]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd11 value='".$nng[satuan2]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd12 value='".$rows[hrgsat]."' $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo '
			<td><input type="text" '.$midname.' size='.$mwd13.' value="'.$rows[diskon].'" '.$nstt2.' onblur="cekdiskon(this)"></td>
	';
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd14 value='".$rows[jmlhrg]."' $nstt2></td>
	";
	
	$midname="id='misi".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd15 value='".$nng[isi]."' $nstt2></td>
	";
	$midname="id='misi2".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd15 value='".$nng[isi2]."' $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td hidden><input type='text' $midname size=$mwd15 value='".$rows[ratehrgjual]."' $nstt2></td>
	";
	echo "
		</tr>
	";
	
	$mnom++;
}

$mjum=$mnom-1;

for ($mgg=$mnom;$mgg<100;$mgg++)
{
	$mhii='';
	$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
	$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
	$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
	$nstt4=" onkeydown=arah(this) onfocus=arah(this);this.select()";
	$mjrow=10;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	
	echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd2 value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text_$mnom' $midname size=$mwd3 value='".$rows[stonama]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd4 value='".$rows[qty]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd5 value='".$rows[satuan1]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[unit]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd7 value='".$rows[satuan2]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd8 value='".$rows[extra]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd9 value='".$rows[satuan1]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd10 value='".$rows[extraunit]."' $nstt2 onblur='cekqtyx(this)'></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd11 value='".$rows[satuan2]."' $nstt></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd12 value='".$rows[hrgsat]."' $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo '
			<td><input type="text" '.$midname.' size='.$mwd13.' value="'.$rows[diskon].'" '.$nstt2.' onblur="cekdiskon(this)"></td>
	';
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd14 value='".$rows[jmlhrg]."' $nstt2></td>
	";
	
	$midname="id='misi".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd15 value='".$ngg[isi]."' $nstt2></td>
	";

	$midname="id='misi2".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd15 value='".$ngg[isi2]."' $nstt2></td>
	";
	
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$misi".'_'."$mnom'";
	echo "
			<td hidden><input type='text' $midname size=$mwd15 value='".$rows[ratehrgjual]."' $nstt2></td>
	";
	echo "
		</tr>
	";
	
	$mnom++;
}
echo("
	</table>
</div>
<div id='divsum' style='height:99px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<input type=text size=5 id='tabjumlah' hidden value='$mjum' readonly style='text-align:center'>
	<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse'>
		<tr>
			<td bgcolor='white' rowspan=5 colspan=11 align=center>&nbsp;<font color=red><span id='spanket'></span></td>
			<td bgcolor='white' colspan=2 align=right>Total&nbsp;&nbsp;</td>
			<td bgcolor='white'><input size=$mwd14 type='text' $nstt2 readonly id='mtotal'></td>
		</tr>
		
		<tr>
			<td bgcolor='white' colspan=2 align=right>Diskon (%)&nbsp;&nbsp;</td>
			<td bgcolor='white'><input size=12 type='text' $nstt2 id='mongkos'></td>
		</tr>
		
		<tr>
			<td bgcolor='white' colspan=2 align=right><input type=checkbox id='mctunai' onclick=rumus1()> Tunai&nbsp;&nbsp;</td>
			<td bgcolor='white'><input size=12 type='text' $nstt2 id='mtunai'></td>
		</tr>
		
		<tr>
			<td bgcolor='white' colspan=2 align=right>Piutang&nbsp;&nbsp;</td>
			<td bgcolor='white'><input size=$mwd14 type='text' $nstt2 readonly id='mhutang'></td>
		</tr>
		
		<tr>
			<td bgcolor='white' colspan=2 align=right>Jt. Tempo&nbsp;&nbsp;</td>
			<td bgcolor='white'><input size=$mwd14 type='text' $nstt2 readonly id='mjt'></td>
		</tr>
		
		<tr>
			<td bgcolor='white'><input size=$mwd1 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd2 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd3 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd4 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd5 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd6 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd7 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd8 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd9 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd10 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd11 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd12 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd13 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd14 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd15 type='text' $msty readonly></td>
			<td bgcolor='white'><input size=$mwd15 type='text' $msty readonly></td>
		</tr>
	</table>
</div>
");
?>
