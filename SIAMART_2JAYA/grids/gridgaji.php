<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:21px; overflow:hidden; background-image: url(images/nums.jpg); border-color:black; border-style:solid; border-width:1px; bgcolor:white'>
	<table border=1 cellpadding=0 cellspacing=0 style='background-image: url(images/nums.jpg); border-collapse:collapse'>
		<tr>
");

echo("
			<th rowspan=1> No. </th>
");
$mwd1='2 readonly';
echo("
			<th rowspan=1> Kode </th>
");
$mwd2='6 readonly';
echo("
			<th rowspan=1> Nama </th>
");
$mwd3='30 readonly';
echo("
			<th rowspan=1> Bagian </th>
");
$mwd4='8 readonly';
echo("
			<th rowspan=1> Grup </th>
");
$mwd5='20 readonly';
echo("
			<th rowspan=1> Jml.Bor</th>
");
$mwd6='10 readonly';
echo("
			<th rowspan=1> Jml.Tamb</th>
");
$mwd7='10';
echo("
			<th rowspan=1> Jam.Har</th>
");
$mwd8='10 readonly';
echo("
			<th rowspan=1> Jam.Lemb</th>
");
$mwd9='10 ';
echo("
			<th rowspan=1> Pot.Jam </th>
");
$mwd10='10';
echo("
		</tr>
");
echo("
		<tr>
		<th ><input size=$mwd1 type='text' disabled $msty></th>
		<th ><input size=$mwd2 type='text' disabled $msty></th>
		<th ><input size=$mwd3 type='text' disabled $msty></th>
		<th ><input size=$mwd4 type='text' disabled $msty></th>
		<th ><input size=$mwd5 type='text' disabled $msty></th>
		<th ><input size=$mwd6 type='text' disabled $msty></th>
		<th ><input size=$mwd7 type='text' disabled $msty></th>
		<th ><input size=$mwd8 type='text' disabled $msty></th>
		<th ><input size=$mwd9 type='text' disabled $msty></th>
		<th ><input size=$mwd10 type='text' disabled $msty></th>
		</tr>
	</table>
</div>
<div id='backtabel' style='background-image: url(images/backt.png); height:400px;border-color:black; border-style:solid; border-width:1px; overflow-y:scroll'>
	<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$mst=" and status=$mk";
if ($mk=='3')
{
	$mst='';
}

if ($mstatus=='')
{
	$query="
	select a.karid, a.karnama, a.grup, a.bagian, a.gaji, FORMAT(ifnull(b.kredit, 0), 0) borongan, jmlborongan
	from setkaryawan a
	left join
	(
		select bpid, count(*) jmlborongan, sum(kredit) kredit
		from bkbesar
		where rekid='20110' and tgl='$mtgl' and kredit>0
		group by bpid
	) b on a.karid=b.bpid
	where true
	order by karid
	";

	/*$query="select * from temporer limit 0,100";*/

	$rrw=executerow($query);

	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()";
		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()";
		$nstt4=" onkeypress=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";

		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text_$mnom' $midname size=$mwd2 value='".$rows[karid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text_$mnom' $midname size=$mwd3 value='".$rows[karnama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd4 value='".$rows[grup]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd5 value='".$rows[bagian]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[jmlborongan]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd7 value='".$rows[jmltambahan]."' $nstt2 ></td>
		";

		$query159=executerow("select time_to_sec(jam) jam from absensi where karid='".$rows[karid]."' and tgl='$mtgl' order by jam limit 0,1");
		$mrrr1=mysql_fetch_assoc ($query159);
		
		$query162=executerow("select time_to_sec(jam) jam from absensi where karid='".$rows[karid]."' and tgl='$mtgl' order by jam desc limit 0,1");
		$mrrr2=mysql_fetch_assoc ($query162);

		$mgh='';
		$ma=round((($mrrr2[jam]-$mrrr1[jam])/3600),2);
		$mb=intval($ma,0);
		$mc=$ma-$mb;
		$md=abs(intval($mc*60));

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd8 value='$mb.$md' $nstt2 ></td>
		";

		$mlembur1=$mb-8;
		$mlembur2=60-$md;
		if ((($mrrr2[jam]-$mrrr1[jam])-(8*3600))<0)
		{
			$mlembur1='';
			$mlembur2='';
		}

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd9 value='$mlembur1.$mlembur2' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd10 value='".$rows[jampotongan]."' $nstt2 ></td>
		";
		
		echo "
		</tr>
		";

		$mnom++;
	}
}

if ($mstatus=='Tervalidasi')
{
	$query="
	select a.*, b.karnama, b.grup, b.bagian
	from transgaji a
	left join setkaryawan b on a.karid=b.karid
	where tgl='$mtgl'
	order by a.karid
	";

	$rrw=executerow($query);

	$mnom=1;
	while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()";
		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()";
		$nstt4=" onkeypress=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";

		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text_$mnom' $midname size=$mwd2 value='".$rows[karid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text_$mnom' $midname size=$mwd3 value='".$rows[karnama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd4 value='".$rows[grup]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd5 value='".$rows[bagian]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd6 value='".$rows[borongan]."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd7 value='".$rows[tambahan]."' $nstt2 ></td>
		";

		$query274=executerow("select time_to_sec(jam) jam from absensi where karid='".$rows[karid]."' and tgl='$mtgl' order by jam limit 0,1");
		$mrrr1=mysql_fetch_assoc ($query274);
		
		$query277=executerow("select time_to_sec(jam) jam from absensi where karid='".$rows[karid]."' and tgl='$mtgl' order by jam desc limit 0,1");
		$mrrr2=mysql_fetch_assoc ($query277);
		
		$mgh='';
		$ma=round((($mrrr2[jam]-$mrrr1[jam])/3600),2);
		$mb=intval($ma,0);
		$mc=$ma-$mb;
		$md=abs(intval($mc*60));

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd8 value=".$rows[harian]." $nstt2 ></td>
		";

		$mlembur1=$mb-8;
		$mlembur2=60-$md;
		if ((($mrrr2[jam]-$mrrr1[jam])-(8*3600))<0)
		{
			$mlembur1='';
			$mlembur2='';
		}

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd9 value=".$rows[lembur]." $nstt2 ></td>
		";

		$mjrow=$mjrow+1;
		$midname="id='$mjrow".'_'."$mnom' name='$mjrow".'_'."$mnom'";
		echo "
			<td><input type='text' $midname size=$mwd10 value='".$rows[potongan]."' $nstt2 ></td>
		";
		
		echo "
		</tr>
		";

		$mnom++;
	}
}

$mjum=$mnom-1;

echo("
	</table>
</div>
<div id='divsum' style='overflow:hidden; border-color:black; border-style:solid; border-width:1px; bgcolor:white'>
<input type=text size=5 id='tabjumlah' value='$mjum' disabled style='text-align:center'>
</div>
");
?>