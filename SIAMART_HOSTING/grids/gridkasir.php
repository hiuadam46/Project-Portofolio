<?php
ob_start("ob_gzhandler");
require("../utama.php");

$nstt=" class='rcell' style='background-color:transparent;border:0;font-size:12pt' onkeypress=arah(this) onclick=arah(this) onfocus=arah2(this);this.select()";
$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right;font-size:12pt' onkeypress=arah(this) onfocus=arah2(this);this.select()";
$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center;font-size:12pt' onkeypress=arah(this) onfocus=arah2(this);this.select()";
$nstt4=" onkeypress=arah(this) onfocus=arah2(this);this.select()";

$mjogs=$mjog;
$mjogs2=$mjog*2;

echo("
<div id='backtabel' style='height:19px; overflow:hidden; background-image: url(images/nums.jpg); border-color:black; border-style:solid; border-width:1px; bgcolor:white;width:76vw'>
	<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg); border-collapse:collapse'>
		<tr>
");

echo("
			<th rowspan=1> No. </th>
");
$mwd1='1 readonly';
echo("
			<th rowspan=1> Input [F5]</th>
");
$mwd2='5';
echo("
			<th rowspan=1> Kode </th>
");
$mwd21='5 disabled';
echo("
			<th rowspan=1 > Uraian </th>
");
$mwd3='23 readonly';
echo("
			<th rowspan=1> Sat. </th>
");
$mwd4='4 readonly';
echo("
			<th rowspan=1> Qty </th>
");
$mwd5='5 readonly' ;
echo("
			<th rowspan=1> Harga </th>
");
$mwd6='8 readonly';
echo("
			<th rowspan=1> Diskon </th>
");
$mwd7='8 readonly';
echo("
			<th rowspan=1> Jumlah </th>
");
$mwd8='12 readonly';
echo("
			<th rowspan=1> Isi </th>
");
$mwd9='4 readonly';
echo("
			<th rowspan=1 > R </th>
");
$mwd10='8 readonly';

echo('
			<th rowspan=1 style="display:none"> B </th>
');
$mwd11='5 readonly';

echo("
		</tr>
");
echo('
		<tr>
			<th><input size='.$mwd1.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd2.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd21.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd3.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd4.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd5.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd6.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd7.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd8.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size='.$mwd9.' type="text" disabled '.$msty.' '.$nstt.'></th>
			<th><input size type="checkbox" disabled></th>
			<th style="display:none"><input size='.$mwd11.' type="text" disabled '.$msty.' '.$nstt.'></th>
		</tr>
	</table>
</div>
<div id="backtabel" style="background-color:; background-image: url(images/backt.png); height:400px; border-color:black; border-style:solid; border-width:1px; overflow-y:scroll;width:76.05vw">
	<table border=1 cellpadding=0 cellspacing=0 bgcolor="white" style="border-collapse:collapse">
');

$mst=" and status=$mk";
if ($mk=='3')
{
	$mst='';
}

$query='
select a.stoid, FORMAT(a.qty, 2) qty, FORMAT(a.hrgsat, 0) hrgsat, cdiskon diskon, FORMAT(a.jmlhrg, 0) jmlhrg, a.satuan, a.isi, b.stonama, b.satuan1, b.satuan2, (a.jmlhrg/c.poin_rp) poin, IF(a.isi>1, b.hrgbeli, b.hrgbeli/b.isi) hrgbeli
from transkasir2 a
left join setstok b on a.stoid=b.stoid
left join setgrp c on b.grpid=c.grpid
where a.nid="'.$mnid.'" order by num
';

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$query2='
select lgnid
from transkasir1 a
where a.nid="'.$mnid.'"
';
$rrw2=executerow($query2);
$rows2=mysql_fetch_assoc($rrw2);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
{
	if($rows[satuan]==$rows[satuan2])
	{
		$nstt='class="rcell" style="background-color:transparent; border:0; font-size:12pt; color:black" onkeypress=arah(this) onclick=arah(this) onfocus=arah2(this);this.select()';
	}
	else
	{
		$nstt='class="rcell" style="background-color:transparent; border:0; font-size:12pt; color:red" onkeypress=arah(this) onclick=arah(this) onfocus=arah2(this);this.select()';
	}
	
	$mhii='';
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
			<td><input type='text_$mnom' $midname size=$mwd2 value='' $nstt onblur='ambilstok(this)'></td>
	";

	echo "
			<td><input type=text $nstt id=stoid_$mnom value='".$rows[stoid]."' size=$mwd21></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td ><input type='text_$mnom' $midname size=$mwd3 value='".$rows[stonama]."' $nstt></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo '
			<td><input type="text" '.$midname.' size='.$mwd4.' value="'.$rows[satuan].'" '.$nstt.'></td>
	';
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd5 value='".$rows[qty]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[hrgsat]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd7 value='".$rows[diskon]."' $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname='id="18_'.$mnom.'" name="'.$mjrow.'_'.$mnom.'"';
	echo '
			<td><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[jmlhrg].'" '.$nstt2.'></td>
	';
	
	$midname='id="po_'.$mnom.'" name="po_'.$mnom.'"';
	echo '
			<td style="display:none"><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[poin].'" '.$nstt2.'></td>
	';
	/* echo '
			<td><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[poin].'" '.$nstt2.'></td>
	'; */
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd9 value='".$rows[isi]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='checkbox' $midname size=$mwd10 value='".$rows[retur]."' onclick=rumus1() disabled></td>
	";
	
	$midname='id="hb_'.$mnom.'" name="hb_'.$mnom.'"';
	echo '
			<td style="display:none"><input type="text" '.$midname.' size='.$mwd11.' value="'.$rows[hrgbeli].'" '.$nstt2.'></td>
	';
	
	echo "
		</tr>
	";

	$mnom++;
}

$mjum=$mnom-1;
$mnomx=1;
for ($mgg=$mnom;$mgg<100;$mgg++)
{
	if($rows[satuan]==$rows[satuan2])
	{
		$nstt='class="rcell" style="background-color:transparent; border:0; font-size:12pt" onkeypress=arah(this) onclick=arah(this) onfocus=arah2(this);this.select()';
	}
	else
	{
		$nstt='class="rcell" style="background-color:transparent; border:0; font-size:12pt; color:red" onkeypress=arah(this) onclick=arah(this) onfocus=arah2(this);this.select()';
	}
	
	//$mhii='hidden';
	if ($mnom==1)
	{
		$mhii='';
	}

	$mjrow=10;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";

	$mhh='';
	if ($mnomx>1)
	{
		$mhh='hidden';
	}
	echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25 $mhh>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text_$mnom' $midname size=$mwd2 onblur=ambilstok(this) value='' $nstt></td>
	";

	echo "
			<td><input type=text $nstt id=stoid_$mnom value='".$rows[stoid]."' size=$mwd21></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td ><input type='text_$mnom' $midname size=$mwd3 value='".$rows[stonama]."' $nstt></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo '
			<td><input type="text" '.$midname.' size='.$mwd4.' value="'.$rows[satuan].'" '.$nstt.'></td>
	';

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd5 value='".$rows[qty]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[hrgsat]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd7 value='".$rows[diskon]."' $nstt2></td>
	";
	
	$mjrow=$mjrow+1;
	$midname='id="18_'.$mnom.'" name="'.$mjrow.'_'.$mnom.'"';
	echo '
			<td><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[jmlhrg].'" '.$nstt2.'></td>
	';
	
	$midname='id="po_'.$mnom.'" name="po_'.$mnom.'"';
	echo '
			<td style="display:none"><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[poin].'" '.$nstt2.'></td>
	';
	/* echo '
			<td><input type="text" '.$midname.' size='.$mwd8.' value="'.$rows[poin].'" '.$nstt2.'></td>
	'; */
	
	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='text' $midname size=$mwd9 value='".$rows[isi]."' $nstt2></td>
	";

	$mjrow=$mjrow+1;
	$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
	echo "
			<td><input type='checkbox' $midname size=$mwd10 value='".$rows[retur]."' onclick=rumus1() disabled></td>
	";
	
	$midname='id="hb_'.$mnom.'" name="hb_'.$mnom.'"';
	echo '
			<td style="display:none"><input type="text" '.$midname.' size='.$mwd11.' value="'.$rows[hrgbeli].'" '.$nstt2.'></td>
	';
	
	echo "
		</tr>
	";

	$mnom++;
	$mnomx++;
}

echo("
	</table>
</div>
<div id='divsum' style='height:px; overflow:hidden; border-color:black; border-style:solid; border-width:1px; bgcolor:white;width:76vw'>
<input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'>
</div>
");
?>