<?php 
require ('utama.php');

if ($mTform=='setasset')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=8;$mwd3=8;$mwd4=30;$mwd5=15;$mwd6=15;$mwd7=10;$mwd7=20;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> Jenis </th>
<th> Seri </th>
<th> Uraian </th>
<th> Lokasi </th>
<th> Pen. jawab </th>
<th> Nilai </th>
<th> Catatan </th>
</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='text' disabled $msty></th>
<th  ><input size=$mwd8 type='checkbox' disabled $msty></th>
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
from setasset
where concat(jenis,seri,nama) like '%$mfilt%'
order by seri";

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
		value='".$rows[jenis]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[seri]."' $nstt readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd4
		value='".$rows[nama]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd5
		value='".$rows[lokasi]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd6
		value='".$rows[pemegang]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd7
		value='".number_format($rows[nilai],0,'.',',')."' $nstt2 readonly></td>
		";

		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text' $midname size=$mwd8
		value='".$rows[ket]."' $nstt readonly></td>
		";


		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='rekapsales')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=8;$mwd3=20;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> Kode [F6] </th>
<th> Nama </th>
</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:450px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.sales,b.karnama
from transjual1 a left join setkaryawan b on a.sales=b.karid 
where a.rekapid='$mrekap'
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
		value='".$rows[sales]."' $nstt onblur=ambilsales(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt readonly></td>
		";
		

		echo "</tr>";

		$mnom++;
	}

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
		<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 disabled></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[sales]."' $nstt onblur=ambilsales(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt disabled></td>
		";
		

		echo "</tr>";

		$mnom++;
	}
	
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='rekapnota')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=20;$mwd5=25;$mwd6=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Sales </th>
<th> Outlet </th>
<th> Jumlah </th>
<th  ><input type='button' id=ambilall value='-All-' onmouseup=ambilnota('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama) pelanggan,FORMAT(a.jumlah,0) jumlah
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
where tgl=$mtgl and sales in $msal and rekapid=''
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=100;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=30;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-99;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[sales]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Pilih' $nstt4 onmouseup=ambilnota('".$rows[nid]."') onclick=ambilnota('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='rekapnota2')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=20;$mwd5=25;$mwd6=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Sales </th>
<th> Outlet </th>
<th> Jumlah </th>
<th  ><input type='button' id=batalall value='-All-' onmouseup=hapusrekap('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama) pelanggan,FORMAT(a.jumlah,0) jumlah
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
where rekapid='$mrekap' and rekapid<>''
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=200;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=40;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-199;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[sales]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Batal' $nstt4 onclick=hapusrekap('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}


if ($mTform=='looksales')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=20;$mwd4=40;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> Kode </th>
<th> Nama </th>
<th> Suplier </th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:300px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.karid,a.karnama,concat(a.supid,' - ',b.supnama) suplier 
from setkaryawan a left join setsup b on a.supid=b.supid
where karnama like '%$mcari%' 
order by karid
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
 		$nstt4="  onkeydown=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[karid]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[suplier]."' $nstt readonly></td>
		";

		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

/*REKAP TAGIHAN*/
if ($mTform=='rekaptagihansales')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=8;$mwd3=20;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> Kode [F6] </th>
<th> Nama </th>
</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:450px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.sales,b.karnama
from transjual1 a left join setkaryawan b on a.sales=b.karid 
where a.tagihanid='$mrekap'
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
		value='".$rows[sales]."' $nstt onblur=ambilsales(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt readonly></td>
		";
		

		echo "</tr>";

		$mnom++;
	}

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
		<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 disabled></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[sales]."' $nstt onblur=ambilsales(this)></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[karnama]."' $nstt disabled></td>
		";
		

		echo "</tr>";

		$mnom++;
	}
	
	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='rekaptagihannota')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=50;$mwd5=10;$mwd6=10;$mwd7=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:20px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Outlet </th>
