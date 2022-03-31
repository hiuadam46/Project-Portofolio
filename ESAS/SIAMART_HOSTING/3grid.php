<?php 
session_start();

require ('utama.php');

if ($_POST['mTform']=='setkaryawan')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg)' >
<tr>
<th align=right><input value='No.'   size=5  type='text' disabled $msty></th>
<th align=right><input value='Nota.'   size=8 type='text' disabled $msty></th>
<th align=right><input value='Tgl.'   size=8 type='text' disabled $msty></th>
<th align=right><input value='Total'   size=10 type='text' disabled $msty></th>
</tr>
</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:300px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select * from setkaryawan where karnama like '%$_POST[mfilt]%'";

$rrw=executerow($query);
$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' readonly  style='background-color:transparent;border:0;' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this)";
 		$nstt2=" class='rcell' readonly  style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this)";
 		$nstt3="  onkeypress=arah(this) onfocus=arah(this)";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii>
		<td><input value='$mnom.' type='text' id='1_$mnom'  name='1_$mnom'  size=5 align=right $nstt></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' size=8 value='.$rows[nid]].' $nstt></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' size=8 value='".$rows[tgl]."' $nstt></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' size=10 value='".$rows[total]."' $nstt2></td>
		</tr>";
		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='mlapjual')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg)' >
<tr>
<th align=right><input value='No.'   size=5  type='text' disabled $msty></th>
<th align=right><input value='Nota.'   size=8 type='text' disabled $msty></th>
<th align=right><input value='Tgl.'   size=8 type='text' disabled $msty></th>
<th align=right><input value='Pelanggan'   size=40 type='text' disabled $msty></th>
<th align=right><input value='Sales'   size=20 type='text' disabled $msty></th>
<th align=right><input value='Status'   size=5 type='text' disabled $msty></th>
<th align=right><input value='Jumlah'   size=10 type='text' disabled $msty></th>
</tr>
</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:450px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select 
a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,
concat(a.lgnid,'-',b.lgnnama) pelanggan,
concat(a.sales,'-',c.karnama) sales,
if (a.tunaikredit=1,'Kredit','Tunai') status,
FORMAT(jumlah,0) jumlah
from transjual1 a  left join setlgn b on a.lgnid=b.lgnid
left join setkaryawan c on a.sales=c.karid
where a.tgl between '$mt1' and '$mt2' and a.supid like '$ms%' and a.lgnid like '$ml%' and a.sales like '$me%' $mst
order by a.nid,a.tgl
";

$rrw=executerow($query);
$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' readonly  style='background-color:transparent;border:0;' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this)";
 		$nstt2=" class='rcell' readonly  style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this)";
 		$nstt3="  onkeypress=arah(this) onfocus=arah(this)";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii>
		<td><input value='$mnom.' type='text' id='1_$mnom'  name='1_$mnom'  size=5 align=right $nstt></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' size=8 value='".$rows[nid]."' $nstt></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' size=8 value='".$rows[tgl]."' $nstt></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' size=40 value='".$rows[pelanggan]."' $nstt></td>
		<td><input type='text' id='5_$mnom' name='5_$mnom' size=20 value='".$rows[sales]."' $nstt></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' size=5 value='".$rows[status]."' $nstt></td>
		<td><input type='text' id='7_$mnom' name='7_$mnom' size=10 value='".$rows[jumlah]."' $nstt2></td>
		<td><input type='button' id='8_$mnom' name='8_$mnom' value='Trans' onclick=trans('$rows[nid]')  $nstt3></td>
		<td><input type='button' id='9_$mnom' name='9_$mnom' value='Faktur' onclick=faktur('$rows[nid]')  $nstt3></td>
		<td><input type='button' id='10_$mnom' name='10_$mnom' value='F. Pajak' onclick=pajak('$rows[nid]')  $nstt3></td>
		</tr>";
		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='setksal')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode</td> 
<td bgcolor=lightblue align=center><b>Nama Pelanggan</td> 
<td bgcolor=lightblue align=center width=10%><b>Senin</td> 
<td bgcolor=lightblue align=center width=10%><b>Selasa</td> 
<td bgcolor=lightblue align=center width=10%><b>Rabu</td> 
<td bgcolor=lightblue align=center width=10%><b>Kamis</td> 
<td bgcolor=lightblue align=center width=10%><b>Jum'at</td> 
<td bgcolor=lightblue align=center width=10%><b>Sabtu</td> 
<td bgcolor=lightblue align=center width=10%><b>Minggu</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php' frameborder=0></iframe></td>
</tr>");

