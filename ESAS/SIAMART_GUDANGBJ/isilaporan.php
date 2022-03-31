<?php
if($excel)
{
	@header('Content-Type: application/ms-excel');
	@header('Content-disposition: inline; filename="'.$mLapo.' '.date('d-m-Y').'.xls"');
}
?>
<html>

<head>
<title>Laporan Absensi</title>
<script type="text/javascript">
function printer()
{
	self.print();
	self.close();
	opener.focus();
}

function looktrans(mnid)
{
	mnd=mnid.substr(0,2)
	if (mnd='TB')
	{
		mswi="transbeli.php?mnid="+mnid
	}
	window.open(mswi)
}

function linktransjual()
{
	//alert(marg);
	window.open('transjual.php?mnid=TJ0000004');
}

</script>
</head>

<?php
require("utama.php");
execute("delete from bkbesar where debet=0 and kredit=0");
set_time_limit(0);
if ($isprint=='YY')
{
echo("
<Font face=Arial>
<body bgcolor=#FFFFFF name=wjual onload=printer() style='font-size:85%'>
<br>
");

}
else
{
echo("
<Font face=Arial style='font-size:85%'>
<body bgcolor=#FFFFFF name=wjual>
<br>
");
}

?><?php


if ($mLapo=='mlapabsensi')
{
$link=open_connection();
$sqlstr="select a.*,b.karnama,b.grup,b.bagian,date_format(tgl,'%d-%m-%Y') tgly from absensi a left join setkaryawan b on a.karid=b.karid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') 
and b.grup like '%$mkarid%' and b.bagian like '%$mbagian%'
group by karid
order by karid,jam
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
GUDANG BALI JAYA 
<br>
Laporan Absensi
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
<table width=50% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center><b>&nbsp;&nbsp;Grup&nbsp;&nbsp;</b></td>
<td bgcolor=#CCCCCC align=center><b>&nbsp;&nbsp;Bagian&nbsp;&nbsp;</b></td>
<td bgcolor=#CCCCCC align=center><b>&nbsp;&nbsp;$mtg1&nbsp;&nbsp;<br>WH</b></td>
");

$mttt=$mtg1;
$mnnn=1;
while ( date( "Y-m-d", strtotime( "$mttt")) < date( "Y-m-d", strtotime( "$mtg2")) )
{
$mtgt=date( "Y-m-d", strtotime( "$mtg1 +$mnnn day" ) );
echo ("<td bgcolor=#CCCCCC align=center><b>&nbsp;&nbsp;". date( "d-m-Y",strtotime( "$mtgt")) ."&nbsp;&nbsp;<br>WH</b></td>");
$mttt=$mtgt;
$mnnn++;
}
echo("
</tr>
");
$mnom=1;
while ($row = mysql_fetch_assoc ($result))
{
echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>$row[karid]</td>
<td bgcolor=#FFFFFF align=left>$row[karnama]</td>
<td bgcolor=#FFFFFF align=center>$row[grup]</td>
<td bgcolor=#FFFFFF align=center>$row[bagian]</td>
");

$mtg1x=date( "Y-m-d", strtotime( "$mtg1"));

$mtr1=execute("select time_to_sec(jam) jam,jam jam1 from absensi where tgl='$mtg1x' and karid='$row[karid]' order by jam limit 0,1");
$mtr2=execute("select time_to_sec(jam) jam,jam jam2 from absensi where tgl='$mtg1x' and karid='$row[karid]' order by jam limit 1,1");

$ma=(($mtr2[jam]-$mtr1[jam])/3600);
$mb=intval($ma,0);
$mc=$ma-$mb;
$md=abs(intval($mc*60));

$col="white";
if ($mb==0 and $md==0)
{
$col="pink";
$mb="O";
$md="ff";
}
if ($mb<0)
{
$col="lightyellow";
$mb="??";
$md="??";
}

echo("<td bgcolor=$col align=center> $mb.$md <br><font size=1> $mtr1[jam1] - $mtr2[jam2] </font></td>");

$mttt=$mtg1;
$mnnn=1;
while ( date( "Y-m-d", strtotime( "$mttt")) < date( "Y-m-d", strtotime( "$mtg2")) )
{

$mtg1x=date( "Y-m-d", strtotime( "$mtg1 +$mnnn day" ) );

$mtr1=execute("select time_to_sec(jam) jam,jam jam1 from absensi where tgl='$mtg1x' and karid='$row[karid]' order by jam limit 0,1");
$mtr2=execute("select time_to_sec(jam) jam,jam jam2 from absensi where tgl='$mtg1x' and karid='$row[karid]' order by jam limit 1,1");

$ma=(($mtr2[jam]-$mtr1[jam])/3600);
$mb=intval($ma,0);
$mc=$ma-$mb;
$md=abs(intval($mc*60));

$col="white";
if ($mb==0 and $md==0)
{
$col="pink";
$mb="O";
$md="ff";
}

if ($mb<0)
{
$col="lightyellow";
$mb="??";
$md="??";
}

echo("<td bgcolor=$col align=center> $mb.$md <br><font size=1> $mtr1[jam1] - $mtr2[jam2] </font></td>");

$mttt=$mtg1x;
$mnnn++;

}

echo("
</tr>
");

$mnom=$mnom+1;
}

echo("
</table>
");
}

?><?php
if ($mLapo=='mlapabsensi2')
{
$link=open_connection();
$sqlstr="select a.*,b.karnama,date_format(tgl,'%d-%m-%Y') tgly from absensi a left join setkaryawan b on a.karid=b.karid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') 
and a.karid like '%$mkarid%'
order by karid,jam
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
GUDANG BALI JAYA 
<br>
Laporan Absensi
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=50% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center><b>Jam</b></td>
<td bgcolor=#CCCCCC align=center><b>Tanggal</b></td>
</tr>
");
$mnom=1;
while ($row = mysql_fetch_assoc ($result))
{
echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>$row[karid]</td>
<td bgcolor=#FFFFFF align=left>$row[karnama]</td>
<td bgcolor=#FFFFFF align=center>$row[jam]</td>
<td bgcolor=#FFFFFF align=center>$row[tgly]</td>
</tr>
");

$mnom=$mnom+1;
}

echo("
</table>
");
}

?><?php
if ($mLapo=='mdfh')
{
$link=open_connection();
$sqlstr="
select a.supid,a.supnama,b.awal,c.kredit,c.debet,ifnull(b.awal,0)+ifnull(c.kredit,0)-ifnull(c.debet,0) saldo from 
setsup a
left join (select bpid,sum(kredit-debet) awal from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid='20010' group by bpid) b on a.supid=b.bpid
left join (select bpid,sum(kredit) kredit,sum(debet) debet from bkbesar where rekid='20010' and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') group by bpid) c on a.supid=c.bpid
order by a.supid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Daftar Hutang
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center><b>Awal</b></td>
<td bgcolor=#CCCCCC align=center><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo</b></td>
</tr>
");
$mnom=1;
$mtotdebet=0;
$mkredit=0;
$mtotawal=0;
$mtotsaldo=0;
while ($row = mysql_fetch_assoc ($result))
{
$mrekid=$row[supid];
$mreknama=$row[supnama];
$mawal=number_format($row[awal],0,',','.');
$mdebet=number_format($row[debet],0,',','.');
$mkredit=number_format($row[kredit],0,',','.');
$msaldo=number_format($row[saldo],0,',','.');

if ($mawal!='0' or $mdebet!='0' or $mkredit!='0' or $msaldo!='0')

{
echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>$mrekid</td>
<td bgcolor=#FFFFFF align=left>$mreknama</td>
<td bgcolor=#FFFFFF align=right>$mawal</td>
<td bgcolor=#FFFFFF align=right>$mkredit</td>
<td bgcolor=#FFFFFF align=right>$mdebet</td>
<td bgcolor=#FFFFFF align=right>$msaldo</td>
</tr>
");

$mnom=$mnom+1;
$mjjm=$row[jmlhrg];
$mjumlah=$mjumlah+$mjjm;
$mjumlahs=$mjumlahs+$mselisih;
$mtotdebet=$mtotdebet+($row[debet]);
$mtotkredit=$mtotkredit+($row[kredit]);
$mtotawal=$mtotawal+($row[awal]);
$mtotsaldo=$mtotsaldo+($row[saldo]);
}

}

$mtotawal=number_format($mtotawal,0,',','.');;
$mtotdebet=number_format($mtotdebet,0,',','.');;
$mtotkredit=number_format($mtotkredit,0,',','.');;
$mtotsaldo=number_format($mtotsaldo,0,',','.');;

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right><b>$mtotawal</td>
<td bgcolor=#FFFFFF align=right><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right><b>$mtotsaldo</td>
</tr>
</table>
");
}
?><?php
if ($mLapo=='mdfp')
{
$link=open_connection();
$sqlstr="
select a.lgnid,a.lgnnama,b.awal,c.kredit,c.debet,ifnull(b.awal,0)+ifnull(c.debet,0)-ifnull(c.kredit,0) saldo from 
setlgn a
left join (select bpid,sum(debet-kredit) awal from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid='10210' group by bpid) b on a.lgnid=b.bpid
left join (select bpid,sum(kredit) kredit,sum(debet) debet from bkbesar where rekid='10210' and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') group by bpid) c on a.lgnid=c.bpid
order by a.lgnid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Daftar Piutang
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center><b>Awal</b></td>
<td bgcolor=#CCCCCC align=center><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo</b></td>
</tr>
");
$mnom=1;
$mtotdebet=0;
$mkredit=0;
$mtotawal=0;
$mtotsaldo=0;
while ($row = mysql_fetch_assoc ($result))
{
$mrekid=$row[lgnid];
$mreknama=$row[lgnnama];
$mawal=number_format($row[awal],0,',','.');
$mdebet=number_format($row[debet],0,',','.');
$mkredit=number_format($row[kredit],0,',','.');
$msaldo=number_format($row[saldo],0,',','.');

if ($mawal!='0' or $mdebet!='0' or $mkredit!='0' or $msaldo!='0')

{

echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>$mrekid</td>
<td bgcolor=#FFFFFF align=left>$mreknama</td>
<td bgcolor=#FFFFFF align=right>$mawal</td>
<td bgcolor=#FFFFFF align=right>$mdebet</td>
<td bgcolor=#FFFFFF align=right>$mkredit</td>
<td bgcolor=#FFFFFF align=right>$msaldo</td>
</tr>
");

$mnom=$mnom+1;
$mjjm=$row[jmlhrg];
$mjumlah=$mjumlah+$mjjm;
$mjumlahs=$mjumlahs+$mselisih;
$mtotdebet=$mtotdebet+($row[debet]);
$mtotkredit=$mtotkredit+($row[kredit]);
$mtotawal=$mtotawal+($row[awal]);
$mtotsaldo=$mtotsaldo+($row[saldo]);
}

}

$mtotawal=number_format($mtotawal,0,',','.');;
$mtotdebet=number_format($mtotdebet,0,',','.');;
$mtotkredit=number_format($mtotkredit,0,',','.');;
$mtotsaldo=number_format($mtotsaldo,0,',','.');;

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right><b>$mtotawal</td>
<td bgcolor=#FFFFFF align=right><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right><b>$mtotsaldo</td>
</tr>
</table>
");
}
?>

<?php
if ($mLapo=='mdfs')
{
	$link=open_connection();

	if ($msaldo=='Semua')
	{
		$msal="true";
	}

	if ($msaldo=='Minimal')
	{
		$msal="ifnull(b.awalq,0)+ifnull(c.qtyin,0)-ifnull(c.qtyout,0)<=a.minimal";
	}

	if ($msaldo=='Saldo')
	{
		$msal="ifnull(b.awalq,0)+ifnull(c.qtyin,0)-ifnull(c.qtyout,0)<>0";
	}

	$sqlstr="
	select a.stoid, a.stonama, a.supid, a.isi, a.isi2, a.satuan1, a.satuan2, a.satuan3, b.awal, c.kredit, c.debet, ifnull(b.awal, 0)+ifnull(c.debet, 0)-ifnull(c.kredit, 0) saldo, b.awalq, c.qtyin debetq, c.qtyout kreditq, ifnull(b.awalq, 0)+ifnull(c.qtyin, 0)-ifnull(c.qtyout, 0) saldoq
	from setstok a
	left join (
		select bpid, sum(debet-kredit) awal, sum(qtyin-qtyout) awalq
		from bkbesar
		where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid like '103%' and bpid2 like '$mlokid%'
		group by bpid) b on a.stoid=b.bpid
	left join (
		select bpid, sum(kredit) kredit, sum(debet) debet, sum(qtyin) qtyin, sum(qtyout) qtyout
		from bkbesar
		where rekid like '103%' and tgl between str_to_date('$mtg1', '%d-%c-%Y') and str_to_date('$mtg2', '%d-%c-%Y') and bpid2 like '$mlokid%'
		group by bpid ) c on a.stoid=c.bpid
	where a.supid like '%$msupid%' and grpid like '%$mgrpid%' and $msal
	order by a.stoid
	";

	/*
	$sqlstr="
	select a.stoid,a.stonama,a.supid,a.isi,a.isi2,a.satuan1,a.satuan2,a.satuan3 
	from setstok a
	where a.supid like '%$msupid%' and grpid like '%$mgrpid%'
	order by a.stoid ";
	*/

	$result2 = mysql_query ("select supid, supnama from setsup where supid='$msupid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row2 = mysql_fetch_assoc ($result2);
	$msup=$row2[supid].' '.$row2[supnama];

	$result3 = mysql_query ("select grpid, grpnama from setgrp where grpid='$mgrpid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row3 = mysql_fetch_assoc ($result3);
	$mgrup=$row3[grpid].' '.$row3[grpnama];

	$result4 = mysql_query ("select lokid, loknama from setlok where lokid='$mlokid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row4 = mysql_fetch_assoc ($result4);
	$mlok=$row4[lokid].' '.$row4[loknama];

	echo("
	Laporan Daftar Stok
	<br>Tgl. $mtg1 s.d. $mtg2
	<br>
	<br>$msup | $mgrup | $mlok
	");

	$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

	echo("
	<font size='2pts'>
	<br>
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
		<tr>
			<td bgcolor=#CCCCCC align=center><b>No.</b></td> 
			<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
			<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
			<td bgcolor=#CCCCCC align=center><b>Awal Qty</b></td>	
			<td bgcolor=#CCCCCC align=center><b>Qty In</b></td>	
			<td bgcolor=#CCCCCC align=center><b>Qty Out</b></td>	
			<td bgcolor=#CCCCCC align=center><b>Saldo Qty</b></td>	
		</tr>
	");

	$mtotdebet=0;
	$mkredit=0;
	$mtotawal=0;
	$mtotsaldo=0;
	$mnom=1;

	while ($row = mysql_fetch_assoc ($result))
	{
		$mrekid=$row[stoid];
		$mreknama=$row[stonama];
		$mawal=number_format($row[awal],0,',','.');
		$mdebet=number_format($row[debet],0,',','.');
		$mkredit=number_format($row[kredit],0,',','.');
		$row[saldo]=$row[awal]+$row[debet]-$row[kredit];
		$msaldo=number_format($row[saldo],0,',','.');
		$mawalq=cqty($row[awalq],$row[isi],$row[isi2],$row[satuan1],$row[satuan2],$row[satuan3]);
		$mdebetq=cqty($row[debetq],$row[isi],$row[isi2],$row[satuan1],$row[satuan2],$row[satuan3]);
		$mkreditq=cqty($row[kreditq],$row[isi],$row[isi2],$row[satuan1],$row[satuan2],$row[satuan3]);
		$row[saldoq]=$row[awalq]+$row[debetq]-$row[kreditq];
		$msaldoq=cqty($row[saldoq],$row[isi],$row[isi2],$row[satuan1],$row[satuan2],$row[satuan3]);

		echo("
		<tr>
			<td bgcolor=#FFFFFF align=right><font size=2>$mnom.</font></td>
			<td bgcolor=#FFFFFF align=left><font size=2>$mrekid</font></td>
			<td bgcolor=#FFFFFF align=left><font size=2>$mreknama</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$mawalq</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$mdebetq</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$mkreditq</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$msaldoq</font></td>
			
		</tr>
		");

		$mnom=$mnom+1;
		$mtotdebet=$mtotdebet+($row[debet]);
		$mtotkredit=$mtotkredit+($row[kredit]);
		$mtotawal=$mtotawal+($row[awal]);
		$mtotsaldo=$mtotsaldo+($row[saldo]);
	}

	
	echo("
		<tr> 
			<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL</td>
			<td bgcolor=#FFFFFF align=right><b>$mtotawal</td>
			<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
			<td bgcolor=#FFFFFF align=right><b>$mtotdebet</td>
			<td bgcolor=#FFFFFF align=right><b>$mtotsaldo</td>
		</tr>
	</table>
	</font>
	");
}
?>

<?php
if ($mLapo=='mdfss')
{
	$link=open_connection();

	if ($msaldo=='Semua')
	{
		$msal="true";
	}

	if ($msaldo=='Minimal')
	{
		$msal="ifnull(b.awalq,0)+ifnull(c.qtyin,0)-ifnull(c.qtyout,0)<=a.minimal";
	}

	if ($msaldo=='Saldo')
	{
		$msal="ifnull(b.awalq,0)+ifnull(c.qtyin,0)-ifnull(c.qtyout,0)<>0";
	}

	$sqlstr="
	select a.stoid, a.stonama, a.supid, a.isi, a.isi2, a.satuan1, a.satuan2, a.satuan3, a.hrgjual3, b.awal, c.kredit, c.debet, ifnull(b.awal, 0)+ifnull(c.debet, 0)-ifnull(c.kredit, 0) saldo, b.awalq, c.qtyin debetq, c.qtyout kreditq, ifnull(b.awalq, 0)+ifnull(c.qtyin, 0)-ifnull(c.qtyout, 0) saldoq
	from setstok a
	left join (
		select bpid, sum(debet-kredit) awal, sum(qtyin-qtyout) awalq
		from bkbesar
		where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid like '103%' and bpid2 like '$mlokid%'
		group by bpid) b on a.stoid=b.bpid
	left join (
		select bpid, sum(kredit) kredit, sum(debet) debet, sum(qtyin) qtyin, sum(qtyout) qtyout
		from bkbesar
		where rekid like '103%' and tgl between str_to_date('$mtg1', '%d-%c-%Y') and str_to_date('$mtg2', '%d-%c-%Y') and bpid2 like '$mlokid%'
		group by bpid ) c on a.stoid=c.bpid
	where a.supid like '%$msupid%' and grpid like '%$mgrpid%' and $msal
	order by a.stoid
	";
	
	$result2 = mysql_query ("select supid, supnama from setsup where supid='$msupid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row2 = mysql_fetch_assoc ($result2);
	$msup=$row2[supid].' '.$row2[supnama];

	$result3 = mysql_query ("select grpid, grpnama from setgrp where grpid='$mgrpid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row3 = mysql_fetch_assoc ($result3);
	$mgrup=$row3[grpid].' '.$row3[grpnama];

	$result4 = mysql_query ("select lokid, loknama from setlok where lokid='$mlokid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
	$row4 = mysql_fetch_assoc ($result4);
	$mlok=$row4[lokid].' '.$row4[loknama];

	echo("
	Laporan Daftar Stok (Sales)
	<br>Tgl. $mtg1 s.d. $mtg2
	<br>
	<br>$msup | $mgrup | $mlok
	");

	$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

	echo("
	<font size='2pts'>
	<br>
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
		<tr>
			<td bgcolor=#CCCCCC align=center><b>No.</b></td> 
			<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
			<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
			<td bgcolor=#CCCCCC align=center><b>Harga Jual</b></td>
			<td bgcolor=#CCCCCC align=center><b>Saldo Qty</b></td>
		</tr>
	");

	$mnom=1;

	while ($row = mysql_fetch_assoc ($result))
	{
		$mrekid=$row[stoid];
		$mreknama=$row[stonama];
		$mawal=number_format($row[hrgjual3],0,',','.');
		$row[saldo]=$row[awal]+$row[debet]-$row[kredit];
		
		$row[saldoq]=$row[awalq]+$row[debetq]-$row[kreditq];
		$msaldoq=cqty($row[saldoq],$row[isi],$row[isi2],$row[satuan1],$row[satuan2],$row[satuan3]);

		echo("
		<tr>
			<td bgcolor=#FFFFFF align=right><font size=2>$mnom.</font></td>
			<td bgcolor=#FFFFFF align=left><font size=2>$mrekid</font></td>
			<td bgcolor=#FFFFFF align=left><font size=2>$mreknama</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$mawal</font></td>
			<td bgcolor=#FFFFFF align=right><font size=2>$msaldoq</font></td>
		</tr>
		");

		$mnom=$mnom+1;
	}
	
	echo("
	</table>
	</font>
	");
}


if ($mLapo=='mlapbelinota')
{
$ttk=" true ";

if ($mtk=='Tunai')
{ $ttk=" bayar >= jumlah ";}

if ($mtk=='Kredit')
{ $ttk=" bayar < jumlah ";}

/* $sqlstr="select a.*,b.supnama, date_format(tgl,'%d-%m-%Y') tglc, date_format(tgljt,'%d-%m-%Y') tgljtc
from transbeli1 a left join setsup b on a.supid=b.supid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid%' order by a.nid,a.tgl
"; */

$sqlstr="select a.*, b.supid, c.supnama, date_format(a.tgl,'%d-%m-%Y') tglc, date_format(b.tgljt,'%d-%m-%Y') tgljtc, sum(a.jmlhrg) as jumlah
from transbeli2 as a
left join transbeli1 as b on a.nid=b.nid
left join setsup c on b.supid=c.supid
left join setstok as d on a.stoid=d.stoid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.supid like '!!$msupid%' and d.grpid like '$mppn'
group by nid
";

if ($mppn=='%')
{
echo("
TOKO BALI JAYA
<br>
Laporan Pembelian Per Nota
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");
}

if ($mppn=='G001')
{
echo("
TOKO SUMBER SARI (PPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
<br>
Laporan Pembelian Per Nota
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");
}

if ($mppn=='G002')
{
echo("
TOKO SUMBER SARI (NonPPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
<br>
Laporan Pembelian Per Nota
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");
}

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Suplier</th>
<th>Nama Suplier</th>
<th>Nota</th>
<th>Tgl.</th>
<th>Jumlah</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$totPIUTANG=0;

while ($mrr=mysql_fetch_object($maa))
{
if($mrr->kembali > 0){
$tunai = ($mrr->edc+$mrr->bayar)-$mrr->kembali;
}else{
$tunai = ($mrr->edc+$mrr->bayar);
}
if($mrr->jumlah == $tunai){
//$tottunai=$tottunai+$mrr->jumlah;
$tunai = $mrr->jumlah;
$piutang = 0;
}else{
$piutang = $mrr->lunas;
$totPIUTANG=$totPIUTANG+$mrr->bayar;
$tunai = $mrr->bayar;
}

if ($mppn=='G001')
{
$ppn='PPNB'.str_repeat('0',7-strlen($nn)).$nn;
echo "
<tr valign= height=25>
<td>$nn</td>
<td>$mrr->supid</td>
<td>$mrr->supnama</td>
<td> <a href onclick=openjual('$mrr->nid')> $ppn </a></td>
<td>$mrr->tglc</td>
<td align=right>".number_format($mrr->jumlah,0,'.',',')."</td>
</td>
</tr>
";
}
else
{
echo "
<tr valign= height=25>
<td>$nn</td>
<td>$mrr->supid</td>
<td>$mrr->supnama</td>
<td> <a href onclick=openjual('$mrr->nid')> $mrr->nid </a></td>
<td>$mrr->tglc</td>
<td align=right>".number_format($mrr->jumlah,0,'.',',')."</td>
</td>
</tr>
";
}

$totot=$totot+$mrr->jumlah;
$tottunai += $tunai;
$tottotal += ($mrr->jumlah-$tunai);
$totretur=$totretur+$mrr->retur;
$totlunas=$totlunas+$piutang;
$totsisa=$totsisa+(($mrr->jumlah-$tunai)-$mrr->retur-$piutang);
//$totkomisi=$totkomisi+($mrr->total*$mrr->gaji*0.01);
$nn++;
}

echo "
<tr valign=bottom>
<td colspan=5>&nbsp;<br></td>
<td align=right><b>".number_format($totot,0,'.',',')."</td>
</tr>
";
}

?>

<?php
if ($mLapo=='mnrcljr')
{
$link=open_connection();
$sqlstr="
select a.rekid,a.reknama,b.awaldebet,b.awalkredit,c.kredit,c.debet,t.dork from 
setrek a
left join (select rekid,sum(debet) awaldebet,sum(kredit) awalkredit from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') group by rekid) b on a.rekid=b.rekid
left join (select rekid,sum(debet) debet,sum(kredit) kredit from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') group by rekid) c on a.rekid=c.rekid
left join setneraca r on a.nrcid=r.nrcid left join setklas t on r.clid=t.clid
order by a.rekid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Neraca Lajur
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center><b>Awal Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Awal Kredit</b></td>
<td bgcolor=#CCCCCC align=center><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo Kredit</b></td>
</tr>
");
$mnom=1;
$mtotdebet=0;
$mkredit=0;
$mtotawald=0;
$mtotawalk=0;
$mtotsaldod=0;
$mtotsaldok=0;
while ($row = mysql_fetch_assoc ($result))
{
$mrekid=$row[rekid];
$mreknama=$row[reknama];
$mdk=$row[dork];

$mawal=$row[awaldebet]-$row[awalkredit];
if ($mawal>0)
{
$mawaldebet=$mawal;
$mawalkredit=0;
}
else
{
$mawaldebet=0;
$mawalkredit=abs($mawal);
}

$makhir=$row[awaldebet]-$row[awalkredit]+$row[debet]-$row[kredit];
if ($makhir>0)
{
$msaldodebet=$makhir;
$msaldokredit=0;
}
else
{
$msaldodebet=0;
$msaldokredit=abs($makhir);
}

$mtotdebet=$mtotdebet+($row[debet]);
$mtotkredit=$mtotkredit+($row[kredit]);
$mtotawald =$mtotawald+($row[awaldebet]);
$mtotawalk =$mtotawalk+($row[awalkredit]);
$mtotsaldod=$mtotsaldod+$msaldodebet;
$mtotsaldok=$mtotsaldok+$msaldokredit;

$mawaldebet=number_format($mawaldebet,0,',','.');
$mawalkredit=number_format($mawalkredit,0,',','.');

$mdebet=number_format($row[debet],0,',','.');
$mkredit=number_format($row[kredit],0,',','.');

$msaldodebet=number_format($msaldodebet,0,',','.');
$msaldokredit=number_format($msaldokredit,0,',','.');

if ($mawaldebet!='0' or $mawalkredit!='0' or $mdebet!='0' or $mkredit!='0' or $msaldodebet!='0' or $msaldokredit!='0')
{
echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>$mrekid $row[dork]</td>
<td bgcolor=#FFFFFF align=left>$mreknama</td>
<td bgcolor=#FFFFFF align=right>$mawaldebet</td>
<td bgcolor=#FFFFFF align=right>$mawalkredit</td>
<td bgcolor=#FFFFFF align=right>$mdebet</td>
<td bgcolor=#FFFFFF align=right>$mkredit</td>
<td bgcolor=#FFFFFF align=right>$msaldodebet</td>
<td bgcolor=#FFFFFF align=right>$msaldokredit</td>
</tr>
");
$mnom=$mnom+1;
}

}

$mtotawald=number_format($mtotawald,0,',','.');;
$mtotawalk=number_format($mtotawalk,0,',','.');;
$mtotdebet=number_format($mtotdebet,0,',','.');;
$mtotkredit=number_format($mtotkredit,0,',','.');;
$mtotsaldod=number_format($mtotsaldod,0,',','.');;
$mtotsaldok=number_format($mtotsaldok,0,',','.');;

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL&nbsp;&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>$mtotawald</td>
<td bgcolor=#FFFFFF align=right><b>$mtotawalk</td>
<td bgcolor=#FFFFFF align=right><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right><b>$mtotsaldod</td>
<td bgcolor=#FFFFFF align=right><b>$mtotsaldok</td>
</tr>
</table>
");
}
?><?php
if ($mLapo=='mkrtstok')
{

$link=open_connection();

$sqlstr="
select date_format(str_to_date('$mtg1','%d-%c-%Y'),'%d-%m-%Y') tgl,
'SA' nid,'Saldo Awal' ket,sum(debet-kredit) saldorp,sum(qtyin-qtyout) saldoqty
from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid like '103%' and bpid='$mstoid' and bpid2 like '$mlokid%'
";
$rowawal = execute($sqlstr);

$sqlstr="select * from setstok where stoid='$mstoid' ";
$rowstok = execute($sqlstr);
$mi1=$rowstok[isi];
$mi2=$rowstok[isi2];
$msat1=$rowstok[satuan1];
$msat2=$rowstok[satuan2];
$msat3=$rowstok[satuan3];
$mstonama=$rowstok[stonama];

$sqlstr2="
select date_format(tgl,'%d-%m-%Y') tgl,bpid2,nid,ket,sum(debet) debet,sum(kredit) kredit,sum(qtyin) qtyin,sum(qtyout) qtyout,000000000 saldoqty,000000000 saldoharga
from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and rekid like '103%' and bpid='$mstoid' and bpid2 like '$mlokid%'
group by tgl,nid,debet
order by tgl 
";
$result2 = mysql_query ($sqlstr2) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

mysql_close($link);

$mnom=1;
$msaldorp=$rowawal[saldorp];
$msaldoqty=$rowawal[saldoqty];

echo("
Laporan Kartu Stok
<br>Tgl. $mtg1 s.d. $mtg2
<br>Stok $mstoid $mstonama
<br>Lokasi $mlokid $mloknama
<br>
<font size='2pts'>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></td> 
<td bgcolor=#CCCCCC align=center rowspan=2><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Nomor</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Keterangan</b></td>
<td bgcolor=#CCCCCC align=center colspan=2><b>In</b></td>
<td bgcolor=#CCCCCC align=center colspan=2><b>Out</b></td>
<td bgcolor=#CCCCCC align=center colspan=2><b>Saldo</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Harga</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Lok.</b></td>

</tr>
<td bgcolor=#CCCCCC align=center><b>Qty</b></td>
<td bgcolor=#CCCCCC align=center><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center><b>Qty</b></td>
<td bgcolor=#CCCCCC align=center><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo</b></td>
<td bgcolor=#CCCCCC align=center><b>Saldo Rp.</b></td>
<tr>
</tr>

<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</b></td> 
<td bgcolor=#FFFFFF align=left>".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".cqty($msaldoqty,$mi1,$mi2,$msat1,$msat2,$msat3)."</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
</tr>

");

$mnom=$mnom+1;
$mqin=0;
$mqout=0;
$mdebet=0;
$mkredit=0;

while ($row = mysql_fetch_assoc ($result2))
{

$msaldorp=$msaldorp+($row[debet])-($row[kredit]);
$msaldoqty=$msaldoqty+($row[qtyin])-($row[qtyout]);
$mharga=0;
if ($row[qtyout]!=0)
{
$mharga=$row[kredit]/$row[qtyout];
}
if ($row[qtyin]!=0)
{
$mharga=$row[debet]/$row[qtyin];
}

$mqin=$mqin+$row[qtyin];
$mqout=$mqout+$row[qtyout];
$mdebet=$mdebet+$row[debet];
$mkredit=$mkredit+$row[kredit];

echo("
<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</td> 
<td bgcolor=#FFFFFF align=left> ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left><a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left>".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right>".cqty($row[qtyin],$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".cqty($row[qtyout],$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".cqty($msaldoqty,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($mharga,0,',','.')."</td>
<td bgcolor=#FFFFFF align=center>".$row[bpid2]."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>".cqty($mqin,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>".cqty($mqout,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?><?php
if ($mLapo=='mkrtsup')
{

$link=open_connection();

$sqlstr="
select date_format(str_to_date('$mtg1','%d-%c-%Y'),'%d-%m-%Y') tgl,
'SA' nid,'Saldo Awal' ket,sum(kredit-debet) saldorp
from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid='20010' and bpid='$msupid'
";
$rowawal = execute($sqlstr);

$sqlstr="select * from setsup where supid='$msupid' ";
$rowstok = execute($sqlstr);
$msupnama=$rowstok[supnama];

$sqlstr2="
select date_format(tgl,'%d-%m-%Y') tgl,nid,ket,debet,kredit
from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and rekid='20010' and bpid='$msupid'
order by ts,tgl
";
$result2 = mysql_query ($sqlstr2) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

mysql_close($link);

$mnom=1;
$msaldorp=$rowawal[saldorp];

echo("
Laporan Kartu Hutang
<br>Tgl. $mtg1 s.d. $mtg2
<br>Suplier $msupid $msupnama
<br>
<font size='2pts'>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center rowspan=1><b>No.</b></td> 
<td bgcolor=#CCCCCC align=center rowspan=1><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Nomor</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Keterangan</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Saldo</b></td>

<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</b></td> 
<td bgcolor=#FFFFFF align=left>".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</b></td>
</tr>

");

$mnom=$mnom+1;
$mqin=0;
$mqout=0;
$mdebet=0;
$mkredit=0;

while ($row = mysql_fetch_assoc ($result2))
{

$msaldorp=$msaldorp+($row[kredit])-($row[debet]);
$mdebet=$mdebet+$row[debet];
$mkredit=$mkredit+$row[kredit];

echo("
<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</td> 
<td bgcolor=#FFFFFF align=left> ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left><a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left>".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?><?php
if ($mLapo=='mkrtlgn')
{

$link=open_connection();

$sqlstr="
select date_format(str_to_date('$mtg1','%d-%c-%Y'),'%d-%m-%Y') tgl,
'SA' nid,'Saldo Awal' ket,sum(debet-kredit) saldorp
from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid='10210' and bpid='$mlgnid'
";
$rowawal = execute($sqlstr);

$sqlstr="select * from setlgn where lgnid='$mlgnid' ";
$rowstok = execute($sqlstr);
$mlgnnama=$rowstok[lgnnama];

$sqlstr2="
select date_format(tgl,'%d-%m-%Y') tgl,nid,ket,debet,kredit
from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and rekid='10210' and bpid='$mlgnid'
order by ts,tgl
";
$result2 = mysql_query ($sqlstr2) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

mysql_close($link);

$mnom=1;
$msaldorp=$rowawal[saldorp];

echo("
Laporan Kartu Piutang
<br>Tgl. $mtg1 s.d. $mtg2
<br>Pelanggan $mlgnid $mlgnnama
<br>
<font size='2pts'>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center rowspan=1><b>No.</b></td> 
<td bgcolor=#CCCCCC align=center rowspan=1><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Nomor</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Keterangan</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Saldo</b></td>

<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</b></td> 
<td bgcolor=#FFFFFF align=left>".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</b></td>
</tr>

");

$mnom=$mnom+1;
$mqin=0;
$mqout=0;
$mdebet=0;
$mkredit=0;

while ($row = mysql_fetch_assoc ($result2))
{

$msaldorp=$msaldorp+($row[debet])-($row[kredit]);
$mdebet=$mdebet+$row[debet];
$mkredit=$mkredit+$row[kredit];

echo("
<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</td> 
<td bgcolor=#FFFFFF align=left> ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left><a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left>".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?><?php
if ($mLapo=='mkrtrek')
{

$link=open_connection();

$sqlstr="
select date_format(str_to_date('$mtg1','%d-%c-%Y'),'%d-%m-%Y') tgl,
'SA' nid,'Saldo Awal' ket,sum(debet-kredit) saldorp
from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid='$mrekid'
";
$rowawal = execute($sqlstr);

$sqlstr="select a.*,c.dork from setrek a left join setneraca b on a.nrcid=b.nrcid left join setklas c on b.clid=c.clid where rekid='$mrekid' ";
$rowstok = execute($sqlstr);
$mreknama=$rowstok[reknama];
$mdork=$rowstok[dork];

$sqlstr2="
select date_format(tgl,'%d-%m-%Y') tgl,nid,ket,debet,kredit
from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and rekid='$mrekid' 
order by ts,tgl
";
$result2 = mysql_query ($sqlstr2) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

mysql_close($link);

$mnom=1;
$msaldorp=$rowawal[saldorp];

echo("
Laporan Buku Besar
<br>Tgl. $mtg1 s.d. $mtg2
<br>Rekening $mrekid $mreknama ($mdork)
<br>
<font size='2pts'>
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<td bgcolor=#CCCCCC align=center rowspan=1><b>No.</b></td> 
<td bgcolor=#CCCCCC align=center rowspan=1><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Nomor</b></td>
<td bgcolor=#CCCCCC align=center rowspan=1><b>Keterangan</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center colspan=1><b>Saldo</b></td>

<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</b></td> 
<td bgcolor=#FFFFFF align=left>".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left>".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center>&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</b></td>
</tr>

");

$mnom=$mnom+1;
$mqin=0;
$mqout=0;
$mdebet=0;
$mkredit=0;

while ($row = mysql_fetch_assoc ($result2))
{

$msaldorp=$msaldorp+($row[debet])-($row[kredit]);
$mdebet=$mdebet+$row[debet];
$mkredit=$mkredit+$row[kredit];

echo("
<tr>
<td bgcolor=#FFFFFF align=right>".$mnom.".</td> 
<td bgcolor=#FFFFFF align=left> ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left><a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left>".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right>".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr> 
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?><?php
if ($mLapo=='mSetup')
{
$msize=2;

echo "<font size=5>$detitle</font>";

$msql="SELECT sum(ifnull(NUMERIC_PRECISION,0)+ifnull(CHARACTER_MAXIMUM_LENGTH,0)) kon
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_gudangbj_data' and TABLE_NAME='$mtabelnya'
";

if ($mkol!='')
{
$msql="SELECT sum(ifnull(NUMERIC_PRECISION,0)+ifnull(CHARACTER_MAXIMUM_LENGTH,0)) kon
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_gudangbj_data' and TABLE_NAME='$mtabelnya'
and COLUMN_NAME in ($mkol)
";
}

$rwwc=execute($msql);
$mpan=$rwwc[kon];


$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH panjang2,COLUMN_COMMENT koment
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_gudangbj_data' and TABLE_NAME='$mtabelnya'
";

if ($mkol!='')
{
$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH panjang2,COLUMN_COMMENT koment
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_gudangbj_data' and TABLE_NAME='$mtabelnya' and COLUMN_NAME in ($mkol)
";
}

$rww=executerow($msql);

echo "<br><table border=1 cellspacing=1 cellpadding=0 bgcolor='grey' style='border-collapse:collapse;font-size:85%'> 
<tr>
<td align=right bgcolor=lightgrey>No.</td>
";

while ($row=mysql_fetch_assoc($rww))
{

$mtit=$row[kolom];
if ($mtit!='')
{

$mpan=$row[panjang2]*5;

if ($mpan>300)
{
$mpan=300;
}
//$mpand=round((($row[panjang1]+$row[panjang2])/$mpan)*100,0);


echo "
<td align=center bgcolor=lightgrey width=$mpand%>&nbsp;$mtit&nbsp;</td>
";

}

}
echo "</tr>";

$kond=$kondisi;
if ($kond=='')
{
$kond='1=1';
}

$rww2=executerow("select * from $mtabelnya where $kond ");
//echo "select * from $mtabelnya where $kond ";

$mnom=1;
while ($row2=mysql_fetch_array($rww2))
{

echo "<tr>
<td bgcolor=white><font size=$msize>".$mnom.".&nbsp;</font></td>
";

$rww=executerow($msql);
while ($row=mysql_fetch_assoc($rww))
{

$mtits=$row[koment];
//if ($mtits!='')
//{

$mtit=$row[kolom];

$mtipe=$row[tipe];
$malign='left';

if ($mtipe=='numeric' or $mtipe=='decimal')
{
echo "
<td bgcolor=white align=right>&nbsp;<font size=$msize>&nbsp;&nbsp;".number_format($row2[$mtit],0,'.',',')."&nbsp;</font></td>
";
}
else
{
echo "
<td bgcolor=white>&nbsp;<font size=$msize>".$row2[$mtit]."&nbsp;</font></td>
";
}

//}

}

echo "</tr>";
$mnom++;
}

echo "</table>";
}
?><?php
if ($mLapo=='mnrcc')
{

$mtgt=date( "Y-m-d", strtotime( "$mtg1 +1 month -1 day" ) );
$mtga=date( "Y-01-01", strtotime( "$mtg1" ) );
$mtg1s=date( "Y-m-d", strtotime( "$mtg1 -1 day" ) );
$mtgakh=date( "d", strtotime( "$mtg1 +1 month -1 day" ) );

echo("
Laporan Neraca
<br>Per $mtgakh $mper 
<br><br>
<table cellspacing=2 border=1 width=80%>
<tr><th width=50% colspan=2>Aset</th><th width=50% colspan=2>Kewajiban dan Kekayaan</th></tr>
<tr><td width=50% colspan=2>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
");

$ttr=executerow("select * from setklas where posisi='A' order by clid");
while ($mrow=mysql_fetch_assoc($ttr))
{
echo "<tr><td colspan=2><b>$mrow[clnama]</b></td></tr>";

$ttr2=executerow("select * from setneraca where clid='$mrow[clid]' order by nrcid");
$mtot=0;
while ($mrow2=mysql_fetch_assoc($ttr2))
{

$mjumm=execute("select sum(debet-kredit) jumlah from bkbesar a left join setrek b on a.rekid=b.rekid where b.nrcid='$mrow2[nrcid]' and (a.tgl<='$mtgt' or trans='SA')");

echo "<tr><td>&nbsp;-$mrow2[nrcnama]</td><td align=right> ".number_format($mjumm[jumlah],0,'.',',')." &nbsp;</td></tr>" ;

$mtot=$mtot+$mjumm[jumlah];
$mtot2=$mtot2+$mjumm[jumlah];

}

echo "<tr><td><b><hr>Total $mrow[clnama]</b></td><td align=right><b><hr width=80%>".number_format($mtot,0,'.',',')." &nbsp;</b></td></tr>
<tr><td>&nbsp;</td></tr>
";

}

echo("</table>
</td><td valign=top colspan=2><table border=0 cellspacing=0 cellpadding=0 width=100%>
");

$ttr=executerow("select * from setklas where posisi='P' order by clid");
while ($mrow=mysql_fetch_assoc($ttr))
{
echo "<tr><td colspan=2><b>$mrow[clnama]</b></td></tr>";

$ttr2=executerow("select * from setneraca where clid='$mrow[clid]' order by nrcid");
$mtot=0;
while ($mrow2=mysql_fetch_assoc($ttr2))
{

$mjumm=execute("select sum(kredit-debet) jumlah from bkbesar a left join setrek b on a.rekid=b.rekid where b.nrcid='$mrow2[nrcid]' and (a.tgl<='$mtgt' or trans='SA')");
$mrek=$mjumm[jumlah];

if ($mrow2[nrcid]=='213')
{
$mjumm1=execute("select sum(kredit-debet) jumlah from bkbesar a left join setrek b on a.rekid=b.rekid left join setneraca c on b.nrcid=c.nrcid left join setklas d on c.clid=d.clid where d.posisi in ('D','B') and ( a.tgl between '$mtg1' and '$mtgt') ");
$mrek=$mrek+$mjumm1[jumlah];
}

if ($mrow2[nrcid]=='212')
{
$mjumm1=execute("select sum(kredit-debet) jumlah from bkbesar a left join setrek b on a.rekid=b.rekid left join setneraca c on b.nrcid=c.nrcid left join setklas d on c.clid=d.clid where d.posisi in ('D','B') and a.tgl between '$mtga' and '$mtg1s' ");
$mrek=$mrek+$mjumm1[jumlah];
}

if ($mrow2[nrcid]=='211')
{
$mjumm1=execute("select sum(kredit-debet) jumlah from bkbesar a left join setrek b on a.rekid=b.rekid left join setneraca c on b.nrcid=c.nrcid left join setklas d on c.clid=d.clid where d.posisi in ('D','B') and a.tgl<'$mtga' ");
$mrek=$mrek+$mjumm1[jumlah];
}

echo "<tr><td>&nbsp;-$mrow2[nrcnama]</td><td align=right> ".number_format($mrek,0,'.',',')." &nbsp;</td></tr>" ;

$mtot=$mtot+$mrek;
$mtot3=$mtot3+$mrek;

}

echo "<tr><td><b><hr>Total $mrow[clnama]</b></td><td align=right><b><hr width=80%>".number_format($mtot,0,'.',',')." &nbsp;</b></td></tr>
<tr><td>&nbsp;</td></tr>
";

}

echo("</table>

</td></tr>

<tr><td width=25%><b>Total Aset</td><td width=25% align=right><b>".number_format($mtot2,0,'.',',')." &nbsp;</td><td width=25%><b> Total Kewajiban dan Kekayaan</td><td width=25% align=right><b>".number_format($mtot3,0,'.',',')." &nbsp;</td></tr>

</table>
");

}
?><?php
if ($mLapo=='mdfpnota')
{

if ($mk=='B')
{
$mwhh=" and a.debet-ifnull(c.kredit,0)>0 ";
}

if ($mk=='L')
{
$mwhh=" and a.debet-ifnull(c.kredit,0)<=0 ";
}

if ($mk=='S')
{
$mwhh=" ";
}

if ($mt=='A')
{
$mwhh2=" and a.tgl between '$mt1' and '$mt2' ";
}

if ($mt=='B')
{
$mwhh2=" and a.tgl2 between '$mt1' and '$mt2' ";
}



$link=open_connection();
$sqlstr="
select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,date_format(a.tgl2,'%d-%m-%Y') tgl2,a.bpid,b.lgnnama,a.debet,ifnull(c.kredit,0) kredit,datediff(now(),a.tgl2) sisatgl 
from bkbesar a 
left join setlgn b on a.bpid=b.lgnid
left join (select bpid,nid2,sum(kredit) kredit from bkbesar where kredit<>0 and rekid='10210' group by nid2,bpid) c on a.nid=c.nid2 and a.bpid=c.bpid
left join transjual1 d on a.nid=d.nid
where rekid='10210' and debet<>0
and a.bpid like '$ml%'
and d.supid like '$ms%'
and d.sales like '$me%'
$mwhh $mwhh2
order by a.tgl,a.nid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
$mdd='parent';
if ($isprint=='YY')
{
	//
$mdd='opener';
}
echo("
<script type='text/javascript'>
fff=$mdd.document.fform
document.write($mdd.document.title)
document.write('<br><br>')
for (var e = 0; e < fff.length; e++) {
abc=fff.elements[e].title
def=fff.elements[e].value
if (fff.elements[e].type=='select-one')
{
def=fff.elements[e].options[fff.elements[e].selectedIndex].text
}	
document.write(abc+' : '+def+'&nbsp;&nbsp;&nbsp;')
}

</script>
awdawd
<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<th bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Nota</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Tgl.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Tgl. Jt.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Hari</b></th>
<th bgcolor=#CCCCCC align=center colspan=2><b>Outlet</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Jumlah</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Lunas</b></th>
</tr>
<tr>
<th bgcolor=#CCCCCC align=center><b>Kode</b></th>
<th bgcolor=#CCCCCC align=center><b>Nama</b></th>
</tr>
");
$mnom=1;
$mt1=0;
$mt2=0;
while ($row = mysql_fetch_assoc ($result))
{

echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>".$row[nid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left>".$row[tgl2]."</td>
<td bgcolor=#FFFFFF align=right>".$row[sisatgl]." </td>
<td bgcolor=#FFFFFF align=left>".$row[bpid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[lgnnama]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,'.',',')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+$row[debet];
$mt2=$mt2+$row[kredit];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=7><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,'.',',')." </td>
</table>
");
}

?><?php
if ($mLapo=='lapbukujual')
{

if ($mk=='B')
{
$mwhh=" and a.debet-ifnull(c.kredit,0)>0 ";
}

if ($mk=='L')
{
$mwhh=" and a.debet-ifnull(c.kredit,0)<=0 ";
}

if ($mk=='S')
{
$mwhh=" ";
}

if ($mt=='A')
{
$mwhh2=" and a.tgl between '$mt1' and '$mt2' ";
}

if ($mt=='B')
{
$mwhh2=" and a.tgl2 between '$mt1' and '$mt2' ";
}



$link=open_connection();
$sqlstr="
select a.*,b.*,c.lgnnama,c.alamat,d.karnama,e.stonama from 
transjual1 a left join 
transjual2 b on a.nid=b.nid 
left join setlgn c on a.lgnid=c.lgnid 
left join setkaryawan d on a.sales=d.karid 
left join setstok e on b.stoid=e.stoid 
where a.supid like '$ms%'
and a.sales like '$me%'
and a.lgnid like '$ml%'
and e.grpid like '$mg%'
and e.merkid like '$mm%'
order by a.tgl,a.nid
";


$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
$mdd='parent';
if ($isprint=='YY')
{
$mdd='opener';
}
echo("
<script type='text/javascript'>
fff=$mdd.document.fform
document.write($mdd.document.title)
document.write('<br><br>')
for (var e = 0; e < fff.length; e++) {
abc=fff.elements[e].title
def=fff.elements[e].value
if (fff.elements[e].type=='select-one')
{
def=fff.elements[e].options[fff.elements[e].selectedIndex].text
}	
document.write(abc+' : '+def+'&nbsp;&nbsp;&nbsp;')
}

</script>

<table width=150% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<th bgcolor=#CCCCCC align=center><b>No.</b></th>
<th bgcolor=#CCCCCC align=center><b>OUTLET</b></th> 	
<th bgcolor=#CCCCCC align=center><b>NAMA OUTLET</b></th> 	
<th bgcolor=#CCCCCC align=center><b>ALAMAT</b></th>	
<th bgcolor=#CCCCCC align=center><b>KD SLS</b></th>	
<th bgcolor=#CCCCCC align=center><b>NAMA SALES</b></th>	
<th bgcolor=#CCCCCC align=center><b>TGLFAKTUR</b></th> 	
<th bgcolor=#CCCCCC align=center><b>NO.FAKTUR</b></th> 	
<th bgcolor=#CCCCCC align=center><b>PCODE</b></th> 	
<th bgcolor=#CCCCCC align=center><b>NAMA BARANG</b></th> 	
<th bgcolor=#CCCCCC align=center><b>HARGA(RP)</b></th> 	
<th bgcolor=#CCCCCC align=center><b>QTY</b></th> 	
<th bgcolor=#CCCCCC align=center><b>JUMLAH BRUTTO</b></th> 	
<th bgcolor=#CCCCCC align=center><b>REG.DISC</b></th> 	
<th bgcolor=#CCCCCC align=center><b>EXT.DISC</b></th> 	
<th bgcolor=#CCCCCC align=center><b>PROMO UANG</b></th> 	
<th bgcolor=#CCCCCC align=center><b>TOTAL</b></th>
</tr>
");
$mnom=1;
$mt1=0;
$mt2=0;
while ($row = mysql_fetch_assoc ($result))
{
//$mdp=($row[diskonp])-($row[diskonp]*$row[diskonp]*0.01);
//$mdp=($mdp)-($mdp*$row[diskonp2]*0.01);
//$mdp=$mdp*$row[qty];
$mdp=$row[diskonp].'%+'.$row[diskonp2].'%';
$mdp2=$row[diskonp3].'%+'.$row[diskonp4].'%';
echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>".$row[lgnid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[lgnnama]."</td>
<td bgcolor=#FFFFFF align=left>".$row[alamat]."</td>
<td bgcolor=#FFFFFF align=left>".$row[sales]."</td>
<td bgcolor=#FFFFFF align=left>".$row[karnama]." </td>
<td bgcolor=#FFFFFF align=left>".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left>".$row[nid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[stoid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[stonama]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[hrgsat],0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[qty],0,'.',',').' '.$row[satid]." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[hrgsat]*$row[qty],0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".$mdp." </td>
<td bgcolor=#FFFFFF align=right>".$mdp2." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[diskonrp]+$row[diskonrp2],0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[jmlhrg],0,'.',',')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+($row[hrgsat]*$row[qty]);
$mt2=$mt2+$row[jmlhrg];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=12><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,'.',',')." </td>
</table>
");
}

?><?php
if ($mLapo=='mdfhnota')
{

if ($mk=='B')
{
$mwhh=" and a.kredit-ifnull(c.debet,0)>0 ";
}

if ($mk=='L')
{
$mwhh=" and a.kredit-ifnull(c.debet,0)<=0 ";
}

if ($mk=='S')
{
$mwhh=" ";
}

if ($mt=='A')
{
$mwhh2=" and a.tgl between '$mt1' and '$mt2' ";
}

if ($mt=='B')
{
$mwhh2=" and a.tgl2 between '$mt1' and '$mt2' ";
}



$link=open_connection();
$sqlstr="
select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,date_format(a.tgl2,'%d-%m-%Y') tgl2,a.bpid,b.supnama,a.kredit,ifnull(c.debet,0) debet,datediff(now(),a.tgl2) sisatgl 
from bkbesar a 
left join setsup b on a.bpid=b.supid
left join (select bpid,nid2,sum(debet) debet from bkbesar where debet<>0 and rekid='20010' group by nid2,bpid) c on a.nid=c.nid2 and a.bpid=c.bpid
left join transbeli1 d on a.nid=d.nid
where rekid='20010' and kredit<>0
and a.bpid like '$ml%'
and d.supid like '$ms%'
$mwhh $mwhh2
order by a.tgl,a.nid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
$mdd='parent';
if ($isprint=='YY')
{
$mdd='opener';
}
echo("
<script type='text/javascript'>
fff=$mdd.document.fform
document.write($mdd.document.title)
document.write('<br><br>')
for (var e = 0; e < fff.length; e++) {
abc=fff.elements[e].title
def=fff.elements[e].value
if (fff.elements[e].type=='select-one')
{
def=fff.elements[e].options[fff.elements[e].selectedIndex].text
}	
document.write(abc+' : '+def+'&nbsp;&nbsp;&nbsp;')
}

</script>

<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 
<tr>
<th bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Nota</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Tgl.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Tgl. Jt.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Hari</b></th>
<th bgcolor=#CCCCCC align=center colspan=2><b>Outlet</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Jumlah</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2><b>Lunas</b></th>
</tr>
<tr>
<th bgcolor=#CCCCCC align=center><b>Kode</b></th>
<th bgcolor=#CCCCCC align=center><b>Nama</b></th>
</tr>
");
$mnom=1;
$mt1=0;
$mt2=0;
while ($row = mysql_fetch_assoc ($result))
{

echo("
<tr>
<td bgcolor=#FFFFFF align=right>$mnom.</td>
<td bgcolor=#FFFFFF align=left>".$row[nid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left>".$row[tgl2]."</td>
<td bgcolor=#FFFFFF align=right>".$row[sisatgl]." </td>
<td bgcolor=#FFFFFF align=left>".$row[bpid]."</td>
<td bgcolor=#FFFFFF align=left>".$row[supnama]."</td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,'.',',')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+$row[kredit];
$mt2=$mt2+$row[debet];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=7><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,'.',',')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,'.',',')." </td>
</table>
");
}

if ($mLapo=='mlapomsetsal')
{

$sqlstr="select a.sales,sum(total) total,b.karnama,b.gaji,b.gaji*sum(total) komisi 
from transjual1 a left join setkaryawan b on a.sales=b.karid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
group by a.sales
";

echo(" 
GUDANG BALI JAYA 
<br>
Laporan Omset Sales
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=50% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Sales</th>
<th>Nama Sales</th>
<th>Jumlah Omset</th>
<th>Jumlah Komisi</th>
</tr>

";

$nn=1;

$total=0;
$total2=0;

while ($mrr=mysql_fetch_assoc($maa))
{

echo "
<tr valign=bottom>
<td>$nn</td>
<td>$mrr[sales]</td>
<td>$mrr[karnama]</td>
<td align=right>".number_format($mrr[total],0,'.',',')."</td>
<td align=right>".number_format($mrr[komisi],0,'.',',')."</td>
</tr>
";

$total=$total+$mrr[total];
$total2=$total2+$mrr[komisi];

}


echo "

<tr valign=top>
<td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>".number_format($total,0,'.',',')."</td>
<td align=right><b>".number_format($total2,0,'.',',')."</td>
</tr>

";


}


if ($mLapo=='mlapjual2')
{


echo(" 
GUDANG BALI JAYA
<br>
Laporan Barang Keluar
<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$sqlstr="select a.tgl,a.nid,b.stoid,d.stonama,b.qty,b.unit,d.satuan1,d.satuan2,b.hrgsat,b.diskonp,b.jmlhrg,c.lgnnama
from transjual1 a left join setlgn c on a.lgnid=c.lgnid
left join transjual2 b on a.nid=b.nid
left join setstok d on b.stoid=d.stoid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.lgnid like '!!$mlgnid!!' order by a.nid,a.tgl
";

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

echo "
Dijual
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Tgl</th>
<th>Nomor</th>
<th>Pelanggan</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Unit</th>
<th>Jumlah</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_object($maa))
{

$mnomor++;

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$mrr->tgl</td>
<td>$mrr->nid</td>
<td>$mrr->lgnnama</td>
<td>$mrr->stoid</td>
<td>$mrr->stonama</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->qty,0,'.',',')."&nbsp;</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->unit,0,'.',',')."&nbsp;</td>
<td align=right>".number_format($mrr->jmlhrg,0,'.',',')."&nbsp;</td>
</tr>
";

$mtotal=$mtotal+$mrr->jmlhrg;

$nn++;

}

echo "

<tr height=25>
<td colspan=6 align=right><b>TOTAL&nbsp</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalqty,0,'.',',')."&nbsp;</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalunit,0,'.',',')."&nbsp;</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotal,0,'.',',')."&nbsp;</td>
</tr>

</table>
<br><br>
";

$sqlstr="select a.tgl,a.nid,b.stoid,d.stonama,b.qty,b.unit,d.satuan1,d.satuan2,b.hrgsat,b.diskonp,b.jmlhrg,c.supnama
from transreturbeli1 a left join setsup c on a.supid=c.supid
left join transreturbeli2 b on a.nid=b.nid
left join setstok d on b.stoid=d.stoid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$mlgnid!!' order by a.nid,a.tgl
";

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

echo "
Retur
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Tgl</th>
<th>Nomor</th>
<th>Suplier</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Unit</th>
<th>Jumlah</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_object($maa))
{

$mnomor2++;

echo "
<tr>
<td align=right>$mnomor2.</td>
<td>$mrr->tgl</td>
<td>$mrr->nid</td>
<td>$mrr->supnama</td>
<td>$mrr->stoid</td>
<td>$mrr->stonama</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->qty,0,'.',',')."&nbsp;</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->unit,0,'.',',')."&nbsp;</td>
<td align=right>".number_format($mrr->jmlhrg,0,'.',',')."&nbsp;</td>
</tr>
";

$mtotalqty2=$mtotalqty2+$mrr->qty;
$mtotalunit2=$mtotalunit2+$mrr->unit;
$mtotal2=$mtotal2+$mrr->jmlhrg;

$nn++;

}

echo "

<tr height=25>
<td colspan=6 align=right><b>TOTAL&nbsp</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalqty2,0,'.',',')."&nbsp;</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalunit2,0,'.',',')."&nbsp;</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotal2,0,'.',',')."&nbsp;</td>
</tr>

</table>
<br><br>
";

}



if ($mLapo=='mlapjual3')
{

$sqlstr="select a.*,b.lgnnama
from transjual1 a left join setlgn b on a.lgnid=b.lgnid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and total<>0
and a.nid like '!!$mnotaid!!' and a.lgnid like '$mlgnid%' order by a.tgl,a.nid
";

echo(" 
GUDANG BALI JAYA 
<br>
Laporan Penjualan
<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Sat.</th>
<th>Jumlah</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_object($maa))
{

echo "
<tr valign=bottom>
<td>&nbsp;<br>$nn</td>
<td colspan=5>
&nbsp;&nbsp;Kode : $mrr->nid 
&nbsp;&nbsp;&nbsp; Tgl : $mrr->tgl 
&nbsp;&nbsp;&nbsp; Pelanggan : $mrr->lgnid - $mrr->lgnnama 
</td>
</tr>
";

$mss=executerow("select a.*,b.stonama,b.satuan1,b.satuan2,barcode from transjual2 a left join setstok b on a.stoid=b.stoid where a.nid='$mrr->nid'  and a.stoid like '$mstoid%' order by nomor");
$mnomor=1;
$mtotqty=0;
while ($msx=mysql_fetch_object($mss))
{

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->stoid</td>
<td>$msx->stonama</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($msx->qty,0,'.',',')."</td>
<td>&nbsp;$msx->satuan1</td>
<td align=right>".number_format($msx->jmlhrg,0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotqty=$mtotqty+$msx->qty;

}


echo "

<tr valign=top>
<td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>".number_format($mtotqty,0,'.',',')."</td>
<td colspan=2></td>
</tr>

";


$nn++;

}

echo "


</table>
<br><br>
";

}





if ($mLapo=='mlapbeli2')
{

$sqlstr="select a.tgl,a.nid,b.stoid,d.stonama,b.qty,b.unit,d.satuan1,d.satuan2,b.hrgsat,b.diskonp,b.jmlhrg,c.supnama
from transbeli1 a left join setsup c on a.supid=c.supid
left join transbeli2 b on a.nid=b.nid
left join setstok d on b.stoid=d.stoid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid!!' order by a.nid,a.tgl
";

echo(" 
GUDANG BALI JAYA
<br>
Laporan Barang Masuk
<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Tgl</th>
<th>Nomor</th>
<th>Suplier</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Unit</th>
<th>Jumlah</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_object($maa))
{

$mnomor++;

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$mrr->tgl</td>
<td>$mrr->nid</td>
<td>$mrr->supnama</td>
<td>$mrr->stoid</td>
<td>$mrr->stonama</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->qty,0,'.',',')."&nbsp;</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($mrr->unit,0,'.',',')."&nbsp;</td>
<td align=right>".number_format($mrr->jmlhrg,0,'.',',')."&nbsp;</td>
</tr>
";

$mtotalqty=$mtotalqty+$mrr->qty;
$mtotalunit=$mtotalunit+$mrr->unit;
$mtotal=$mtotal+$mrr->jmlhrg;

$nn++;

}

echo "

<tr height=25>
<td colspan=6 align=right><b>TOTAL&nbsp</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalqty,0,'.',',')."&nbsp;</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($mtotalunit,0,'.',',')."&nbsp;</td>
<td colspan=2>&nbsp;</td>

</tr>

</table>
<br><br>
";

}


if ($mLapo=='mlapjualkasir')
{

execute("drop table if exists tbkbesar");

$ttk=" true ";

if ($mtk=='Tunai')
{ $ttk=" bayar>=jumlah ";}

if ($mtk=='Kredit')
{ $ttk=" bayar<jumlah ";}

if ($mur=='nama')
{ $urut=" stonama ";}

if ($mur=='qty')
{ $urut=" qty desc ";}

if ($mur=='rp')
{ $urut=" jmlhrg desc ";}

$sqlstr="select a.bpid stoid,sum(a.qtyout-a.qtyin) qty,sum(a.kredit-a.debet) hpp,b.stonama,b.isi,b.satuan1,b.satuan2,sum(d.jmlhrg) jmlhrg
from bkbesar a left join setstok b on a.bpid=b.stoid
left join transkasir1 c on a.nid=c.nid left join transkasir2 d on a.nid=d.nid and a.bpid=d.stoid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.grpid like '%$mgrpid%'
and c.kasir like '!!$mkasir!!' and c.lgnid like '!!$mlgnid!!' and a.trans='TRANSKASIR' and a.rekid like '103%' 
and $ttk and b.supid like '$msupid%'
group by a.bpid,if(a.qtyout>0,'A','B') order by $urut
";

$sqlstr="
select * from 
(
select a.stoid,sum(a.qty*a.isi) qty,d.hpp,b.stonama,b.isi,b.satuan1,b.satuan2,sum(a.jmlhrg) jmlhrg
from transkasir2 a left join setstok b on a.stoid=b.stoid
left join transkasir1 c on a.nid=c.nid left join (select a.nid,bpid,sum(kredit-debet) hpp from bkbesar a left join transkasir1 b on a.nid=b.nid where b.kasir like '%$mkasir%' and rekid='10310' and kredit>0 and trans='TRANSKASIR' 
and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') group by bpid) d on a.stoid=d.bpid
where a.qty>0 and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.grpid like '%$mgrpid%'
and c.kasir like '!!$mkasir!!' and c.lgnid like '!!$mlgnid!!' 
and $ttk and b.supid like '$msupid%'
group by a.stoid 
) a
union
select * from (
select a.stoid,sum(a.qty*a.isi) qty,d.hpp,b.stonama,b.isi,b.satuan1,b.satuan2,sum(a.jmlhrg) jmlhrg
from transkasir2 a left join setstok b on a.stoid=b.stoid
left join transkasir1 c on a.nid=c.nid left join (select a.nid,bpid,sum(kredit-debet) hpp from bkbesar a left join transkasir1 b on a.nid=b.nid where b.kasir like '%$mkasir%' and rekid='10310' and debet>0 and trans='TRANSKASIR' 
and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') group by bpid) d on a.stoid=d.bpid
where a.qty<0 and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.grpid like '%$mgrpid%'
and c.kasir like '!!$mkasir!!' and c.lgnid like '!!$mlgnid!!' 
and $ttk and b.supid like '$msupid%'
group by a.stoid 
) b order by $urut,qty desc
";

$mlgg=execute("select lgnnama from setlgn where lgnid='$mlgnid' ");

echo(" 
GUDANG BALI JAYA 
<br>
Laporan Penjualan Kasir
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
Kasir : $mkasir Pelanggan : $mlgnid $mlgg[lgnnama] <br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Jumlah</th>
<th>HPP</th>
<th>Selisih</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

$mnomor=1;
$mtotal=0;
$mtotal2=0;
while ($msx=mysql_fetch_assoc($maa))
{

if ($msx[qty]<0)
{
$mbac=" bgcolor=yellow ";
}
else
{
$mbac=" bgcolor=white ";
}
echo "
<tr $mbac>
<td align=right>$mnomor.</td>
<td>$msx[stoid]</td>
<td>$msx[stonama]</td>
<td align=right>".cqty($msx[qty],$msx[isi],1,$msx[satuan1],$msx[satuan2],'')."</td>
<td align=right>".number_format($msx[jmlhrg],0,'.',',')."</td>
<td align=right>".number_format($msx[hpp],0,'.',',')."</td>
<td align=right>".number_format($msx[jmlhrg]-$msx[hpp],0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotal=$mtotal+$msx[jmlhrg];
$mtotal2=$mtotal2+$msx[hpp];

}

$wrr2=execute("select sum(jumlah) jumlah ,sum(diskon) diskon,sum(if (bayar<jumlah and bayar<>0,bayar,0)) um from transkasir1 where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and kasir like '!!$mkasir!!' and lgnid like '!!$mlgnid!!' and $ttk");

echo "

<tr valign=>
<td colspan=4 align=right><b>TOTAL&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal,0,'.',',')."</td>
<td align=right><b>".number_format($mtotal2,0,'.',',')."</td>
<td align=right><b>".number_format($mtotal-$mtotal2,0,'.',',')."</td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL DISKON&nbsp&nbsp</td>
<td align=right><b>".number_format($wrr2[diskon],0,'.',',')."</td>
<td align=right><b></td>
<td align=right><b></td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL SETELAH DISKON&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal-$wrr2[diskon],0,'.',',')."</td>
<td align=right><b>".number_format($mtotal2,0,'.',',')."</td>
<td align=right><b>".number_format($mtotal-$wrr2[diskon]-$mtotal2,0,'.',',')."</td>
</tr>
";

if ($mtk=='Kredit')
{
echo "
<tr valign=>
<td colspan=4 align=right><b>TOTAL UANG MUKA&nbsp&nbsp</td>
<td align=right><b>".number_format($wrr2[um],0,'.',',')."</td>
<td align=right><b></td>
<td align=right><b></td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL PIUTANG&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal-$wrr2[um],0,'.',',')."</td>
<td align=right><b></td>
<td align=right><b></td>
</tr>

";
}

/*

*/

}


if ($mLapo=='mlapkashar')
{

echo("
GUDANG BALI JAYA 
<br>
Laporan Kas Harian
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$msal=execute("select sum(debet-kredit) saldo from bkbesar where rekid='10010' and tgl<str_to_date('$mtg1','%d-%c-%Y') ");

echo "<table cellspacing=4>
<tr><th bgcolor=lightgrey>Uraian</th><th bgcolor=lightgrey>Jumlah</th></tr>
<tr><td><b>Saldo Awal</td><td align=right><b>".number_format($msal[saldo],0,'.',',')."</td></tr>
";

$mgg=executerow("
select trans,ket,sum(debet-kredit) rp from bkbesar where rekid='10010' and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and trans in ('TRANSKASIR','TRANSJUAL') group by trans
union
select trans,ket,sum(debet-kredit) rp from bkbesar where rekid='10010' and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and trans not in ('TRANSKASIR','TRANSJUAL') group by trans,ket
order by rp desc
");
echo "<tr><td colspan=2><br>Pemasukan : </td></tr>";
$mtot=$msal[saldo];
while ($roww=mysql_fetch_assoc($mgg))
{

if ($mpem!=2 and $roww[rp]<0)
{
echo "<tr><td><hr><b>Total</td><td align=right><hr><b>".number_format($mtot-$msal[saldo],0,'.',',')."</td></tr>";
echo "<tr><td colspan=2><br>Pengeluaran : </td></tr>";
$mpem=2;
$mtotb=0;
}

$mtotb=$mtotb+abs($roww[rp]);

echo "
<tr><td> - $roww[ket]</td><td align=right>".number_format(abs($roww[rp]),0,'.',',')."</td></tr>
";

$mtot=$mtot+$roww[rp];

}

echo "
<tr><td><hr><b> Total </td><td align=right><hr><b>".number_format($mtotb,0,'.',',')."</td></tr>
";

echo "
<tr><td><br><b> Saldo Akhir </td><td align=right><br><b>".number_format($mtot,0,'.',',')."</td></tr>
";

echo "
</table>";

}


if ($mLapo=='mrrl')
{

$mtgt=date( "Y-m-d", strtotime( "$mtg1" ) );
$mtga=date( "Y-m-01", strtotime( "$mtg1" ) );
$mtg1s=date( "Y-m-d", strtotime( "$mtg1 -1 day" ) );
$mtgth=date( "d", strtotime( "$mtg1 +1 month -1 day" ) );
$mtgl1=date( "Y-m-d", strtotime( "$mtg1" ) );
$mtgl2=date( "Y-m-d", strtotime( "$mtg2" ) );


echo("
GUDANG BALI JAYA <BR>
Laporan Laba Rugi
<br>
<br><br>
<table cellspacing=2 border=1 width=80%>
<tr><th width=50% colspan=1> Tgl. $mtg1 s.d. $mtg2 </th><th width=50% colspan=1> Total s.d. $mtg2 </th></tr>
<tr>
<td>
");

$mssql="select 
b.rekid,b.reknama from setrek b 
left join setneraca c on b.nrcid=c.nrcid 
left join setklas d on c.clid=d.clid where d.posisi in ('D','B') 
order by b.rekid
";

$mjumm1=executerow($mssql);

echo "<table width=100% border=0>
<tr><td></td></tr>";

while ($rrow=mysql_fetch_assoc($mjumm1))
{


$mjj=execute("select sum(kredit-debet) jumlah from bkbesar where tgl between '$mtgl1' and '$mtgl2' and rekid='$rrow[rekid]'");

if ($rrow[rekid]=='31010')
{
echo "<tr><td><b><hr> Penjualan Bersih </td><td align=right><b><hr> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

if ($rrow[rekid]=='40010')
{
echo "<tr><td><b><hr> Total HPP </td><td align=right><b><hr> $mctot2 </td><td><b>_</td></tr>
<tr><td><b><hr><font color=$mcolor> $mlorr Kotor </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
";

$mtotal=0;
}

if ($rrow[rekid]=='40310')
{
echo "<tr><td><b><hr> Total Biaya </td><td align=right><b><hr> $mctot2 </td><td><b>_</td></tr>
<tr color=$mcolor><td><b><hr><font color=$mcolor> $mlorr sebelum pajak </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

$mjum=number_format(abs($mjj[jumlah]),0,'.',',');

echo "<tr><td>$rrow[rekid] $rrow[reknama] </td><td align=right> $mjum </td></tr>";

$mtotal=$mtotal+$mjj[jumlah];
$mtotalall=$mtotalall+$mjj[jumlah];

if ($mtotalall<0)
{$mlorr='Rugi';$mcolor='red';$mctot='('.number_format(abs($mtotalall),0,'.',',').')'; $mctot2=number_format(abs($mtotal),0,'.',',') ; }
else
{$mlorr='Laba';$mcolor='blue';$mctot=number_format($mtotalall,0,'.',','); $mctot2=number_format(abs($mtotal),0,'.',','); }

}


echo "
<tr><td><b><hr> Total HPP </td><td align=right><b><hr> $mtotal </td></tr>
<tr><td><b><hr><font color=$mcolor> Total $mlorr </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
</table>
";

echo("
</td>
<td>");

$mtotal=0;
$mtotalall=0;

$mssql="select 
b.rekid,b.reknama from setrek b 
left join setneraca c on b.nrcid=c.nrcid 
left join setklas d on c.clid=d.clid where d.posisi in ('D','B') 
order by b.rekid
";

$mjumm1=executerow($mssql);

echo "<table width=100% border=0>
<tr><td></td></tr>";

while ($rrow=mysql_fetch_assoc($mjumm1))
{


$mjj=execute("select sum(kredit-debet) jumlah from bkbesar where tgl <= '$mtgl2' and rekid='$rrow[rekid]'");

if ($rrow[rekid]=='31010')
{
echo "<tr><td><b><hr> Penjualan Bersih </td><td align=right><b><hr> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

if ($rrow[rekid]=='40010')
{
echo "<tr><td><b><hr> Total HPP </td><td align=right><b><hr> $mctot2 </td><td><b>_</td></tr>
<tr><td><b><hr><font color=$mcolor> $mlorr Kotor </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
";

$mtotal=0;
}

if ($rrow[rekid]=='40310')
{
echo "<tr><td><b><hr> Total Biaya </td><td align=right><b><hr> $mctot2 </td><td><b>_</td></tr>
<tr color=$mcolor><td><b><hr><font color=$mcolor> $mlorr sebelum pajak </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

$mjum=number_format(abs($mjj[jumlah]),0,'.',',');

echo "<tr><td>$rrow[rekid] $rrow[reknama] </td><td align=right> $mjum </td></tr>";

$mtotal=$mtotal+$mjj[jumlah];
$mtotalall=$mtotalall+$mjj[jumlah];

if ($mtotalall<0)
{$mlorr='Rugi';$mcolor='red';$mctot='('.number_format(abs($mtotalall),0,'.',',').')'; $mctot2=number_format(abs($mtotal),0,'.',',') ; }
else
{$mlorr='Laba';$mcolor='blue';$mctot=number_format($mtotalall,0,'.',','); $mctot2=number_format(abs($mtotal),0,'.',','); }

}


echo "
<tr><td><b><hr> Total HPP </td><td align=right><b><hr> $mtotal </td></tr>
<tr><td><b><hr><font color=$mcolor> Total $mlorr </font></td><td align=right><b><hr><font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
</table>
";

echo("
</td></tr>
</table>
");

}

if ($mLapo=='mlaplunaspiutang')
{
$link=open_connection();
$sqlstr="
select a.*,b.lgnnama,c.nid jualid,c.tgl tgljual,c.debet from bkbesar a left join setlgn b on a.bpid=b.lgnid 
left join (select bpid,nid,tgl,debet from bkbesar where rekid='10210' and debet<>0) c on a.nid2=c.nid and a.bpid=c.bpid
where a.rekid='10210' and a.trans='TRANSLUNASPIUTANG' and kredit<>0 and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
group by a.nid,c.nid
order by b.lgnnama,a.nid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Pelunasan Piutang
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=97% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 

<tr>
<td bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></td>
<td bgcolor=#CCCCCC align=center colspan=2><b>Pelanggan</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center colspan=5><b>Atas Faktur</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Saldo</b></td>
<td bgcolor=#CCCCCC align=center colspan=4><b>Jumlah Pelunasan</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Sisa</b></td>
</tr>

<tr>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>

<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center><b>Jumlah</b></td>
<td bgcolor=#CCCCCC align=center><b>Retur</b></td>
<td bgcolor=#CCCCCC align=center><b>Pelunasan <br> Seb.</b></td>

<td bgcolor=#CCCCCC align=center><b>Potongan</b></td>
<td bgcolor=#CCCCCC align=center><b>Giro</b></td>
<td bgcolor=#CCCCCC align=center><b>Transfer</b></td>
<td bgcolor=#CCCCCC align=center><b>Tunai</b></td>
</tr>


");
$mnom=1;
$mtotdebet=0;
$mkredit=0;
$mtotawal=0;
$mtotsaldo=0;
$mnidd='';
while ($row = mysql_fetch_assoc ($result))
{

$rowr=execute("select sum(kredit) kredit from bkbesar where rekid='10210' and trans='TRANSRETURJUAL' and nid2='$row[jualid]' ");
$rowp=execute("select sum(kredit) kredit from bkbesar where rekid='10210' and trans in ('TRANSLUNASPIUTANG','TRANSKASIR') and nid2='$row[jualid]' and nid<>'$row[nid]'");
$msaldo=$row[debet]-$rowr[kredit]-$rowp[kredit];
$row2=execute("select sum(kredit) potongan from bkbesar where rekid='10210' and nid='$row[nid]' and ket like '%Potongan%' and nid2='$row[jualid]' ");
$row3=execute("select sum(debet) kupon from bkbesar where rekid='20310' and nid='$row[nid]' and nid2='$row[jualid]' ");
$row4=execute("select sum(debet) giro from bkbesar where rekid='10220' and nid='$row[nid]'");
$row5=execute("select sum(debet) transfer from bkbesar where rekid like '101%' and nid='$row[nid]'");
$row6=execute("select sum(debet) tunai from bkbesar where rekid='10010' and nid='$row[nid]'");

echo("
<tr>
<td bgcolor=white align=center>$mnom.</td>
<td bgcolor=white align=center>$row[bpid]</td>
<td bgcolor=white align=left>&nbsp;$row[lgnnama]</td>
<td bgcolor=white align=center>$row[nid]</td>
<td bgcolor=white align=center>".date( "d-m-Y", strtotime($row[tgl]))."</td>
<td bgcolor=white align=center>$row[jualid]</td>
<td bgcolor=white align=center>".date( "d-m-Y", strtotime($row[tgljual]))."</td>
<td bgcolor=white align=right>".number_format($row[debet],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($rowr[kredit],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($rowp[kredit],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($msaldo,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($row2[potongan],0,'.',',')."&nbsp;</td>
");

if ($mnidd!=$row[nid])
{

$rowcc=executerow("select nid2 from bkbesar where rekid='10210' and kredit<>0 and nid='$row[nid]' and nid2<>'' group by nid2");

$jumm=mysql_num_rows($rowcc);
$msisa=$msaldo-$row2[potongan]-$row3[kupon]-$row4[giro]-$row5[transfer]-$row6[tunai];

echo("
<td bgcolor=white align=right rowspan=".$jumm."> ".number_format($row4[giro],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row5[transfer],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row6[tunai],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right rowspan=".$jumm.">&nbsp;</td>
");
$mnidd=$row[nid];

$mtot7=$mtot7+$row4[giro];
$mtot8=$mtot8+$row5[transfer];
$mtot9=$mtot9+$row6[tunai];
$mtot10=$mtot10+$msisa;

}

$mnom++;
$mtot1=$mtot1+$row[debet];
$mtot2=$mtot2+$rowr[kredit];
$mtot3=$mtot3+$rowp[kredit];
$mtot4=$mtot4+$msaldo;
$mtot5=$mtot5+$row2[potongan];
$mtot6=$mtot6+$row3[kupon];

}

echo("
<tr>
<td bgcolor=white align=center colspan=7><b>TOTAL</td>
<td bgcolor=white align=right><b>".number_format($mtot1,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot2,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot3,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot4,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot5,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot6,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot7,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot9,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot4-$mtot5-$mtot6-$mtot7-$mtot8-$mtot9,0,'.',',')."&nbsp;</td>
</tr>
");

}

if ($mLapo=='mlaplunashutang')
{
$link=open_connection();
$sqlstr="
select a.*,b.supnama,c.nid jualid,c.tgl tgljual,c.kredit from bkbesar a left join setsup b on a.bpid=b.supid 
left join (select bpid,nid,tgl,kredit from bkbesar where rekid='20010' and kredit<>0) c on a.nid2=c.nid and a.bpid=c.bpid
where a.rekid='20010' and a.trans='TRANSLUNASHUTANG' and debet<>0 and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
group by a.nid,c.nid
order by a.nid,b.supnama,a.nid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Pelunasan Hutang
<br>Tgl. $mtg1 s.d. $mtg2
<br> 
<table width=97% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'> 

<tr>
<td bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></td>
<td bgcolor=#CCCCCC align=center colspan=2><b>Suplier</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>No.</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center colspan=5><b>Atas Faktur</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Saldo</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Bayar</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Sisa</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Giro</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Transfer</b></td>
<td bgcolor=#CCCCCC align=center rowspan=2><b>Tunai</b></td>
</tr>

<tr>
<td bgcolor=#CCCCCC align=center><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center><b>Nama</b></td>

<td bgcolor=#CCCCCC align=center><b>No.</b></td>
<td bgcolor=#CCCCCC align=center><b>Tgl.</b></td>
<td bgcolor=#CCCCCC align=center><b>Jumlah</b></td>
<td bgcolor=#CCCCCC align=center><b>Retur</b></td>
<td bgcolor=#CCCCCC align=center><b>Pelunasan <br> Seb.</b></td>

</tr>


");
$mnom=1;
$mtotkredit=0;
$mdebet=0;
$mtotawal=0;
$mtotsaldo=0;
$mnidd='';
while ($row = mysql_fetch_assoc ($result))
{

$rowr=execute("select sum(debet) debet from bkbesar where rekid='20010' and trans='TRANSRETURBELI' and nid2='$row[jualid]' and bpid='$row[bpid]' ");
$rowp=execute("select sum(debet) debet from bkbesar where rekid='20010' and trans='TRANSLUNASHUTANG' and nid2='$row[jualid]' and tgl<'$row[tgl]' and bpid='$row[bpid]' ");
$msaldo=$row[kredit]-$rowr[debet]-$rowp[debet];
$row2=execute("select sum(debet) potongan from bkbesar where rekid='20010' and nid='$row[nid]' and ket like '%Potongan%' and nid2='$row[jualid]' and bpid='$row[bpid]' ");
$row3=execute("select sum(kredit) kupon from bkbesar where rekid='20310' and nid='$row[nid]' and nid2='$row[jualid]' and bpid='$row[bpid]' ");
$row4=execute("select sum(kredit) giro from bkbesar where rekid='10220' and nid='$row[nid]' and bpid='$row[bpid]' ");
$row5=execute("select sum(kredit) transfer from bkbesar where rekid like '101%' and nid='$row[nid]' and bpid='$row[bpid]' ");
$row6=execute("select sum(debet) bayar from bkbesar where rekid='20010' and debet<>0 and nid='$row[nid]' and nid2='$row[jualid]' and ket like 'Pelunasan%' and bpid='$row[bpid]' ");

echo("
<tr>
<td bgcolor=white align=center>$mnom.</td>
<td bgcolor=white align=center>$row[bpid]</td>
<td bgcolor=white align=left>&nbsp;$row[supnama]</td>
<td bgcolor=white align=center>$row[nid]</td>
<td bgcolor=white align=center>".date( "d-m-Y", strtotime($row[tgl]))."</td>
<td bgcolor=white align=center>$row[jualid]</td>
<td bgcolor=white align=center>".date( "d-m-Y", strtotime($row[tgljual]))."</td>
<td bgcolor=white align=right>".number_format($row[kredit],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($rowr[debet],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($rowp[debet],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right>".number_format($msaldo,0,'.',',')."&nbsp;</td>
");


$msisa=$msaldo-$row2[potongan]-$row6[bayar] ;

echo("
<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row6[bayar]-$row3[kupon],0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right rowspan=".$jumm.">".number_format($msisa,0,'.',',')."&nbsp;</td>
");

$mtot9=$mtot9+$row6[bayar];
$mtot10=$mtot10+$msisa;


$mnom++;
$mtot1=$mtot1+$row[kredit];
$mtot2=$mtot2+$rowr[debet];
$mtot3=$mtot3+$rowp[debet];
$mtot4=$mtot4+$msaldo;
$mtot5=$mtot5+$row2[potongan];
$mtot6=$mtot6+$msaldo;
$mtot7=$mtot7+($row6[bayar]-$row3[kupon]);
$mtot8=$mtot8+$msisa;

if ($mnidd!=$row[nid])
{

$moo=execute("select count(*) cnnt from bkbesar where nid='$row[nid]' and nid2<>'' and debet<>0 and rekid='20010' ");
$row4=execute("select sum(kredit) giro from bkbesar where rekid='20110' and nid='$row[nid]' and bpid='$row[bpid]' ");
$row5=execute("select sum(kredit) transfer from bkbesar where rekid like '101%' and nid='$row[nid]' and bpid='$row[bpid]' ");
$row6=execute("select sum(kredit) tunai from bkbesar where rekid='10010' and kredit<>0 and nid='$row[nid]' ");

echo "
<td rowspan=".$moo[cnnt]." bgcolor=white align=right> ".number_format($row4[giro],0,'.',',')."&nbsp; </td>
<td rowspan=".$moo[cnnt]." bgcolor=white align=right> ".number_format($row5[transfer],0,'.',',')."&nbsp; </td>
<td rowspan=".$moo[cnnt]." bgcolor=white align=right> ".number_format($row6[tunai],0,'.',',')."&nbsp; </td>
";

$mnidd=$row[nid];

$mtot9X=$mtot9X+$row4[giro];
$mtot10X=$mtot10X+$row5[transfer];
$mtot11X=$mtot11X+$row6[tunai];

}

echo "
</tr>
";

}

echo("
<tr>
<td bgcolor=white align=center colspan=5><b>TOTAL</td>
<td bgcolor=white align=right><b>".number_format($mtot1,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot2,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot3,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot4,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot5,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot6,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot7,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot8,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot9X,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot10X,0,'.',',')."&nbsp;</td>
<td bgcolor=white align=right><b>".number_format($mtot11X,0,'.',',')."&nbsp;</td>
</tr>
");

}

if ($mLapo=='mlapbelijt')
{

$sqlstr="select a.*,b.supnama,date_format(tgl,'%d-%m-%Y') tglc,date_format(tgljt,'%d-%m-%Y') tgljtc,date_format(tgljt,'%d') tgljth
from transbeli1 a left join setsup b on a.supid=b.supid
where tgljt between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid!!' 
order by a.nid,a.tgl
";

echo("

GUDANG BALI JAYA 
<br>
Laporan Jatuh Tempo Pembelian 
<br>Tgl. Jt. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Suplier</th>
<th>Nama Suplier</th>
<th>Nota</th>
<th>Tgl.</th>
<th>Tgl. Jatuh Tempo</th>
<th>Jumlah</th>
<th>Tunai</th>
<th>Total</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_assoc($maa))
{

echo "
<tr valign= height=25>
<td>$nn</td>
<td>$mrr[supid]</td>
<td>$mrr[supnama]</td> 
<td>$mrr[nid]</td> 
<td>$mrr[tglc] $mrr[tgljth]</td> 
<td>$mrr[tgljtc]</td> 
<td align=right>".number_format($mrr[jumlah],0,'.',',')."</td> 
<td align=right>".number_format($mrr[tunai],0,'.',',')."</td> 
<td align=right>".number_format($mrr[total],0,'.',',')."</td> 
</td>
</tr>
";

$totot=$totot+$mrr[jumlah];
$tottunai=$tottunai+$mrr[tunia];
$tothutang=$tothutang+$mrr[total];
$nn++;
}


echo "
<tr valign=bottom>
<td colspan=6>&nbsp;<br></td>
<td align=right><b>".number_format($totot,0,'.',',')."</td> 
<td align=right><b>".number_format($tottunai,0,'.',',')."</td> 
<td align=right><b>".number_format($tothutang,0,'.',',')."</td> 
</td>
</tr>
</table>
";
}

if ($mLapo=='mlapkasirperkasir')
{

$ttk=" true ";

if ($mtk=='Tunai')
{ $ttk=" bayar>=jumlah ";}

if ($mtk=='Kredit')
{ $ttk=" bayar<jumlah ";}

if ($mur=='nama')
{ $urut=" stonama ";}

if ($mur=='qty')
{ $urut=" qty desc ";}

if ($mur=='rp')
{ $urut=" jmlhrg desc ";}

$sqlstr="select sum(total) jumlah,kasir,count(*) jnota
from transkasir1 a
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') 
group by kasir 
";

echo(" 
GUDANG BALI JAYA 
<br>
Laporan Penjualan per Kasir
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=50% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kasir</th>
<th>Jumlah</th>
<th>Jumlah Nota</th>
</tr>

";

$nn=1;
$totot=0;
$tottunai=0;
$tothutang=0;
$mnomor=1;
$mtotal=0;
$mtotal2=0;

while ($msx=mysql_fetch_object($maa))
{

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->kasir</td>
<td align=right>".number_format($msx->jumlah,0,'.',',')."</td>
<td align=right>".number_format($msx->jnota,0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotal=$mtotal+$msx->jumlah;
$mtotal2=$mtotal2+$msx->jnota;

}

echo "
<tr>
<td colspan=2><b>Total</td>
<td align=right><b>".number_format($mtotal,0,'.',',')."</td>
<td align=right><b>".number_format($mtotal2,0,'.',',')."</td>
</tr>
";

/*

*/

}


if ($mLapo=='mlapjualnota')
{
	$jt = "AND TRUE";
	if($jtg1 != '')
	{
		$jt = "AND tgljt <= str_to_date('$jtg1','%d-%m-%Y')";
	}
	$sqlstr="
	select a.*, b.lgnnama, date_format(tgl,'%d-%m-%Y') tglc, date_format(tgljt,'%d-%m-%Y') tgljtc, date_format(tgljt,'') tgljth, c.retur, d.lunas, f.gaji
	from transjual1 a
	left join setlgn b on a.lgnid=b.lgnid
	left join (select nid2,sum(kredit) retur
		from bkbesar
		where rekid='10210' and trans='TRANSRETURJUAL' group by nid2) c on a.nid=c.nid2
	left join (select nid2,sum(kredit) lunas
		from bkbesar
		where rekid='10210' and trans='TRANSLUNASPIUTANG' group by nid2) d on a.nid=d.nid2
	left join setkaryawan f on a.sales=f.karid
	where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and a.lgnid like '!!$mlgnid!!' and a.sales like '!!$mkarid!!' $jt
	order by a.nid,a.tgl
	";
	
	$saa=execute2("select * from setkaryawan where karid='$mkarid'");
	
	echo("
	GUDANG BALI JAYA 
	<br>
	Laporan Penjualan Periodik
	<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
	<br><br>
	");
	
	$maa=executerow($sqlstr);
	
	$mjumlah=mysql_num_rows($maa);
	
	if($mjumlah==0)
	{
		return;
	}
	
	echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
		<tr bgcolor='lightgrey'>
			<th>No.</th>
			<th>Kode pelanggan</th>
			<th>Nama pelanggan</th>
			<th>Nota</th>
			<th>Tgl.</th>
			<th>Total Item</th>
			</tr>
		";
		
	$nn=1;
	
	$totot=0;
	$tottunai=0;
	$totPIUTANG=0;
	
	while ($mrr=mysql_fetch_object($maa))
	{
		echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td><a href onclick=window.open('transjual.php?mnid=$mrr->nid')> $mrr->nid </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td align=right>".number_format($mrr->total,0,'.',',')."</td>
			</td>
		</tr>
		";
		
		/* echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td><a href onclick=linktransjual()> $mrr->nid </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td>$mrr->tgljtc</td>
			<td align=right>".number_format($mrr->total,0,'.',',')."</td>
			<td align=right>".number_format($mrr->tunai,0,'.',',')."</td>
			<td align=right>".number_format($mrr->jumlah,0,'.',',')."</td>
			<td align=right>".number_format($mrr->retur,0,'.',',')."</td>
			<td align=right>".number_format($mrr->lunas,0,'.',',')."</td>
			<td align=right>".number_format($mrr->jumlah-$mrr->retur-$mrr->lunas,0,'.',',')."</td>
			</td>
		</tr>
		"; */
		
		$nn++;
	}
	
	echo "
		<tr valign=bottom>
			<td colspan=6>&nbsp;<br></td>
			</td>
		</tr>
		
		<tr valign=bottom>
				</tr>
	</table>
	";
}

if ($mLapo=='mlapmutasi')
{

$sqlstr="select a.*,b.stonama,b.satuan1,b.satuan2,c.loknama asal,d.loknama tujuan
from transmutasigudang a 
left join setstok b on a.stoid=b.stoid
left join setlok c on a.lokid1=c.lokid
left join setlok d on a.lokid2=d.lokid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
order by a.nid,a.tgl
";

echo(" 
GUDANG BALI JAYA 
<br>
Laporan Mutasi Gudang
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Nota</th>
<th>User</th>
<th>Tgl</th>
<th>Asal</th>
<th>Tujuan</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Sat.</th>
<th>Unit</th>
<th>Sat.</th>
</tr>

";

$nn=1;

while ($mrr=mysql_fetch_object($maa))
{

echo "

<tr valign=top>
<td> $nn </td>
<td> $mrr->nid </td>
<td> $mrr->ket </td>
<td> ".date("d-m-Y",strtotime($mrr->tgl))." </td>
<td> $mrr->asal </td>
<td> $mrr->tujuan </td>
<td> $mrr->stoid </td>
<td> $mrr->stonama </td>
<td align=right>".number_format($mrr->qty,0,'.',',')."</td>
<td> $mrr->satuan1 </td>
<td align=right>".number_format($mrr->unit,0,'.',',')."</td>
<td> $mrr->satuan2 </td>
</tr>
";

$nn++;

}

echo "
</table>
<br><br>
";

}

if ($mLapo=='mlapjualkiriman')
{
$sqlstr="select a.bpid stoid,sum(a.qtyout-a.qtyin) qty,sum(a.kredit-a.debet) hpp,b.stonama,b.isi,b.satuan1,b.satuan2
from bkbesar a left join setstok b on a.bpid=b.stoid
left join transjual1 c on a.nid=c.nid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and c.lgnid like '!!$mlgnid!!'  and a.trans='TRANSKASIR' and a.rekid like '103%' group by a.bpid order by a.bpid
";

$sqlstr="select a.stoid,sum( ( a.qty*a.isi)+a.unit ) qty,sum(a.jmlhrg) jmlhrg,b.stonama,b.isi,b.satuan1,b.satuan2
from transjual2 a left join setstok b on a.stoid=b.stoid
left join transjual1 c on a.nid=c.nid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and c.lgnid like '!!$mlgnid!!'  group by a.stoid order by b.stonama
";

echo(" 
GUDANG BALI JAYA 
<br>
Rekap Barang Keluar
<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
Kasir : $mlgnid <br><br>
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Jumlah Item</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

$mnomor=1;
$mtotal=0;
$mtotal2=0;
while ($msx=mysql_fetch_object($maa))
{

$wrr=execute2("select sum(kredit) hpp from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and bpid='$msx->stoid' and rekid='10310' and kredit<>0 and trans='transjual' and nid in (select nid from transjual1 c where c.lgnid like '!!$mlgnid!!' ) ");

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->stoid</td>
<td>$msx->stonama</td>
<td align=right>".cqty($msx->qty,$msx->isi,1,$msx->satuan1,$msx->satuan2,'')."</td>
<td align=right>".number_format($msx->jmlhrg,0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotal=$mtotal+$msx->jmlhrg;
$mtotal2=$mtotal2+$wrr->hpp;

}

$wrr2=execute2("select sum(jumlah) jumlah from transjual1 where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')");

echo "

<tr valign=>
<td colspan=4 align=right><b>TOTAL&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal,0,'.',',')."</td>
</tr>


";


}


if ($mLapo=='mlapbeli3')
{
	$sqlstr='
	select a.*, b.supnama
	from transbeli1 a left join setsup b on a.supid=b.supid
	where tgl between str_to_date("'.$mtg1.'", "%d-%c-%Y") and str_to_date("'.$mtg2.'", "%d-%c-%Y") and a.supid like "!!'.$msupid.'%"
	order by a.nid, a.tgl
	';

	echo("
	GUDANG BALI JAYA
	<br>
	Laporan Pembelian 2
	<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
	<br><br>
	");

	$maa=executerow($sqlstr);

	$mjumlah=mysql_num_rows($maa);

	if($mjumlah==0)
	{
		return;
	}

	echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
		<tr bgcolor='lightgrey'>
			<th>Tgl.</th>
			<th>No Beli</th>
			<th>Nama Suplier</th>
			<th>Nama Stok</th>
			<th>Qty</th>
			</tr>
	";

	$nn=1;

	$totot=0;
	$tottunai=0;
	$tothutang=0;

	while ($mrr=mysql_fetch_assoc($maa))
	{
		/* echo '
		<tr valign=bottom>
			<td>&nbsp;<br>'.$nn.'</td>
			<td colspan=10>
			&nbsp;&nbsp;Kode : '.$mrr[nid].'
			&nbsp;&nbsp;&nbsp; Tgl : '.$mrr[tgl].'
			&nbsp;&nbsp;&nbsp; Suplier : '.$mrr[supid].' - '.$mrr[supnama].'
			&nbsp;&nbsp;&nbsp; Nota : '.$mrr[fakturid].'
			</td>
		</tr>
		'; */
		
		$mss=executerow('
		select a.*, date_format(a.tgl, "%d-%m-%Y") tglc, b.stonama, b.satuan1, b.satuan2, d.supnama
		from transbeli2 a
		left join setstok b on a.stoid=b.stoid
		left join transbeli1 c on a.nid=c.nid
		left join setsup d on c.supid=d.supid
		where a.nid="'.$mrr[nid].'" and a.stoid like "'.$mstoid.'%"
		order by nomor
		');
		$mnomor=1;
		$mtotalqty=0;
		while ($msx=mysql_fetch_assoc($mss))
		{
			echo '
		<tr>
			<td align=left>'.$msx[tglc].'.</td>
			<td>'.$msx[nid].'</td>
			<td>'.$msx[supnama].'</td>
			<td>'.$msx[stonama].'</td>
			<td align=right>&nbsp;&nbsp;&nbsp;'.number_format($msx[qty], 0).'</td>
			
			
			</tr>
			';
			
			$mnomor++;
			$mtotalqty=$mtotalqty+$msx[qty];
		}

		echo "
		<tr valign=top>
			<td colspan=4 align=right><b>TOTAL&nbsp<br>&nbsp</td>
			<td align=right><b>".number_format($mtotalqty,0)."</td>
			
			</tr>
		";

		

		
	}

	echo "

			</tr>
	
	";
}




if ($mLapo=='mlapdistribusi')
{
	$sqlstr="
	SELECT b.lgnid, b.lgnnama, c.stoid, c.stonama, c.hrgsat, c.qty, c.diskonrp, jmlhrg, c.isi, c.nid, date_format(c.tgl,'%d-%m-%Y') tgl, c.satuan1, c.satuan2, c.unit, c.supid
	FROM transjual1 a
	INNER JOIN setlgn b ON a.lgnid=b.lgnid
	INNER JOIN (
		SELECT transjual2.*, setstok.satuan1, setstok.satuan2, setstok.stonama, setstok.supid
		FROM transjual2
		inner join setstok on transjual2.stoid=setstok.stoid
		WHERE setstok.stoid like '%$mstoid%') c ON c.nid=a.nid
	LEFT JOIN setkaryawan f ON a.sales=f.karid
	WHERE c.tgl between str_to_date('$mtg1', '%d-%c-%Y') and str_to_date('$mtg2', '%d-%c-%Y') and a.lgnid like '!!$mlgnid!!' and a.sales like '!!$mkarid!!' and c.supid like '%$msupid%'
	order by a.nid, a.tgl
	";

	$saa=execute2("select * from setkaryawan where karid='$mkarid'");
	
	$sqlsup = "
	select *
	from setsup
	where supid = '$msupid'
	";
	$rowsup = execute($sqlsup);
	$msupnama = $rowsup[supnama];
	$sqllgn = "
	select *
	from setlgn
	where lgnid = '$mlgnid'
	";
	$rowlgn = execute($sqllgn);
	$mlgnnama = $rowlgn[lgnnama];
	$sqlsto = "
	select *
	from setstok
	where stoid = '$mstoid'
	";
	$rowsto = execute($sqlsto);
	$mstonama = $rowsto[stonama];
	$sqlkar = "
	select *
	from setkaryawan
	where karid = '$mkarid'
	";
	$rowkar = execute($sqlkar);
	$mkarnama = $rowkar[karnama];

	echo('
	 	 GUDANG BALI JAYA 
	<br>
	Laporan Distribusi Barang
	<br>Tgl. '.$mtg1.' s.d. '.$mtg2.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Suplier : '.$msupnama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan : '.$mlgnnama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stok : '.$mstonama.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales : '.$mkarnama.'
	<br><br>
	');

	$maa=executerow($sqlstr);

	$mjumlah=mysql_num_rows($maa);

	if($mjumlah==0)
	{
		return;
	}

	echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
		<tr bgcolor='lightgrey'>
			<th>No.</th>
			<th>Kode Stok</th>
			<th>Nama Stok</th>
			<th>Qty<br>Pengambilan</th>
			<th>Total Rupiah</th>
			<th>No. Faktur</th>
			<th>Tgl.</th>
			<th>Kode<br>Pelanggan</th>
			<th>Nama Pelanggan</th>
		</tr>
	";

	$nn=1;

	$totot=0;
	
	$tot_qty=0;

	while ($mrr=mysql_fetch_object($maa))
	{
		$temttlqty = $mrr->qty*$mrr->isi+$mrr->unit;
		$hrgsat = $mrr->hrgsat/$mrr->isi;
		$totot += ($hrgsat*$temttlqty);
		
		$tot_qty=$tot_qty+$temttlqty;
		$isi=$mrr->isi;
		$satuan1=$mrr->satuan1;
		$satuan2=$mrr->satuan2;
		
		echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->stoid</td>
			<td>$mrr->stonama</td>
			<td align=right>".cqty2($temttlqty, $mrr->isi, 1, $mrr->satuan1, $mrr->satuan2, ' ')."</td>
			<td align=right>".number_format($temttlqty*$hrgsat, 0, '.', ',')."&nbsp;</td>
			<td>&nbsp;".$mrr->nid."</td>
			<td>$mrr->tgl</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
		</tr>
		";
		$nn++;
	}
	
	if($mstoid!='')
	{
		$tot_qty=$tot_qty;
		echo '
		<tr valign=bottom>
			<td colspan=3 style="text-align: center; font-weight: bold;">TOTAL</td>
			<td style="text-align: right; font-weight: bold;">'.cqty2($tot_qty, $isi, 1, $satuan1, $satuan2, " ").'</td>
			<td align=right><b>'.number_format($totot, 0, ".", ",").'&nbsp;</td>
		</tr>
	</table>
		';
	}
	else
	{
		echo "
		<tr valign=bottom>
			<td colspan=3>&nbsp;<br></td>
			<td>&nbsp;</td>
			<td align=right><b>".number_format($totot, 0, '.', ',')."&nbsp;</td>
		</tr>
	</table>
		";
	}
	
	/* echo "
		<tr valign=bottom>
			<td colspan=3>&nbsp;<br></td>
			<td>".cqty2($tot_qty, $mrr->isi, 1, $mrr->satuan1, $mrr->satuan2, ' ')."</td>
			<td align=right><b>".number_format($totot, 0, '.', ',')."&nbsp;</td>
		</tr>
	</table>
	"; */
}
?>
<?php echo '</body>' ?>

</html>