<th> Jumlah </th>
<th> Terbayar </th>
<th> Sisa </th>
<th  ><input type='button' id=ambilall value='-All-' onclick=ambilnota('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='text' disabled $msty></th>
<th  ><input type='button' disabled value='Pilih'></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}
$sales="";
if($msales!=''){$sales ="and a.sales='$msales'";}
$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama,', ',c.alamat) pelanggan,
FORMAT(a.jumlah,0) jumlah,FORMAT(ifnull(d.kredit,000000000000),0) terbayar,FORMAT(a.jumlah-ifnull(d.kredit,000000000000),0) sisa
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid 
left join (select nid2,bpid,sum(kredit) kredit from bkbesar where rekid='10210' group by nid2,bpid) d on a.nid=d.nid2 and a.lgnid=d.bpid
where concat(a.lgnid,c.alamat,c.lgnnama,a.nid) like '%$mcari%' and c.rute like '%$msupid%' and a.nid not in $mrekap $sales
and a.jumlah-ifnull(d.kredit,000000000000)>0
order by a.nid
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
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-0;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[terbayar]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd7
		value='".$rows[sisa]."' $nstt2 readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Pilih' $nstt4 onclick=ambilnota('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah1' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='rekaptagihannota2')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=50;$mwd5=10;$mwd6=10;$mwd7=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Outlet </th>
<th> Jumlah </th>
<th> Terbayar </th>
<th> Sisa </th>
<th  ><input type='button' id=ambilall value='-All-' onclick=hapusnota('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input size=$mwd6 type='text' disabled $msty></th>
<th  ><input size=$mwd7 type='text' disabled $msty></th>
<th  ><input type='button' disabled value='Batal'></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama,', ',c.alamat) pelanggan,
FORMAT(a.jumlah,0) jumlah,FORMAT(ifnull(d.kredit,000000000000),0) terbayar,FORMAT(a.jumlah-ifnull(d.kredit,000000000000),0) sisa
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
left join (select nid2,bpid,sum(kredit) kredit from bkbesar where rekid='10210' group by nid2,bpid) d on a.nid=d.nid2 and a.lgnid=d.bpid
where a.nid in $mrekap
order by a.nid
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=100;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=30;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-99;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[terbayar]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd7
		value='".$rows[sisa]."' $nstt2 readonly></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Batal' $nstt4 onclick=hapusnota('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah2' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='cariout')
{
echo("
</table>
");

$query="select * from setlgn where lgnnama like ''
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=100;
while ($rows=mysql_fetch_assoc($rrw))
	{
}
}

if ($mTform=='kontroljual')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=50;$mwd5=10;$mwd6=10;$mwd7=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:41px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Outlet </th>
<th> Jumlah </th>
<th> Status </th>
</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  >
		<select id='mstatusall' onchange=rubahstatus(this.value)>
		<option value='0' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<option value='1' >Sukses All</option>
		<option value='2' >Pending All</option>
		<option value='3' >Batal All</option>
		</select>
</th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:380px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.*,concat(a.lgnid,' - ',b.lgnnama) pelanggan 
from transjual1 a left join setlgn b on a.lgnid=b.lgnid
where concat(a.lgnid,b.alamat,b.lgnnama,a.nid) 
like '%$mcari%' and a.rekapid like '%$mrekapid%' and terkirim<>1 and rekapid<>''
order by nid
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
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".number_format($rows[jumlah],0,'.',',')."' $nstt2 readonly></td>
		";

		$msel1='';$msel2='';$msel3='';$msel4='';
		if($rows[terkirim]==1)
		{$msel1='';$msel2='selected';$msel3='';$msel4='';}
		if($rows[terkirim]==2)
		{$msel1='';$msel2='';$msel3='selected';$msel4='';}
		if($rows[terkirim]==3)
		{$msel1='';$msel2='';$msel3='';$msel4='selected';}
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td>
		<select $midname $nstt4 class='options'>
		<option value='0' $msel1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<option value='1' $msel2>Sukses</option>
		<option value='2' $msel3>Pending</option>
		<option value='3' $msel4>Batal</option>
		</select>
		</td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah2' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}


if ($mTform=='printjual')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=50;$mwd5=10;$mwd6=10;$mwd7=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:20px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Outlet </th>
<th> Jumlah </th>
<th  ><input type='button' id=ambilall value='-All-' onclick=ambilnota('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input type='button' disabled value='Pilih'></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama,', ',c.alamat) pelanggan,
FORMAT(a.jumlah,0) jumlah,FORMAT(ifnull(d.kredit,000000000000),0) terbayar,FORMAT(a.jumlah-ifnull(d.kredit,000000000000),0) sisa
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
left join (select nid2,bpid,sum(kredit) kredit from bkbesar where rekid='10210' group by nid2,bpid) d on a.nid=d.nid2 and a.lgnid=d.bpid
where concat(a.lgnid,c.alamat,c.lgnnama,a.nid) like '%$mcari%' and a.supid like '%$msupid%' and a.nid not in $mrekap
and a.tgl in (select tgl from periode where status=0)
order by a.nid
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
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-0;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";


		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Pilih' $nstt4 onclick=ambilnota('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah1' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

if ($mTform=='printjual2')
{
$mjogs=$mjog;
$mjogs2=$mjog*2;
$mwd1=2;$mwd2=10;$mwd3=10;$mwd4=50;$mwd5=10;$mwd6=10;$mwd7=10;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;background-image: url(images/nums.jpg);border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg);border-collapse:collapse' >

<tr>
<th> No. </th>
<th> No. Faktur</th>
<th> Tgl. Faktur</th>
<th> Outlet </th>
<th> Jumlah </th>
<th  ><input type='button' id=ambilall value='-All-' onclick=hapusnota('***')></th>

</tr>

<tr>
<th  ><input size=$mwd1  type='text' disabled $msty></th>
<th  ><input size=$mwd2 type='text' disabled $msty></th>
<th  ><input size=$mwd3 type='text' disabled $msty></th>
<th  ><input size=$mwd4 type='text' disabled $msty></th>
<th  ><input size=$mwd5 type='text' disabled $msty></th>
<th  ><input type='button' disabled value='Batal'></th>

</tr>

</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png);height:200px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}