$query="
select a.lgnid,a.lgnnama,
if(b.hari is null,'','checked') sen,
if(c.hari is null,'','checked') sel,
if(d.hari is null,'','checked') rab,
if(e.hari is null,'','checked') kam,
if(f.hari is null,'','checked') jum,
if(g.hari is null,'','checked') sab,
if(h.hari is null,'','checked') min
from setlgn a 
left join (select * from setkunjungan where hari=1 and salesid='$msalesid') b  on a.lgnid=b.lgnid
left join (select * from setkunjungan where hari=2 and salesid='$msalesid') c  on a.lgnid=c.lgnid
left join (select * from setkunjungan where hari=3 and salesid='$msalesid') d  on a.lgnid=d.lgnid
left join (select * from setkunjungan where hari=4 and salesid='$msalesid') e  on a.lgnid=e.lgnid
left join (select * from setkunjungan where hari=5 and salesid='$msalesid') f  on a.lgnid=f.lgnid
left join (select * from setkunjungan where hari=6 and salesid='$msalesid') g  on a.lgnid=g.lgnid
left join (select * from setkunjungan where hari=7 and salesid='$msalesid') h  on a.lgnid=h.lgnid
where concat(a.lgnnama,a.kecamatan) like '%$mfilt%'
order by a.lgnid
";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}

		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td><input value='$mnom.' type='text' id='1_$mnom'  name='1_$mnom'  size=5 align=right class='rcell' readonly style='background-color:transparent;border:0;'></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=8 value='".$rows[lgnid]."' readonly style='background-color:transparent;border:0;'></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=45 value='".$rows[lgnnama]."' readonly style='background-color:transparent;border:0;'></td>
		<td align=center><input type='checkbox' id='4_$mnom' name='4_$mnom' class='rcell'  size=5 ".$rows[sen]."></td>
		<td align=center><input type='checkbox' id='5_$mnom' name='5_$mnom' class='rcell'  size=5 ".$rows[sel]."></td>
		<td align=center><input type='checkbox' id='6_$mnom' name='6_$mnom' class='rcell'  size=5 ".$rows[rab]."></td>
		<td align=center><input type='checkbox' id='7_$mnom' name='7_$mnom' class='rcell'  size=5 ".$rows[kam]."></td>
		<td align=center><input type='checkbox' id='8_$mnom' name='8_$mnom' class='rcell'  size=5 ".$rows[jum]."></td>
		<td align=center><input type='checkbox' id='9_$mnom' name='9_$mnom' class='rcell'  size=5 ".$rows[sab]."></td>
		<td align=center><input type='checkbox' id='10_$mnom' name='10_$mnom' class='rcell'  size=5 ".$rows[min]."></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td><input type='text' id='1_$mnom'  name='1_$mnom'  size=5 align=right class='rcell' readonly style='background-color:transparent;border:0;'></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=8 readonly style='background-color:transparent;border:0;'></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=45 readonly style='background-color:transparent;border:0;'></td>
		<td align=center><input type='checkbox' id='4_$mnom' name='4_$mnom' class='rcell'  size=5 ".$rows[sen]."></td>
		<td align=center><input type='checkbox' id='5_$mnom' name='5_$mnom' class='rcell'  size=5 ".$rows[sel]."></td>
		<td align=center><input type='checkbox' id='6_$mnom' name='6_$mnom' class='rcell'  size=5 ".$rows[rab]."></td>
		<td align=center><input type='checkbox' id='7_$mnom' name='7_$mnom' class='rcell'  size=5 ".$rows[kam]."></td>
		<td align=center><input type='checkbox' id='8_$mnom' name='8_$mnom' class='rcell'  size=5 ".$rows[jum]."></td>
		<td align=center><input type='checkbox' id='9_$mnom' name='9_$mnom' class='rcell'  size=5 ".$rows[sab]."></td>
		<td align=center><input type='checkbox' id='10_$mnom' name='10_$mnom' class='rcell'  size=5 ".$rows[min]."></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='mutagud')
{
$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode<br>[F5]</td> 
<td bgcolor=lightblue align=center width=70%><b>Nama Stok</td> 
<td bgcolor=lightblue align=center><b>Satuan<br>[F5]</td> 
<td bgcolor=lightblue align=center><b>Isi</td> 
<td bgcolor=lightblue align=center><b>Qty.<br>Dipindah</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select a.nomor,a.stoid,b.stonama,a.satid,a.qty,a.isi,a.lokid1,a.lokid2 from transmutasigudang a
left join setstok b on a.stoid=b.stoid where a.nid='$mnnid' order by nomor
";
	$msty=" style='background-color:transparent;border:0;' ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$rows[nomor]."' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[stoid]."' $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=80 value='".$rows[stonama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=8 value='".$rows[satid]."' $msty></td>
		<td><input type='text' id='5_$mnom' name='5_$mnom' class='rcell'  size=8 value='".$rows[isi]."' $msty2 disabled></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=10 value='".$rows[qty]."' $msty2></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' value='$mnom.' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='' disabled $msty2'></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='' $msty'></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='' disabled $msty'></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=8 value='' $msty'></td>
		<td><input type='text' id='5_$mnom' name='5_$mnom' class='rcell'  size=8 value='' $msty2' disabled></td>
		<td><input type='text' id='6_$mnom' name='6_$mnom' class='rcell'  size=10 value='' $msty2'></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='tkasmasuk')
{
$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode<br>[F5]</td> 
<td bgcolor=lightblue align=center width=70%><b>Nama Rekening</td> 
<td bgcolor=lightblue align=center><b>Jumlah<br>Dipindah</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select a.nomor,a.rekid,b.reknama,FORMAT(a.jumlah,0) jumlah from transkasmasuk a
left join setrek b on a.rekid=b.rekid where a.nid='$mnnid' order by nomor
";
	$msty=" style='background-color:transparent;border:0;' ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$rows[nomor]."' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[rekid]."' $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='".$rows[jumlah]."' $msty2></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' value='$mnom.' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='' disabled $msty2'></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='' $msty'></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='' disabled $msty'></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='' $msty2'></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='mlookrek')
{
$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode</td> 
<td bgcolor=lightblue align=center ><b>Nama Rekening</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select rekid,reknama from setrek where rekid<>'10010' and reknama like '%$mfilt%'
";
	$msty=" style='background-color:transparent;border:0;' ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
 
 
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=10 value='".$rows[rekid]."' readonly $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='tkaskeluar')
{
$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode<br>[F5]</td> 
<td bgcolor=lightblue align=center width=70%><b>Nama Rekening</td> 
<td bgcolor=lightblue align=center><b>Jumlah<br>Dipindah</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select a.nomor,a.rekid,b.reknama,FORMAT(a.jumlah,0) jumlah from transkaskeluar a
left join setrek b on a.rekid=b.rekid where a.nid='$mnnid' order by nomor
";
	$msty=" style='background-color:transparent;border:0;' ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$rows[nomor]."' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='".$rows[rekid]."' $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='".$rows[jumlah]."' $msty2></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' value='$mnom.' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='' disabled $msty2'></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=12 value='' $msty'></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='' disabled $msty'></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=10 value='' $msty2'></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='mlookrek')
{
$mjogs=$mjog;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' >
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center><b>Kode</td> 
<td bgcolor=lightblue align=center ><b>Nama Rekening</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select rekid,reknama from setrek where rekid<>'10010' and reknama like '%$mfilt%'
";
	$msty=" style='background-color:transparent;border:0;' ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;' ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
 
 
		echo "
		<tr id='bodiv_$mnom' $mhii>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=5 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text_$mnom' id='2_$mnom' name='2_$mnom' class='rcell' size=10 value='".$rows[rekid]."' readonly $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=50 value='".$rows[reknama]."' disabled $msty></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='tkontak')
{
$mjogs=$mjog;
$mjogs2=$mjog+2;
$mjogs2=($mjog*20)+30;
echo("
<div id='backtabel' style='border-color:black;border-style:solid;border-width:1px;'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse' width=100%>
<tr>
<td bgcolor=lightblue align=center><b>No.</td> 
<td bgcolor=lightblue align=center ><b>Nama</td> 
<td bgcolor=lightblue align=center ><b>Jabatan</td> 
<td bgcolor=lightblue align=center ><b>Telp</td> 
<td bgcolor=lightblue align=center ><b>Email</td> 
<td bgcolor=lightblue align=center rowspan=$mjogs2 valign=bottom><iframe width=17 height=$mjogs2 src='scroll.php?mjju=100' frameborder=0></iframe></td>
</tr>");

$query="
select * from setkontak where supid ='$msup' order by nomor
";
	$msty=" style='background-color:transparent;border:0;'  onfocus=foc(this) ";
	$msty2=" style='background-color:transparent;border:0;text-align:right;'  onfocus=foc(this) ";

	$rrw=executerow($query);
	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
 
 
		echo "
		<tr id='bodiv_$mnom' $mhii class='thetr'>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=4 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text' id='2_$mnom' name='2_$mnom' class='rcell'  size=30 value='".$rows[nama]."' $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=15 value='".$rows[jabatan]."' $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=20 value='".$rows[telp]."' $msty></td>
		<td><input type='text' id='5_$mnom' name='5_$mnom' class='rcell'  size=20 value='".$rows[email]."' $msty></td>
		</tr>";
		$mnom++;
	}

	for ($mii=$mnom;$mii<100;$mii++)
	{
		$mhii='';
		if ($mnom>$mjogs)
		{$mhii='hidden';}
		echo "
		<tr id='bodiv_$mnom' $mhii  class='thetr'>
		<td align=right><input type='text_$mnom' id='1_$mnom' name='1_$mnom' class='rcell' size=4 value='".$mnom.".' disabled $msty2></td>
		<td><input type='text' id='2_$mnom' name='2_$mnom' class='rcell'  size=30 value='' $msty></td>
		<td><input type='text' id='3_$mnom' name='3_$mnom' class='rcell'  size=15 value='' $msty></td>
		<td><input type='text' id='4_$mnom' name='4_$mnom' class='rcell'  size=20 value='' $msty></td>
		<td><input type='text' id='5_$mnom' name='5_$mnom' class='rcell'  size=20 value='' $msty></td>
		</tr>";
		$mnom++;
	}
	$mjum=$mnom-1;	

	echo("</table>
	<div style='background-color:grey' align=right><input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'></div>
	</div>
	");

return;
}
?>