$query="select a.nid,a.tgl,concat(a.sales,' - ',b.karnama) sales,concat(a.lgnid,' - ',c.lgnnama,', ',c.alamat) pelanggan,
FORMAT(a.jumlah,0) jumlah,FORMAT(ifnull(d.kredit,000000000000),0) terbayar,FORMAT(a.jumlah-ifnull(d.kredit,000000000000),0) sisa
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
left join (select nid2,bpid,sum(kredit) kredit from bkbesar where rekid='10210' group by nid2,bpid) d on a.nid=d.nid2 and a.lgnid=d.bpid
where a.nid in $mrekap
order by a.nid
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=100;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeydown=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeydown=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeydown=arah(this) onmousemove=arah(this) onfocus=arah(this);this.select()";
		$mjrow=30;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
 
		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		$mnomor=$mnom-99;
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "	
		<td><input value='$mnomor.' type='text' $midname size=$mwd1 $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[nid]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[tgl]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[pelanggan]."' $nstt readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[jumlah]."' $nstt2 readonly></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='button' $midname size=$mwd6
		value='Batal' $nstt4 onclick=hapusnota('".$rows[nid]."')></td>
		";
		
		echo "</tr>";

		$mnom++;
	}

	$mjum=$mnom-1;

	echo("</table>
	</div>
	<div style='background-color:grey' align=left><input type=text size=5 id='tabjumlah2' hidden value='$mjum' disabled style='text-align:center'></div>
	");

return;
}

?>