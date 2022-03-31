<?php
if($excel)
{
	@header('Content-Type: application/ms-excel');
	@header('Content-disposition: inline; filename="'.$mLapo.' '.date('d-m-Y').'.xls"');
}
?>
<!DOCTYPE html>
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
UD. ANGEL
<br>
Laporan Absensi
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
<table width=50% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'>
<tr>
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>&nbsp;&nbsp;Grup&nbsp;&nbsp;</b></td>
<td bgcolor=#CCCCCC align=center ><b>&nbsp;&nbsp;Bagian&nbsp;&nbsp;</b></td>
<td bgcolor=#CCCCCC align=center ><b>&nbsp;&nbsp;$mtg1&nbsp;&nbsp;<br>WH</b></td>
");

$mttt=$mtg1;
$mnnn=1;
while ( date( "Y-m-d", strtotime( "$mttt")) < date( "Y-m-d", strtotime( "$mtg2")) )
{
$mtgt=date( "Y-m-d", strtotime( "$mtg1 +$mnnn day" ) );
echo ("<td bgcolor=#CCCCCC align=center ><b>&nbsp;&nbsp;". date( "d-m-Y",strtotime( "$mtgt")) ."&nbsp;&nbsp;<br>WH</b></td>");
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
UD. ANGEL
<br>
Laporan Absensi
<br>Tgl. $mtg1 s.d. $mtg2
<br><br>
<table width=50% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style='border-collapse:collapse;font-size:85%'>
<tr>
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Jam</b></td>
<td bgcolor=#CCCCCC align=center ><b>Tanggal</b></td>
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
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo</b></td>
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

$mtotawal=number_format($mtotawal,0,',','.');
$mtotdebet=number_format($mtotdebet,0,',','.');
$mtotkredit=number_format($mtotkredit,0,',','.');
$mtotsaldo=number_format($mtotsaldo,0,',','.');

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotawal</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotsaldo</td>
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
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal</b></td>
<td bgcolor=#CCCCCC align=center ><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo</b></td>
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

$mtotawal=number_format($mtotawal,0,',','.');
$mtotdebet=number_format($mtotdebet,0,',','.');
$mtotkredit=number_format($mtotkredit,0,',','.');
$mtotsaldo=number_format($mtotsaldo,0,',','.');

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotawal</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotsaldo</td>
</tr>
</table>
");
}
?><?php
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

if($ebln !=0 && $ethn !=0){
$exp = "and exp_date between DATE_ADD('$ethn-$ebln-01',INTERVAL -7 MONTH) and '$ethn-$ebln-01'";
}

$sqlstr="
select a.stoid,a.stonama,a.supid,a.isi,a.isi2,a.satuan1,a.satuan2,a.satuan3,
b.awal,c.kredit,c.debet,ifnull(b.awal,0)+ifnull(c.debet,0)-ifnull(c.kredit,0) saldo,
b.awalq,c.qtyin debetq,c.qtyout kreditq,ifnull(b.awalq,0)+ifnull(c.qtyin,0)-ifnull(c.qtyout,0) saldoq
from setstok a
left join (select bpid,sum(debet-kredit) awal,sum(qtyin-qtyout) awalq from bkbesar where tgl<str_to_date('$mtg1','%d-%c-%Y') and rekid like '103%' and bpid2 like '$mlokid%' $exp group by bpid) b on a.stoid=b.bpid
left join (select bpid,sum(kredit) kredit,sum(debet) debet,sum(qtyin) qtyin,sum(qtyout) qtyout from bkbesar where
rekid like '103%' and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and bpid2 like '$mlokid%' $exp
group by bpid ) c on a.stoid=c.bpid
where a.supid like '%$msupid%' and grpid like '%$mgrpid%'
and $msal
order by a.stoid ";

/*
$sqlstr="
select a.stoid,a.stonama,a.supid,a.isi,a.isi2,a.satuan1,a.satuan2,a.satuan3
from setstok a
where a.supid like '%$msupid%' and grpid like '%$mgrpid%'
order by a.stoid ";
*/


$result2 = mysql_query ("select supid,supnama from setsup where supid='$msupid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
$row2 = mysql_fetch_assoc ($result2);
$msup=$row2[supid].' '.$row2[supnama];

$result3 = mysql_query ("select grpid,grpnama from setgrp where grpid='$mgrpid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
$row3 = mysql_fetch_assoc ($result3);
$mgrup=$row3[grpid].' '.$row3[grpnama];

$result4 = mysql_query ("select lokid,loknama from setlok where lokid='$mlokid'") or die ("Kesalahan pada perintah SQL ! ".mysql_error());
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
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal Qty</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal Rp.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Qty In</b></td>
<td bgcolor=#CCCCCC align=center ><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Qty Out</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo Qty</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo</b></td>
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
<td bgcolor=#FFFFFF align=right><font size=2>$mnom.</td>
<td bgcolor=#FFFFFF align=left><font size=2><font size=2>$mrekid</td>
<td bgcolor=#FFFFFF align=left><font size=2>$mreknama</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mawalq</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mawal</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mdebetq</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mdebet</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mkreditq</td>
<td bgcolor=#FFFFFF align=right><font size=2>$mkredit</td>
<td bgcolor=#FFFFFF align=right><font size=2>$msaldoq</td>
<td bgcolor=#FFFFFF align=right><font size=2>$msaldo</td>

</tr>
");

$mnom=$mnom+1;
$mtotdebet=$mtotdebet+($row[debet]);
$mtotkredit=$mtotkredit+($row[kredit]);
$mtotawal=$mtotawal+($row[awal]);
$mtotsaldo=$mtotsaldo+($row[saldo]);

}

$mtotawal=number_format($mtotawal,0,',','.');
$mtotdebet=number_format($mtotdebet,0,',','.');
$mtotkredit=number_format($mtotkredit,0,',','.');
$mtotsaldo=number_format($mtotsaldo,0,',','.');

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotawal</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotdebet</td>

<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotsaldo</td>
</tr>
</table>
</font>
");

}
?><?php
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
<td bgcolor=#CCCCCC align=center ><b>No.</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Awal Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo Kredit</b></td>
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

$mtotawald=number_format($mtotawald,0,',','.');
$mtotawalk=number_format($mtotawalk,0,',','.');
$mtotdebet=number_format($mtotdebet,0,',','.');
$mtotkredit=number_format($mtotkredit,0,',','.');
$mtotsaldod=number_format($mtotsaldod,0,',','.');
$mtotsaldok=number_format($mtotsaldok,0,',','.');

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL&nbsp;&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotawald</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotawalk</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotdebet</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotkredit</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotsaldod</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotsaldok</td>
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
select date_format(tgl,'%d-%m-%Y') tglx,bpid2,nid,ket,debet,kredit,qtyin,qtyout,000000000 saldoqty,000000000 saldoharga
from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and rekid like '103%' and bpid='$mstoid' and bpid2 like '$mlokid%'
order by tgl,ts
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
<td bgcolor=#CCCCCC align=center ><b>Qty</b></td>
<td bgcolor=#CCCCCC align=center ><b>Debet</b></td>
<td bgcolor=#CCCCCC align=center ><b>Qty</b></td>
<td bgcolor=#CCCCCC align=center ><b>Kredit</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo Rp.</b></td>
<tr>
</tr>

<tr>
<td bgcolor=#FFFFFF align=right >".$mnom.".</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right >".cqty($msaldoqty,$mi1,$mi2,$msat1,$msat2,$msat3)."</b></td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</td>
<td bgcolor=#FFFFFF align=left > ".$row[tglx]."</td>
<td bgcolor=#FFFFFF align=left > <a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left >".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right >".cqty($row[qtyin],$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".cqty($row[qtyout],$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".cqty($msaldoqty,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($mharga,0,',','.')."</td>
<td bgcolor=#FFFFFF align=center >".$row[bpid2]."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>".cqty($mqin,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>".cqty($mqout,$mi1,$mi2,$msat1,$msat2,$msat3)."</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</b></td>
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</td>
<td bgcolor=#FFFFFF align=left > ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left > <a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left >".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?>
<?php
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</b></td>
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</td>
<td bgcolor=#FFFFFF align=left > ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left > <a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left >".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
</tr>
</table>
</font>
");
}
?>
<?php
if ($mLapo=='mpoin')
{
	$link=open_connection();

	$sqlstr2='
	select a.*, sum(a.poin_d-a.poin_k) saldo, b.lgnnama
	from transpoin1 a
	left join setlgn b on b.lgnid=a.lgnid
	where a.lgnid like "%'.$mlgnid.'%" AND a.lgnid!=""
	group by a.lgnid
	order by a.lgnid
	';
	$result2 = mysql_query ($sqlstr2) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());

	mysql_close($link);

	$mnom=1;
	
	echo('
	Laporan Poin Pelanggan
	<br><br>
	<font size="2pts">
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=Black border=1 style="border-collapse:collapse;font-size:100%">
		<tr>
			<td bgcolor=#CCCCCC align=center rowspan=1 style="width:10mm"><b>No.</b></td>
			<td bgcolor=#CCCCCC align=center rowspan=1 style="width:33mm"><b>ID Pelanggan</b></td>
			<td bgcolor=#CCCCCC align=center rowspan=1><b>Nama Pelanggan</b></td>
			<td bgcolor=#CCCCCC align=center colspan=1><b>Saldo Poin</b></td>
		</tr>
	');

	$mnom=1;
	$msaldo=0;
	
	while ($row = mysql_fetch_assoc ($result2))
	{
		echo('
		<tr>
			<td bgcolor=#FFFFFF align=right>'.$mnom.'.&nbsp;</td>
			<td bgcolor=#FFFFFF align=left>&nbsp;'.$row[lgnid].'</td>
			<td bgcolor=#FFFFFF align=left>&nbsp;'.$row[lgnnama].'</td>
			<td bgcolor=#FFFFFF align=right>'.number_format($row[saldo],0,',','.').'&nbsp;</td>
		</tr>
		');
		
		$mnom=$mnom+1;
		$msaldo=$msaldo+$row[saldo];
	}

	echo('
		<tr>
			<td bgcolor=#FFFFFF align=right colspan=3><b>TOTAL&nbsp;</td>
			<td bgcolor=#FFFFFF align=right><b>'.number_format($msaldo,0,',','.').'&nbsp;</td>
		</tr>
	</table>
	</font>
	');
}
?>
<?php
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[tgl]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[nid]."</b></td>
<td bgcolor=#FFFFFF align=left >".$rowawal[ket]."</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=center >&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</b></td>
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
<td bgcolor=#FFFFFF align=right >".$mnom.".</td>
<td bgcolor=#FFFFFF align=left > ".$row[tgl]."</td>
<td bgcolor=#FFFFFF align=left > <a href onclick=looktrans('".$row[nid]."')>".$row[nid]."</a></td>
<td bgcolor=#FFFFFF align=left >".$row[ket]."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[debet],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($row[kredit],0,',','.')."</td>
<td bgcolor=#FFFFFF align=right >".number_format($msaldorp,0,',','.')."</td>
</tr>
");

$mnom=$mnom+1;

}

echo("
<tr>
<td bgcolor=#FFFFFF align=right colspan=4><b>TOTAL&nbsp;</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mdebet,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>".number_format($mkredit,0,',','.')."</td>
<td bgcolor=#FFFFFF align=right ><b>&nbsp;</td>
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
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_angel_data' and TABLE_NAME='$mtabelnya'
";

if ($mkol!='')
{
$msql="SELECT sum(ifnull(NUMERIC_PRECISION,0)+ifnull(CHARACTER_MAXIMUM_LENGTH,0)) kon
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_angel_data' and TABLE_NAME='$mtabelnya'
and COLUMN_NAME in ($mkol)
";
}

$rwwc=execute($msql);
$mpan=$rwwc[kon];


$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH panjang2,COLUMN_COMMENT koment
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_angel_data' and TABLE_NAME='$mtabelnya'
";

if ($mkol!='')
{
$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH panjang2,COLUMN_COMMENT koment
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_angel_data' and TABLE_NAME='$mtabelnya' and COLUMN_NAME in ($mkol)
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
<td bgcolor=white><font size=$msize>".$mnom.".&nbsp;</td>
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
<td bgcolor=white align=right>&nbsp;<font size=$msize>&nbsp;&nbsp;".number_format($row2[$mtit],0,',','.')."&nbsp;</td>
";
}
else
{
echo "
<td bgcolor=white >&nbsp;<font size=$msize>".$row2[$mtit]."&nbsp;</td>
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

echo "<tr><td>&nbsp;-$mrow2[nrcnama]</td><td align=right> ".number_format($mjumm[jumlah],0,',','.')." &nbsp;</td></tr>" ;

$mtot=$mtot+$mjumm[jumlah];
$mtot2=$mtot2+$mjumm[jumlah];

}

echo "<tr><td><b><hr>Total $mrow[clnama]</b></td><td align=right><b><hr width=80%>".number_format($mtot,0,',','.')." &nbsp;</b></td></tr>
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

echo "<tr><td>&nbsp;-$mrow2[nrcnama]</td><td align=right> ".number_format($mrek,0,',','.')." &nbsp;</td></tr>" ;

$mtot=$mtot+$mrek;
$mtot3=$mtot3+$mrek;

}

echo "<tr><td><b><hr>Total $mrow[clnama]</b></td><td align=right><b><hr width=80%>".number_format($mtot,0,',','.')." &nbsp;</b></td></tr>
<tr><td>&nbsp;</td></tr>
";

}

echo("</table>

</td></tr>

<tr><td width=25%><b>Total Aset</td><td width=25% align=right><b>".number_format($mtot2,0,',','.')." &nbsp;</td><td width=25%><b> Total Kewajiban dan Kekayaan</td><td width=25% align=right><b>".number_format($mtot3,0,',','.')." &nbsp;</td></tr>

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
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Nota</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Tgl.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Tgl. Jt.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Hari</b></th>
<th bgcolor=#CCCCCC align=center colspan=2><b>Outlet</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Jumlah</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Lunas</b></th>
</tr>
<tr>
<th bgcolor=#CCCCCC align=center ><b>Kode</b></th>
<th bgcolor=#CCCCCC align=center ><b>Nama</b></th>
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
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+$row[debet];
$mt2=$mt2+$row[kredit];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=7><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,',','.')." </td>
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
<td bgcolor=#FFFFFF align=right>".number_format($row[hrgsat],0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[qty],0,',','.').' '.$row[satid]." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[hrgsat]*$row[qty],0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".$mdp." </td>
<td bgcolor=#FFFFFF align=right>".$mdp2." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[diskonrp]+$row[diskonrp2],0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[jmlhrg],0,',','.')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+($row[hrgsat]*$row[qty]);
$mt2=$mt2+$row[jmlhrg];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=12><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>&nbsp;</td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,',','.')." </td>
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
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Nota</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Tgl.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Tgl. Jt.</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Hari</b></th>
<th bgcolor=#CCCCCC align=center colspan=2><b>Outlet</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Jumlah</b></th>
<th bgcolor=#CCCCCC align=center rowspan=2 ><b>Lunas</b></th>
</tr>
<tr>
<th bgcolor=#CCCCCC align=center ><b>Kode</b></th>
<th bgcolor=#CCCCCC align=center ><b>Nama</b></th>
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
<td bgcolor=#FFFFFF align=right>".number_format($row[kredit],0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($row[debet],0,',','.')." </td>
</tr>
");
$mnom++;
$mt1=$mt1+$row[kredit];
$mt2=$mt2+$row[debet];
}


echo("
<td bgcolor=#FFFFFF align=right colspan=7><b> Total &nbsp;&nbsp;&nbsp;</b></td>
<td bgcolor=#FFFFFF align=right>".number_format($mt1,0,',','.')." </td>
<td bgcolor=#FFFFFF align=right>".number_format($mt2,0,',','.')." </td>
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
UD. ANGEL
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
<td align=right>".number_format($mrr[total],0,',','.')."</td>
<td align=right>".number_format($mrr[komisi],0,',','.')."</td>
</tr>
";

$total=$total+$mrr[total];
$total2=$total2+$mrr[komisi];

}


echo "

<tr valign=top>
<td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>".number_format($total,0,',','.')."</td>
<td align=right><b>".number_format($total2,0,',','.')."</td>
</tr>

";


}

if ($mLapo=='mlapjual3_baru')
{
	$sqlstr="
	select a.*, b.lgnnama
	from transkasir1 a
	left join setlgn b on a.lgnid=b.lgnid
	where tgl between str_to_date('$mtg1', '%d-%c-%Y') and 
	str_to_date('$mtg2', '%d-%c-%Y') and total<>0 and 
	a.lgnid like '!!$mlgnid!!' order by a.tgl, a.jam, a.nid
	";

	echo("
	UD. ANGEL
	<br>
	Laporan Penjualan Detail
	<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
	<br><br>
	");

	$maa=executerow($sqlstr);

	$mjumlah=mysql_num_rows($maa);

	if($mjumlah==0)
	{
		return;
	}
	
	echo '
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style="border-collapse:collapse; font-size:85%"> 
		<tr bgcolor="lightgrey">
			<th>Tgl.</th>
			<th>No. Nota</th>
			<th>Nama Pelanggan</th>
			<th>Nama Stok</th>
			<th>Kode Stok</th>
			<th>Grup</th>
			<th>Qty</th>
			<th>Sat.</th>
			<th>Hrg Sat.</th>
			<th>DPP</th>
			<th>PPN</th>
			<th>Bruto</th>
		</tr>
	';
	
	$nn=1;
	
	$PPN_GT=0;
	$total_GT=0;
	
	//15JUL2020
	$GTdpp=0;
	$GTbrutto=0;
	//15JUL2020
	while ($mrr=mysql_fetch_object($maa))
	{
		/* echo "
		<tr valign=bottom>
			<td>&nbsp;<br>$nn</td>
			<td colspan=9>
			&nbsp;&nbsp;Kode : $mrr->nid 
			&nbsp;&nbsp;&nbsp; Tgl : $mrr->tgl Jam : $mrr->jam
			&nbsp;&nbsp;&nbsp; Pelanggan : $mrr->lgnid - $mrr->lgnnama 
			&nbsp;&nbsp;&nbsp; Nota : $mrr->fakturid
			</td>
		</tr>
		"; */
		
		$mss=executerow('
		select a.*, date_format(a.tgl, "%d-%m-%Y") tglc, b.stonama, 
		b.satuan1, b.satuan2, b.grpid, e.grpnama, d.lgnnama
		from transkasir2 a
		left join setstok b on a.stoid=b.stoid
		left join transkasir1 c on a.nid=c.nid
		left join setlgn d on c.lgnid=d.lgnid
		left join setgrp e on e.grpid=b.grpid
		where a.nid="'.$mrr->nid.'" and b.grpid like "'.$mgrpid.'%"
		order by num
		');

		$rundpp=0;
		$totdpp=0;
		$totbrutto=0;

		$mnomor=1;
		$mtotqty=0;
		//if (mysql_num_rows($mss)<1)
		//{
		//	echo '
		//<tr>
		//	<td bgcolor=red colspan=10>&nbsp;</td>
		//</tr>
		//	';
		//}

		// 15JULI2020
		if (mysql_num_rows($mss)>=1)
			{
		// 15JULI2020
				$PPN_T=0;
				//15JUL2020
				$dpp=0;
				//15JUL2020
				while ($msx=mysql_fetch_object($mss))
				{
					if($msx->grpid=='G001')
					{
						$PPN=$msx->jmlhrg*10/110;
					}
					else
					{
						$PPN=0;
					}
					
					$msattu=$msx->satuan2;
					if ($msx->isi>1)
					{
						$msattu=$msx->satuan1;
					}
					//15JUL2020
					$rundpp=$msx->jmlhrg-$PPN;
					$totdpp=$totdpp+$rundpp;
					$totbrutto=$totbrutto+$msx->jmlhrg;
					//15JUL2020
					echo '
					<tr>
					<td align=left>'.$msx->tglc.'.</td>
					<td align=left>'.$msx->nid.'.</td>
					<td>'.$msx->lgnnama.'</td>
					<td>'.$msx->stonama.'</td>
					<td>'.$msx->stoid.'</td>
					<td>'.$msx->grpnama.'</td>
					<td align=right>'.number_format($msx->qty,0,',','.').'</td>
					<td>&nbsp;'.$msattu.'</td>
					<td align=right>'.number_format($msx->hrgsat,0,',','.').'</td>
					<td align=right>'.number_format($rundpp,0,',','.').'</td>
					<td align=right>'.number_format($PPN,0,',','.').'</td>
					<td align=right>'.number_format($msx->jmlhrg,0,',','.').'</td>
					</tr>
					';
					
					$mnomor++;
					$mtotqty=$mtotqty+$msx->qty;
					
					$PPN_T=$PPN_T+$PPN;
				}
			
		
				echo '
				<tr valign=top>
					<td colspan=6 align=right><b>TOTAL&nbsp;<br>&nbsp;</td>
					<td align=right><b>'.number_format($mtotqty,0,',','.').'</td>
					<td colspan=2>&nbsp;</td>
					<!--<td align=right><b>'.number_format($mrr->total-$PPN_T,0,',','.').'</td> -->
					<td align=right><b>'.number_format($totdpp,0,',','.').'</td>
					<td align=right><b>'.number_format($PPN_T,0,',','.').'</td>
					<!--<td align=right><b>'.number_format($mrr->total,0,',','.').'</td>-->
					<td align=right><b>'.number_format($totbrutto,0,',','.').'</td>
				</tr>
				';
				
				$PPN_GT=$PPN_GT+$PPN_T;
				$total_GT=$total_GT+$mrr->total;
				
				$GTdpp=$GTdpp+$totdpp;
				$GTbrutto=$GTbrutto+$totbrutto;
				$nn++;
		// 15JULI2020	
			}
		// 15JULI2020
	}
	
	echo '
		<tr valign=top>
			<td colspan=9 align=right><b>GRAND TOTAL&nbsp;<br>&nbsp;</td>
			<td align=right><b>'.number_format($GTdpp,0,',','.').'</td>
			<td align=right><b>'.number_format($PPN_GT,0,',','.').'</td>
			<td align=right><b>'.number_format($GTbrutto,0,',','.').'</td>
		</tr>
	</table>
	<br><br>
	';
}


if ($mLapo=='mlapbeli2')
{
$sqlstr="select a.*,b.supnama
from transbeli1 a left join setsup b on a.supid=b.supid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid%' order by a.nid,a.tgl
";

echo("
UD. ANGEL
<br>
Laporan Pembelian
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
<th>Kode Stok</th>
<th>Nama Stok</th>
<th>Qty</th>
<th>Sat.</th>
<th>unit</th>
<th>Sat.2</th>
<th>Hrg Sat.</th>
<th>Jumlah</th>
<th>Jumlah</th>
<th>Tunai</th>
<th>Hutang</th>
<th>Jt. Tempo</th>

</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$tothutang=0;

while ($mrr=mysql_fetch_assoc($maa))
{

echo "
<tr valign=bottom>
<td>&nbsp;<br>$nn</td>
<td colspan=10>
&nbsp;&nbsp;Kode : $mrr[nid]
&nbsp;&nbsp;&nbsp; Tgl : $mrr[tgl]
&nbsp;&nbsp;&nbsp; Suplier : $mrr[supid] - $mrr[supnama]
&nbsp;&nbsp;&nbsp; Nota : $mrr[fakturid]
</td>
</tr>
";

$mss=executerow("
select a.*, b.stonama, b.satuan1, b.satuan2
from transbeli2 a
left join setstok b on a.stoid=b.stoid
where a.nid='$mrr[nid]' and b.grpid like '%".$mgrpid."%'
order by nomor
");

$mnomor=1;
$mtotalqty=0;

$jmlhrg=0;

while ($msx=mysql_fetch_assoc($mss))
{

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx[stoid]</td>
<td>$msx[stonama]</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($msx[qty],0,',','.')."</td>
<td>&nbsp;$msx[satuan1]</td>
<td align=right>&nbsp;&nbsp;&nbsp;".number_format($msx[unit],0,',','.')."</td>
<td>&nbsp;$msx[satuan2]</td>
<td align=right>".number_format($msx[hrgsat],0,',','.')."</td>
<td align=right>".number_format($msx[jmlhrg],0,',','.')."</td>
</tr>
";

$mnomor++;
$mtotalqty=$mtotalqty+$msx[qty];

$jmlhrg=$jmlhrg+$msx[jmlhrg];
}

echo "

<tr valign=top>
<td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>".number_format($mtotalqty,0,',','.')."</td>
<td colspan=4>&nbsp;</td>
<td align=right><b>".number_format($jmlhrg,0,',','.')."</td>
<td align=right><b>".number_format($jmlhrg,0,',','.')."</td>
<td align=right><b>".number_format($mrr[tunai],0,',','.')."</td>
<td align=right><b>".number_format($mrr[jumlah],0,',','.')."</td>
<td align=right><b>".date( 'd-m-Y', strtotime( $mrr[tgljt] ))."</td>
</tr>

";

$totot=$totot+$jmlhrg;

$tottunai=$tottunai+$mrr[tunai];
$tothutang=$tothutang+$mrr[jumlah];

$nn++;

}

echo "

<tr valign=top>
<td colspan=9 align=right><b>GRAND TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($totot,0,',','.')."</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($tottunai,0,',','.')."</td>
<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($tothutang,0,',','.')."</td>
<td align=right></td>
</tr>

</table>
<br><br>
";
}

if ($mLapo=='mlapjualnota')
{
	$ttk=" true ";

	if ($mtk=='Tunai')
	{
		$ttk=" bayar >= jumlah ";
	}

	if ($mtk=='Kredit')
	{
		$ttk=" bayar < jumlah ";
	}
	
	/* $sqlstr="select a.*,b.lgnnama,date_format(tgl,'%d-%m-%Y') tglc,date_format(tgl,'%d-%m-%Y') tgljtc,date_format(tgl,'') tgljth,c.retur,d.lunas
	from transkasir1 a left join setlgn b on a.lgnid=b.lgnid
	left join (select nid2,sum(kredit) retur from bkbesar where rekid='10210' and trans='TRANSRETURJUAL' group by nid2) c on a.nid=c.nid2
	left join (select nid2,sum(kredit) lunas from bkbesar where rekid='10210' and trans='TRANSLUNASPIUTANG' group by nid2) d on a.nid=d.nid2
	where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
	and a.lgnid like '!!$mlgnid!!' and $ttk
	order by a.nid,a.tgl
	"; */
	/////////////////////////Update 14JAN2020
	$sqlstr="
	select a.*, date_format(a.tgl,'%d-%m-%Y') tglc, date_format(a.tgl,'%d-%m-%Y') tgljtc, b.lgnid, b.bayar, b.jumlah, b.jam, c.lgnnama, sum(a.jmlhrg) as jmlhrg, e.retur, f.lunas 
	from transkasir2 as a
	left join transkasir1 as b on a.nid=b.nid 
	left join setlgn as c on b.lgnid=c.lgnid 
	left join setstok as d on a.stoid=d.stoid 
	left join
	(
		select nid2, sum(kredit) retur
		from bkbesar
		where rekid='10210' and trans='TRANSRETURJUAL'
		group by nid2
	) e on b.nid=e.nid2 
	left join
	(
		select nid2, sum(kredit) lunas
		from bkbesar
		where rekid='10210' and trans='TRANSLUNASPIUTANG'
		group by nid2
	) f on b.nid=f.nid2 
	where b.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.lgnid like '%$mlgnid%' and $ttk and d.grpid like '%$mppn' and b.kasir like '%$mkasir%'
	group by nid
	";
	/////////////////////////Update 14JAN2020
	//echo $sqlstr;
	
	if ($mppn='%')
	{
		echo("
		UD. ANGEL
		<br>
		Laporan Penjualan Per Nota
		<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
		<br><br>
		");
	}
	if ($mppn=='G001')
	{
		echo("
		UD. ANGEL (PPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
		<br>
		Laporan Penjualan Per Nota
		<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
		<br><br>
		");
	}
	if ($mppn=='G002')
	{
		echo("
		UD. ANGEL (NonPPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
		<br>
		Laporan Penjualan Per Nota
		<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
		<br><br>
		");
	}


	$maa=executerow($sqlstr);

	$mjumlah=mysql_num_rows($maa);
	if($mjumlah==0)
	{
		return;
	}
	
	/* echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
		<tr bgcolor='lightgrey'>
			<th>No.</th>
			<th>Kode pelanggan</th>
			<th>Nama pelanggan</th>
			<th>Nota</th>
			<th>Tgl.</th>
			<th>Tgl. Jatuh Tempo</th>
			<th>Jumlah</th>
			<th>Tunai</th>
			<th>Total</th>
			<th>Retur</th>
			<th>Lunas</th>
			<th>Sisa</th>
		</tr>
	"; */
	echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
		<tr bgcolor='lightgrey'>
			<th>No.</th>
			<th>Kode pelanggan</th>
			<th>Nama pelanggan</th>
			<th>Nota</th>
			<th>Tgl.</th>
			<th>Jam</th>
			<th>Jumlah</th>
			<th>Tunai</th>
			<th>Retur</th>
			<th>Sisa</th>
		</tr>
	";
	
	$nn=1;

	$totot=0;
	$tottunai=0;
	$totPIUTANG=0;

	while ($mrr=mysql_fetch_object($maa))
	{
		if($mrr->kembali > 0)
		{
			$tunai = ($mrr->edc+$mrr->bayar)-$mrr->kembali;
		}
		else
		{
			$tunai = ($mrr->edc+$mrr->bayar);
		}
		if($mrr->jumlah == $tunai)
		{
			//$tottunai=$tottunai+$mrr->jumlah;
			$tunai = $mrr->jumlah;
			$piutang = 0;
		}
		else
		{
			$piutang = $mrr->lunas;
			$totPIUTANG=$totPIUTANG+$mrr->bayar;
			/* $tunai = $mrr->bayar; */
			if($mrr->bayar<$mrr->jumlah)
			{
				$tunai = $mrr->bayar;
			}
			else
			{
				$tunai = $mrr->jumlah;
			}
		}
		
		/* echo "
		<tr valign= height=25>
		<td>$nn</td>
		<td>$mrr->lgnid</td>
		<td>$mrr->lgnnama</td>
		<td> <a href onclick=openjual('$mrr->nid')> $mrr->nid </a></td>
		<td>$mrr->tglc $mrr->tgljth</td>
		<td>$mrr->tgljtc</td>
		<td align=right>".number_format($mrr->jumlah,0,',','.')."</td>
		<td align=right>".number_format($tunai,0,',','.')."</td>
		<td align=right>".number_format($mrr->jumlah-$tunai,0,',','.')."</td>
		<td align=right>".number_format($mrr->retur,0,',','.')."</td>
		<td align=right>".number_format($piutang,0,',','.')."</td>
		<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
		</td>
		</tr>
		"; */
		
		if ($mppn=='G001')
		{
			$ppn='PPNJ'.str_repeat('0',7-strlen($nn)).$nn;
			/* echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td> <a href onclick=openjual('$mrr->nid')> $ppn </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td>$mrr->tgljtc</td>
			<td align=right>".number_format($mrr->jmlhrg,0,',','.')."</td>
			<td align=right>".number_format($tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->jumlah-$tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->retur,0,',','.')."</td>
			<td align=right>".number_format($piutang,0,',','.')."</td>
			<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
			</td>
		</tr>
			"; */
			echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td> <a href onclick=openjual('$mrr->nid')> $ppn </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td>$mrr->tgljtc</td>
			<td align=right>".number_format($mrr->jmlhrg,0,',','.')."</td>
			<td align=right>".number_format($tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->retur,0,',','.')."</td>
			<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
			</td>
		</tr>
			";
		}
		else
		{
			/* echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td> <a href onclick=openjual('$mrr->nid')> $mrr->nid </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td>$mrr->tgljtc</td>
			<td align=right>".number_format($mrr->jmlhrg,0,',','.')."</td>
			<td align=right>".number_format($tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->jumlah-$tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->retur,0,',','.')."</td>
			<td align=right>".number_format($piutang,0,',','.')."</td>
			<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
			</td>
		</tr>
			"; */
			echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td> <a href onclick=openjual('$mrr->nid')> $mrr->nid </a></td>
			<td>$mrr->tglc $mrr->tgljth</td>
			<td>$mrr->jam</td>
			<td align=right>".number_format($mrr->jmlhrg,0,',','.')."</td>
			<td align=right>".number_format($tunai,0,',','.')."</td>
			<td align=right>".number_format($mrr->retur,0,',','.')."</td>
			<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
			</td>
		</tr>
			";
		}

		/* $totot=$totot+$mrr->jumlah;
		$tottunai += $tunai;
		$tottotal += ($mrr->jumlah-$tunai);
		$totretur=$totretur+$mrr->retur;
		$totlunas=$totlunas+$piutang;
		$totsisa=$totsisa+(($mrr->jumlah-$tunai)-$mrr->retur-$piutang); */

		$totot=$totot+$mrr->jmlhrg;
		$tottunai += $tunai;
		$tottotal += ($mrr->jumlah-$tunai);
		$totretur=$totretur+$mrr->retur;
		$totlunas=$totlunas+$piutang;
		$totsisa=$totsisa+(($mrr->jumlah-$tunai)-$mrr->retur-$piutang);

		//$totkomisi=$totkomisi+($mrr->total*$mrr->gaji*0.01);
		$nn++;
	}
	
	/* echo "
	<tr valign=bottom>
	<td colspan=6>&nbsp;<br></td>
	<td align=right><b>".number_format($totot,0,',','.')."</td>
	<td align=right><b>".number_format($tottunai,0,',','.')."</td>
	<td align=right><b>".number_format($tottotal,0,',','.')."</td>
	<td align=right><b>".number_format($totretur,0,',','.')."</td>
	<td align=right><b>".number_format($totlunas,0,',','.')."</td>
	<td align=right><b>".number_format($totsisa,0,',','.')."</td>
	</tr>
	"; */
	echo "
	<tr valign=bottom>
	<td colspan=6>&nbsp;<br></td>
	<td align=right><b>".number_format($totot,0,',','.')."</td>
	<td align=right><b>".number_format($tottunai,0,',','.')."</td>
	<td align=right><b>".number_format($totretur,0,',','.')."</td>
	<td align=right><b>".number_format($totsisa,0,',','.')."</td>
	</tr>
	";
	
	echo "
	<tr>
	<td colspan=12>&nbsp;</td>
	</tr>
	";

	echo "
	<tr>
	<td colspan=5></td>
	<td align='center'><strong>DPP</strong></td>
	<td align=right><b>".number_format($totot/1.1,0,',','.')."</td>
	<td colspan=5></td>
	</tr>
	";

	echo "
	<tr>
	<td colspan=5></td>
	<td align='center'><strong>PPN</strong></td>
	<td align=right><b>".number_format($totot/1.1/10,0,',','.')."</td>
	<td colspan=5></td>
	</tr>
	";
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
UD. ANGEL
<br>
Laporan Pembelian Per Nota
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");
}

if ($mppn=='G001')
{
echo("
UD. ANGEL (PPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
<br>
Laporan Pembelian Per Nota
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");
}

if ($mppn=='G002')
{
echo("
UD. ANGEL (NonPPN)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPWP : 06.628.748.3-645.000
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
<th>Tgl. Jatuh Tempo</th>
<th>Jumlah</th>
<th>Tunai</th>
<th>Hutang</th>
<th>Retur</th>
<th>Lunas</th>
<th>Sisa</th>
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
<td>$mrr->tgljtc</td>
<td align=right>".number_format($mrr->jumlah,0,',','.')."</td>
<td align=right>".number_format($tunai,0,',','.')."</td>
<td align=right>".number_format($mrr->jumlah-$tunai,0,',','.')."</td>
<td align=right>".number_format($mrr->retur,0,',','.')."</td>
<td align=right>".number_format($piutang,0,',','.')."</td>
<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
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
<td>$mrr->tgljtc</td>
<td align=right>".number_format($mrr->jumlah,0,',','.')."</td>
<td align=right>".number_format($tunai,0,',','.')."</td>
<td align=right>".number_format($mrr->jumlah-$tunai,0,',','.')."</td>
<td align=right>".number_format($mrr->retur,0,',','.')."</td>
<td align=right>".number_format($piutang,0,',','.')."</td>
<td align=right>".number_format(($mrr->jumlah-$tunai)-$mrr->retur-$piutang,0,',','.')."</td>
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
<td colspan=6>&nbsp;<br></td>
<td align=right><b>".number_format($totot,0,',','.')."</td>
<td align=right><b>".number_format($tottunai,0,',','.')."</td>
<td align=right><b>".number_format($tottotal,0,',','.')."</td>
<td align=right><b>".number_format($totretur,0,',','.')."</td>
<td align=right><b>".number_format($totlunas,0,',','.')."</td>
<td align=right><b>".number_format($totsisa,0,',','.')."</td>
</tr>
";

echo "
<tr>
<td colspan=12>&nbsp;</td>
</tr>
";

echo "
<tr>
<td colspan=5></td>
<td align='center'><strong>DPP</strong></td>
<td align=right><b>".number_format($totot/1.1,0,',','.')."</td>
<td colspan=5></td>
</tr>
";

echo "
<tr>
<td colspan=5></td>
<td align='center'><strong>PPN</strong></td>
<td align=right><b>".number_format($totot/1.1/10,0,',','.')."</td>
<td colspan=5></td>
</tr>
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
where a.qty<0 and a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and b.grpid like '!!$mgrpid!!' 
and c.kasir like '!!$mkasir!!' and c.lgnid like '!!$mlgnid!!'
and $ttk and b.supid like '!!$msupid!!'
group by a.stoid
) b order by $urut,qty desc
";

$mlgg=execute("select lgnnama from setlgn where lgnid='$mlgnid' ");
$msup=execute("select supnama from setsup where supid='$msupid' ");
$mgrp=execute("select grpnama from setgrp where grpid='$mgrpid' ");

echo("
UD. ANGEL
<br>
Laporan Penjualan Kasir
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br>Kasir 	  : $mkasir 
<br>Grup Stok : $mgrpid $mgrp[grpnama]
<br>Supplier  : $msupid $msup[supnama]
<br>Pelanggan : $mlgnid $mlgg[lgnnama] 
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
<td align=right>".number_format($msx[jmlhrg],0,',','.')."</td>
<td align=right>".number_format($msx[hpp],0,',','.')."</td>
<td align=right>".number_format($msx[jmlhrg]-$msx[hpp],0,',','.')."</td>
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
<td align=right><b>".number_format($mtotal,0,',','.')."</td>
<td align=right><b>".number_format($mtotal2,0,',','.')."</td>
<td align=right><b>".number_format($mtotal-$mtotal2,0,',','.')."</td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL DISKON&nbsp&nbsp</td>
<td align=right><b>".number_format($wrr2[diskon],0,',','.')."</td>
<td align=right><b></td>
<td align=right><b></td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL SETELAH DISKON&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal-$wrr2[diskon],0,',','.')."</td>
<td align=right><b>".number_format($mtotal2,0,',','.')."</td>
<td align=right><b>".number_format($mtotal-$wrr2[diskon]-$mtotal2,0,',','.')."</td>
</tr>
";

if ($mtk=='Kredit')
{
echo "
<tr valign=>
<td colspan=4 align=right><b>TOTAL UANG MUKA&nbsp&nbsp</td>
<td align=right><b>".number_format($wrr2[um],0,',','.')."</td>
<td align=right><b></td>
<td align=right><b></td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL PIUTANG&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal-$wrr2[um],0,',','.')."</td>
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
UD. ANGEL
<br>
Laporan Kas Harian
<br>Tgl. $mtg1 s.d. $mtg2 $mtgt
<br><br>
");

$msal=execute("select sum(debet-kredit) saldo from bkbesar where rekid='10010' and tgl<str_to_date('$mtg1','%d-%c-%Y') ");

echo "<table cellspacing=4>
<tr><th bgcolor=lightgrey>Uraian</th><th bgcolor=lightgrey>Jumlah</th></tr>
<tr><td><b>Saldo Awal</td><td align=right><b>".number_format($msal[saldo],0,',','.')."</td></tr>
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
echo "<tr><td><hr><b>Total</td><td align=right><hr><b>".number_format($mtot-$msal[saldo],0,',','.')."</td></tr>";
echo "<tr><td colspan=2><br>Pengeluaran : </td></tr>";
$mpem=2;
$mtotb=0;
}

$mtotb=$mtotb+abs($roww[rp]);

echo "
<tr><td> - $roww[ket]</td><td align=right>".number_format(abs($roww[rp]),0,',','.')."</td></tr>
";

$mtot=$mtot+$roww[rp];

}

echo "
<tr><td> <hr> <b> Total </td><td align=right><hr> <b>".number_format($mtotb,0,',','.')."</td></tr>
";

echo "
<tr><td> <br> <b> Saldo Akhir </td><td align=right><br> <b>".number_format($mtot,0,',','.')."</td></tr>
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
UD. ANGEL<BR>
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
echo "<tr><td> <b> <hr> Penjualan Bersih </td><td align=right> <b> <hr> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

if ($rrow[rekid]=='40010')
{
echo "<tr><td> <b> <hr> Total HPP </td><td align=right> <b> <hr> $mctot2 </td><td><b>_</td></tr>
<tr ><td> <b> <hr> <font color=$mcolor> $mlorr Kotor </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";

$mtotal=0;
}

if ($rrow[rekid]=='40310')
{
echo "<tr><td> <b> <hr> Total Biaya </td><td align=right> <b> <hr> $mctot2 </td><td><b>_</td></tr>
<tr color=$mcolor><td> <b> <hr> <font color=$mcolor> $mlorr sebelum pajak </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

$mjum=number_format(abs($mjj[jumlah]),0,',','.');

echo "<tr><td>$rrow[rekid] $rrow[reknama] </td><td align=right> $mjum </td></tr>";

$mtotal=$mtotal+$mjj[jumlah];
$mtotalall=$mtotalall+$mjj[jumlah];

if ($mtotalall<0)
{$mlorr='Rugi';$mcolor='red';$mctot='('.number_format(abs($mtotalall),0,',','.').')'; $mctot2=number_format(abs($mtotal),0,',','.') ; }
else
{$mlorr='Laba';$mcolor='blue';$mctot=number_format($mtotalall,0,',','.'); $mctot2=number_format(abs($mtotal),0,',','.'); }

}


echo "
<tr><td> <b> <hr> Total HPP </td><td align=right> <b> <hr> $mtotal </td></tr>
<tr ><td> <b> <hr> <font color=$mcolor> Total $mlorr </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </td></tr>
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
echo "<tr><td> <b> <hr> Penjualan Bersih </td><td align=right> <b> <hr> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

if ($rrow[rekid]=='40010')
{
echo "<tr><td> <b> <hr> Total HPP </td><td align=right> <b> <hr> $mctot2 </td><td><b>_</td></tr>
<tr ><td> <b> <hr> <font color=$mcolor> $mlorr Kotor </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";

$mtotal=0;
}

if ($rrow[rekid]=='40310')
{
echo "<tr><td> <b> <hr> Total Biaya </td><td align=right> <b> <hr> $mctot2 </td><td><b>_</td></tr>
<tr color=$mcolor><td> <b> <hr> <font color=$mcolor> $mlorr sebelum pajak </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </td></tr>
<tr><td>&nbsp;</td></tr>
";
$mtotal=0;
}

$mjum=number_format(abs($mjj[jumlah]),0,',','.');

echo "<tr><td>$rrow[rekid] $rrow[reknama] </td><td align=right> $mjum </td></tr>";

$mtotal=$mtotal+$mjj[jumlah];
$mtotalall=$mtotalall+$mjj[jumlah];

if ($mtotalall<0)
{$mlorr='Rugi';$mcolor='red';$mctot='('.number_format(abs($mtotalall),0,',','.').')'; $mctot2=number_format(abs($mtotal),0,',','.') ; }
else
{$mlorr='Laba';$mcolor='blue';$mctot=number_format($mtotalall,0,',','.'); $mctot2=number_format(abs($mtotal),0,',','.'); }

}


echo "
<tr><td> <b> <hr> Total HPP </td><td align=right> <b> <hr> $mtotal </td></tr>
<tr ><td> <b> <hr> <font color=$mcolor> Total $mlorr </td><td align=right> <b> <hr> <font color=$mcolor> $mctot </font></td></tr>
<tr><td>&nbsp;</td></tr>
</table>
";

echo("
</td></tr>
</table>
");

}


//////////////////////beg of LAPORAN PELUNASAN PIUTANG////////////////////////
if ($mLapo=='mlaplunaspiutang')
{
	$link=open_connection();
	$a=execute("select lgnnama from setlgn where lgnid = '$mrute'");
	// $sqlstr=" select a.*,b.lgnnama,c.nid jualid,c.tgl tgljual,c.debet from bkbesar a 
	// left join setlgn b on a.bpid=b.lgnid
	// left join (select bpid,nid,tgl,debet from bkbesar where rekid='10210' and debet<>0) c 
	// on a.nid2=c.nid and a.bpid=c.bpid 
	// where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') 
	// and a.bpid like '%$mrute%' and a.rekid='10210' and a.trans='TRANSLUNASPIUTANG' and kredit<>0 
	// group by a.nid,c.nid order by b.lgnnama,a.nid ";

	//========================================================

	$sqlstr= " select a.* , b.lgnnama, c.nid jualid, c.tgl tgljual, ifnull(c.debet,0) debet FROM 
	(select x . * , y.cara_bayar FROM bkbesar x, (SELECT nid,
	CASE WHEN SUBSTRING( rekid, 1, 3 ) = '101' THEN 'Transfer' WHEN rekid = '10010' THEN 'Tunai' WHEN rekid = '10220' 
	THEN 'Giro' END AS cara_bayar FROM bkbesar WHERE tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )) y 
	WHERE x.nid = y.nid AND cara_bayar IS NOT null) a 
	LEFT JOIN setlgn b ON a.bpid = b.lgnid 
	LEFT JOIN (SELECT bpid, nid, tgl, ifnull(debet,0) debet FROM bkbesar WHERE rekid = '10210' AND debet <>0 ) c ON a.nid2 = c.nid 
	AND a.bpid = c.bpid 
	left join transkasir1 d on a.nid2=d.nid
	WHERE a.tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )
	AND a.bpid LIKE '%$mrute%' AND a.rekid = '10210' AND a.trans = 'TRANSLUNASPIUTANG' 
	and a.cara_bayar LIKE '%$mjnsbayar%' and d.kasir like '%$mksir%' 
	AND kredit <>0 GROUP BY a.nid, c.nid ORDER BY b.lgnnama, a.nid ";
	//========================================================

	$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
	$norow=mysql_num_rows($result);

	mysql_close($link);
	echo("
	Laporan Pelunasan Piutang
	<br>Tgl. $mtg1 s.d. $mtg2
	<br> Pelanggan : $a[lgnnama]
	<br><br>
	<table width=97% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>

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
	$sql1="select sum(ifnull(kredit,0)) kredit from bkbesar where rekid='10210' and trans='TRANSRETURJUAL' and nid2='$row[jualid]' ";
	$rowr=execute($sql1);
	$sql2="select sum(ifnull(kredit,0)) kredit from bkbesar where rekid='10210' and trans in ('TRANSLUNASPIUTANG','TRANSKASIR') and nid2='$row[jualid]' and nid<>'$row[nid]'";
	$rowp=execute($sql2);
	$msaldo=$row[debet]-$rowr[kredit]-$rowp[kredit];
	
	$sqlsaldo = "SELECT sum(ifnull(a.debet,0) - ifnull(b.total,0)) debet 
	FROM bkbesar a left JOIN 
	(select jualid,total from transreturjual1) b on a.nid=b.jualid 
	WHERE a.rekid = '10210' AND a.debet <>0 and a.nid in 
	(select nid2 from bkbesar where nid='$row[nid]')";
	$rowsaldosmzd=execute($sqlsaldo);

	$sqlpaidbfr = "SELECT sum(ifnull(kredit,0)) kredit from bkbesar where rekid='10210' and trans in ('TRANSLUNASPIUTANG','TRANSKASIR') and nid2 in (select nid2 from bkbesar where nid='$row[nid]')
	and nid<>'$row[nid]'";
	$rowpaidbfrsmzd=execute($sqlpaidbfr);

	$sql3="select sum(ifnull(kredit,0)) potongan from bkbesar where rekid='10210' and nid='$row[nid]' and ket like '%Potongan%' and nid2='$row[jualid]' ";
	$row2=execute($sql3);
	$sql4="select sum(ifnull(debet,0)) kupon from bkbesar where rekid='20310' and nid='$row[nid]' and nid2='$row[jualid]' ";
	$row3=execute($sql4);

	$sql5="select sum(ifnull(debet,0)) giro from bkbesar where rekid='10220' and nid='$row[nid]'";//GIRO
	// //$sql5="select sum(ifnull(kredit,0)) giro from bkbesar where nid='$row[nid]'  and trans='TRANSLUNASPIUTANG' and nid2='$row[jualid]'";//GIRO
	// $sql5=" SELECT ifnull(x.kredit,0) giro FROM bkbesar x, (SELECT nid,CASE WHEN SUBSTRING( rekid, 1, 3 ) = '101'THEN 'Transfer' 
	// WHEN rekid = '10010' THEN 'Tunai' WHEN rekid = '10220' THEN 'Giro' END AS cara_bayar 
	// FROM bkbesar WHERE tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )) y 
	// WHERE x.nid = y.nid AND cara_bayar IS NOT NULL AND x.nid = '$row[nid]' 
	// AND x.nid2 = '$row[nid2]' AND cara_bayar = 'Giro'";
	$row4=execute($sql5); //GIRO

	$sql6="select sum(ifnull(debet,0)) transfer from bkbesar where rekid like '101%' and nid='$row[nid]'";//TRANSFER
	//$sql6="select sum(ifnull(kredit,0)) transfer from bkbesar where  nid='$row[nid]'   and trans='TRANSLUNASPIUTANG' and nid2='$row[jualid]'";//TRANSFER

	// $sql6="SELECT ifnull(x.kredit,0) transfer FROM bkbesar x, (SELECT nid,CASE WHEN SUBSTRING( rekid, 1, 3 ) = '101'THEN 'Transfer' 
	// WHEN rekid = '10010' THEN 'Tunai' WHEN rekid = '10220' THEN 'Giro' END AS cara_bayar 
	// FROM bkbesar WHERE tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )) y 
	// WHERE x.nid = y.nid AND cara_bayar IS NOT NULL AND x.nid = '$row[nid]' 
	// AND x.nid2 = '$row[nid2]' AND cara_bayar = 'Transfer'";
	$row5=execute($sql6); //TRANSFER

	$sql7="select sum(ifnull(debet,0)) tunai from bkbesar where rekid='10010' and nid='$row[nid]'";//TUNAI
	//$sql7="select sum(ifnull(kredit,0)) tunai from bkbesar where  nid='$row[nid]' and trans='TRANSLUNASPIUTANG' and nid2='$row[jualid]'";//TUNAI
	// $sql7="SELECT ifnull(x.kredit,0) tunai FROM bkbesar x, (SELECT nid,CASE WHEN SUBSTRING( rekid, 1, 3 ) = '101'THEN 'Transfer' 
	// WHEN rekid = '10010' THEN 'Tunai' WHEN rekid = '10220' THEN 'Giro' END AS cara_bayar 
	// FROM bkbesar WHERE tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )) y 
	// WHERE x.nid = y.nid AND cara_bayar IS NOT NULL AND x.nid = '$row[nid]' 
	// AND x.nid2 = '$row[nid2]' AND cara_bayar = 'TUNAI'";
	$row6=execute($sql7); //TUNAI
	
	//$sqldetailbayar = " select sum(ifnull(kredit,0)) kredit from bkbesar where nid = '$row[nid]' and nid2='$row[jualid]' ";
	//$sqldetailbayar = " select sum(ifnull(kredit,0)) kredit from bkbesar where nid = '$row[nid]'";
	//$rowdetailbayar=execute($sqldetailbayar); //ambil detail bayar
	//$sisadetail = $msaldo - $rowdetailbayar[kredit];

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
	<!-- retur-->
	<td bgcolor=white align=right>".number_format($rowr[kredit],0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right>".number_format($rowp[kredit],0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right>".number_format($msaldo,0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right>".number_format($row2[potongan],0,'.',',')."&nbsp;</td>
	");

	if ($mnidd!=$row[nid])
	{
		$rowcc=executerow("select nid2 from bkbesar where rekid='10210' and kredit<>0 and nid='$row[nid]' and nid2<>'' group by nid2");
		$jumm=mysql_num_rows($rowcc);
		// if($jumm==1) 
		// 	{
		// 		$jumm=1;
		// 	}
		if ($norow ==1){
			$jumm=1;
		}
		$msisa=$rowsaldosmzd[debet]-$rowpaidbfrsmzd[kredit]-$row2[potongan]-$row3[kupon]-$row4[giro]-$row5[transfer]-$row6[tunai];
		echo("
		<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row4[giro],0,'.',',')."&nbsp;</td>
		<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row5[transfer],0,'.',',')."&nbsp;</td>
		<td bgcolor=white align=right rowspan=".$jumm.">".number_format($row6[tunai],0,'.',',')."&nbsp;</td>
		<td bgcolor=white align=right rowspan=".$jumm.">".number_format($msisa,0,'.',',')."&nbsp;</td>
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
	<td bgcolor=white align=right><b>".number_format($mtot7,0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right><b>".number_format($mtot8,0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right><b>".number_format($mtot9,0,'.',',')."&nbsp;</td>
	<td bgcolor=white align=right><b>".number_format($mtot4-$mtot5-$mtot6-$mtot7-$mtot8-$mtot9,0,'.',',')."&nbsp;</td> 
	</tr>
	");

}
//////////////////////end of LAPORAN PELUNASAN PIUTANG////////////////////////


//////////////////////bEginning of LAPORAN PELUNASAN HUTANG////////////////////////
if ($mLapo=='mlaplunashutang')
{
$link=open_connection();
$a=execute("select supnama from setsup where supid = '$mrute'");
// $sqlstr="
// select a.*,b.supnama,c.nid jualid,c.tgl tgljual,c.kredit from bkbesar a left join setsup b on a.bpid=b.supid
// left join (select bpid,nid,tgl,kredit from bkbesar where rekid='20010' and kredit<>0) c on a.nid2=c.nid and a.bpid=c.bpid
// where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')    and a.bpid like '%$mrute%' and a.trans='TRANSLUNASHUTANG' and a.rekid='20010' and debet<>0 
// group by a.nid,c.nid
// order by a.nid,b.supnama,a.nid";

$sqlstr="select a.*,b.supnama,c.nid jualid,c.tgl tgljual,c.kredit 
from  (select x . * , y.cara_bayar FROM bkbesar x, 
(SELECT nid, 
    CASE WHEN SUBSTRING( rekid, 1, 3 ) = '101' and SUBSTRING( ket, 11, 3 ) = 'TRF' THEN 'Transfer' 
        WHEN rekid = '10010' and kredit <> 0 THEN 'Tunai' 
        WHEN rekid = '20110'  and kredit <> 0 THEN 'Giro' END AS cara_bayar 
        FROM bkbesar 
        WHERE tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y' ) 
        AND STR_TO_DATE('$mtg2', '%d-%c-%Y' )) y 
        WHERE x.nid = y.nid AND cara_bayar IS NOT null) a
left join setsup b on a.bpid=b.supid 
left join (select bpid,nid,tgl,kredit from bkbesar where rekid='20010' and kredit<>0) c 
on a.nid2=c.nid and a.bpid=c.bpid where a.tgl between str_to_date('$mtg1','%d-%c-%Y') 
and str_to_date('$mtg2','%d-%c-%Y') and a.bpid like '%$mrute%'  and a.cara_bayar LIKE '%$mjnsbayar%' and a.trans='TRANSLUNASHUTANG' 
and a.rekid='20010' and debet<>0 group by a.nid,c.nid order by a.nid,b.supnama,a.nid ";

$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1! ".mysql_error());
mysql_close($link);
echo("
Laporan Pelunasan Hutang
<br>Tgl. $mtg1 s.d. $mtg2
<br> Supplier : $a[supnama]
<br>
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
//$row5=execute("select sum(kredit) transfer from bkbesar where rekid like '101%' and nid='$row[nid]' and bpid='$row[bpid]' ");
$row5=execute("select sum(kredit) transfer from bkbesar where rekid like '101%' and nid='$row[nid]' and ket like '%TRF%'");
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

//////////////////////ENF OF of LAPORAN PELUNASAN HUTANG////////////////////////





if ($mLapo=='mlapbelijt')
{

$sqlstr="select a.*,b.supnama,date_format(tgl,'%d-%m-%Y') tglc,date_format(tgljt,'%d-%m-%Y') tgljtc,date_format(tgljt,'%d') tgljth
from transbeli1 a left join setsup b on a.supid=b.supid
where tgljt between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid!!'
order by a.nid,a.tgl
";

echo("

UD. ANGEL
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
<td align=right>".number_format($mrr[jumlah],0,',','.')."</td>
<td align=right>".number_format($mrr[tunai],0,',','.')."</td>
<td align=right>".number_format($mrr[total],0,',','.')."</td>
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
<td align=right><b>".number_format($totot,0,',','.')."</td>
<td align=right><b>".number_format($tottunai,0,',','.')."</td>
<td align=right><b>".number_format($tothutang,0,',','.')."</td>
</td>
</tr>
</table>
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
	UD. ANGEL
	<br>
	Laporan Pembelian Detail
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
			<th>Nota</th>
			<th>Nama Suplier</th>
			<th>Nama Stok</th>
			<th>Qty</th>
			<th>Sat.</th>
			<th>unit</th>
			<th>Sat.2</th>
			<th>Hrg Sat.</th>
			<th>Jumlah</th>
			<th>Jumlah</th>
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
		where a.nid="'.$mrr[nid].'" and b.grpid like "%'.$mgrpid.'%"
		order by nomor
		');
		
		$mnomor=1;
		$mtotalqty=0;
		
		$jmlhrg=0;
		
		while ($msx=mysql_fetch_assoc($mss))
		{
			echo '
		<tr>
			<td align=left>'.$msx[tglc].'.</td>
			<td>'.$msx[nid].'</td>
			<td>'.$msx[supnama].'</td>
			<td>'.$msx[stonama].'</td>
			<td align=right>&nbsp;&nbsp;&nbsp;'.number_format($msx[qty],0,',','.').'</td>
			<td>&nbsp;'.$msx[satuan1].'</td>
			<td align=right>&nbsp;&nbsp;&nbsp;'.number_format($msx[unit],0,',','.').'</td>
			<td>&nbsp;'.$msx[satuan2].'</td>
			<td align=right>'.number_format($msx[hrgsat],0,',','.').'</td>
			<td align=right>'.number_format($msx[jmlhrg],0,',','.').'</td>
		</tr>
			';
			
			$mnomor++;
			$mtotalqty=$mtotalqty+$msx[qty];
			
			$jmlhrg=$jmlhrg+$msx[jmlhrg];
		}

		echo "
		<tr valign=top>
			<td colspan=4 align=right><b>TOTAL&nbsp<br>&nbsp</td>
			<td align=right><b>".number_format($mtotalqty,0,',','.')."</td>
			<td colspan=4>&nbsp;</td>
			<td align=right><b>".number_format($jmlhrg,0,',','.')."</td>
			<td align=right><b>".number_format($jmlhrg,0,',','.')."</td>
			</tr>
		";

		$totot=$totot+$jmlhrg;
		
		$tottunai=$tottunai+$mrr[tunai];
		$tothutang=$tothutang+$mrr[jumlah];

		$nn++;
	}

	echo "

		<tr valign=top>
			<td colspan=10 align=right><b>GRAND TOTAL&nbsp<br>&nbsp</td>
			<td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($totot,0,',','.')."</td>
			<td align=right></td>
		</tr>
	</table>
	<br><br>
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

$sqlstr="select (select sum(bayar-kembali) from transkasir1 where kasir=a.kasir and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')) as tunai,
(select sum(edc) from transkasir1 where kasir=a.kasir and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and kartu='BCA') as bca,
(select sum(edc) from transkasir1 where kasir=a.kasir and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and kartu='Mandiri') as mandiri,
(select sum(edc) from transkasir1 where kasir=a.kasir and tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and kartu='Muamalat') as muamalat,
sum(total) jumlah,kasir,count(*) jnota
from transkasir1 a
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
group by kasir
";

echo("
UD. ANGEL
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

<th>NO</th>
<th>KASIR</th>
<th>TUNAI</th>
<th>BCA</th>
<th>MANDIRI</th>
<th>MUAMALAT</th>
<th>JUMLAH</th>
<th>JUMLAH NOTA</th>
</tr>

";

$nn=1;
$totot=0;
$tottunai=0;
$tothutang=0;
$mnomor=1;
$mtotal=0;
$mtotal2=0;
$ttlbca = 0;
$ttltunai = 0;
$ttlmandiri =0;
$ttlmuamalat = 0;
while ($msx=mysql_fetch_object($maa))
{

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->kasir</td>
<td align=right>".number_format($msx->tunai,0,',','.')."</td>
<td align=right>".number_format($msx->bca,0,',','.')."</td>
<td align=right>".number_format($msx->mandiri,0,',','.')."</td>
<td align=right>".number_format($msx->muamalat,0,',','.')."</td>
<td align=right>".number_format($msx->jumlah,0,',','.')."</td>
<td align=right>".number_format($msx->jnota,0,',','.')."</td>
</tr>
";

$mnomor++;
$ttlbca = $ttlbca+$msx->bca;
$ttlmandiri = $ttlmandiri+$msx->mandiri;
$ttlmuamalat = $ttlmuamalat+$msx->muamalat;
$ttltunai = $ttltunai+$msx->tunai;
$mtotal=$mtotal+$msx->jumlah;
$mtotal2=$mtotal2+$msx->jnota;

}

echo "
<tr >
<td colspan=2><b>Total</td>
<td align=right ><b>".number_format($ttltunai,0,',','.')."</b></td>
<td align=right ><b>".number_format($ttlbca,0,',','.')."</td>
<td align=right ><b>".number_format($ttlmandiri,0,',','.')."</td>
<td align=right ><b>".number_format($ttlmuamalat,0,',','.')."</td>
<td align=right ><b>".number_format($mtotal,0,',','.')."</td>
<td align=right ><b>".number_format($mtotal2,0,',','.')."</td>
</tr>
";

/*

*/

}


if ($mLapo=='mlapdistribusi')
{
	$sqlstr='
	select a.stoid, a.qty, a.isi, a.jmlhrg, a.nid, date_format(a.tgl, "%d-%m-%Y") tgl, a.hrgsat, b.stonama, b.satuan1, b.satuan2, b.isi isi_b, c.lgnid, d.lgnnama, d.kontak, d.Keterangan
	from transkasir2 a
	left join setstok b on a.stoid=b.stoid
	left join transkasir1 c on a.nid=c.nid
	left join setlgn d on c.lgnid=d.lgnid
	WHERE a.tgl between str_to_date("'.$mtg1.'", "%d-%c-%Y") and str_to_date("'.$mtg2.'", "%d-%c-%Y") and b.supid like "%'.$msupid.'%" and b.grpid like "%'.$mgrpid.'%" and a.stoid like "%'.$mstoid.'%" and c.kasir like "!!'.$mkarid.'!!"
	order by a.nid, a.tgl
	';
	
	$sqlsup = "
	select *
	from setsup
	where supid = '$msupid'
	";
	$rowsup_3313 = executerow($sqlsup);
	$rowsup = mysql_fetch_assoc ($rowsup_3313);
	$msupnama = $rowsup[supnama];
	$sqllgn = "
	select *
	from setlgn
	where lgnid = '$mlgnid'
	";
	$rowlgn_3321 = executerow($sqllgn);
	$rowlgn = mysql_fetch_assoc ($rowlgn_3321);
	$mlgnnama = $rowlgn[lgnnama];
	$sqlsto = '
	select *
	from setstok
	where stoid = "'.$mstoid.'"
	';
	$rowsto_3329 = executerow($sqlsto);
	$rowsto = mysql_fetch_assoc ($rowsto_3329);
	$mstonama = $rowsto[stonama];
	$sqlkar = "
	select *
	from setkaryawan
	where karid = '$mkarid'
	";
	$rowkar_3337 = executerow($sqlkar);
	$rowkar = mysql_fetch_assoc ($rowkar_3337);
	$mkarnama = $rowkar[karnama];

	echo('
	UD. ANGEL
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
			<th>Kelurahan</th>
			<th>Kecamatan</th>
		</tr>
	";

	$nn=1;

	$totot=0;
	
	$tot_qty=0;

	while ($mrr=mysql_fetch_object($maa))
	{
		//$temttlqty = $mrr->qty*$mrr->isi+$mrr->unit;
		$temttlqty = $mrr->qty*$mrr->isi;
		
		$hrgsat = $mrr->hrgsat/$mrr->isi;
		//$totot += ($hrgsat*$temttlqty);
		$totot += ($mrr->jmlhrg);
		
		$tot_qty=$tot_qty+$temttlqty;
		$isi=$mrr->isi_b;
		$satuan1=$mrr->satuan1;
		$satuan2=$mrr->satuan2;
		
		echo "
		<tr valign= height=25>
			<td>$nn</td>
			<td>$mrr->stoid</td>
			<td>$mrr->stonama</td>
			<td align=right>".cqty2($temttlqty, $mrr->isi_b, 1, $mrr->satuan1, $mrr->satuan2, '-')."</td>
			<td align=right>".number_format($mrr->jmlhrg,0,',','.')."&nbsp;</td>
			<td>&nbsp;".$mrr->nid."</td>
			<td>$mrr->tgl</td>
			<td>$mrr->lgnid</td>
			<td>$mrr->lgnnama</td>
			<td>$mrr->kontak</td>
			<td>$mrr->Keterangan</td>
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
			<td style="text-align: right; font-weight: bold;">'.cqty2($tot_qty, $isi, 1, $satuan1, $satuan2, "-").'</td>
			<td align=right><b>'.number_format($totot,0,',','.').'&nbsp;</td>
			<td colspan=6>&nbsp;</td>
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
			<td align=right><b>".number_format($totot,0,',','.')."&nbsp;</td>
			<td colspan=6>&nbsp;</td>
		</tr>
	</table>
		";
	}
}


if ($mLapo=='mlapreturbeli')
{

$sqlstr="select a.*,b.supnama
from transreturbeli1 a left join setsup b on a.supid=b.supid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.supid like '!!$msupid!!'  order by a.nid,a.tgl
";

echo(" 
UD. ANGEL
<br>
Laporan Retur Pembelian
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
<th>Unit</th>
<th>Sat.</th>
<th>Hrg Sat.</th>
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
<td colspan=10>
&nbsp;&nbsp;Kode : $mrr->nid 
&nbsp;&nbsp;&nbsp; Tgl : $mrr->tgl 
&nbsp;&nbsp;&nbsp; Pelanggan : $mrr->supid - $mrr->supnama 
&nbsp;&nbsp;&nbsp; Dipotong ke Nota : $mrr->beliid
</td>
</tr>
";

$mss=executerow("
select a.*,b.stonama,
if ( qty>0, format(qty,0),'-') cqty,
if ( qty>0, b.satuan1,'') satuan1,
if ( unit>0, format(unit,0),'-') cunit,
if ( unit>0, b.satuan2,'') satuan2 
from transreturbeli2 a left join setstok b on a.stoid=b.stoid where a.nid='$mrr->nid'  and a.stoid like '$mstoid%' order by nomor");

$mnomor=1;
$mtotqty=0;
while ($msx=mysql_fetch_object($mss))
{

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->stoid</td>
<td>$msx->stonama</td>
<td align=right>&nbsp;&nbsp;&nbsp; $msx->cqty&nbsp;</td>
<td>&nbsp;$msx->satuan1</td>
<td align=right>&nbsp;&nbsp;&nbsp; $msx->cunit&nbsp;</td>
<td>&nbsp;$msx->satuan2</td>
<td align=right>".number_format($msx->hrgsat,0,'.',',')."</td>
<td align=right>".number_format($msx->jmlhrg,0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotqty=$mtotqty+$msx->qty;

}

$mjt=$mrr->tgljt;
if ($mrr->tgljt=='0000-00-00')
{
$mjt=$mrr->tgl;
}


echo "

<tr valign=top>
<td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
<td align=right><b>".number_format($mtotqty,0,'.',',')."&nbsp;</td>
<td colspan=4>&nbsp;</td>
<td align=right><b>".number_format($mrr->total,0,'.',',')."</td>
</tr>

";

$totot=$totot+$mrr->total;
$tottunai=$tottunai+$mrr->tunai;
$tothutang=$tothutang+$mrr->jumlah;


$nn++;
//echo "<tr><td colspan=11> Retur :</td></tr>";
}

echo "
</table>
<br><br>
";

}

if ($mLapo=='mlapjualkiriman')
{
$sqlstr="select a.bpid stoid,b.barcode,sum(a.qtyout-a.qtyin) qty,sum(a.kredit-a.debet) hpp,b.stonama,b.isi,b.satuan1,b.satuan2
from bkbesar a left join setstok b on a.bpid=b.stoid
left join transjual1 c on a.nid=c.nid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and c.lgnid like '!!$mlgnid!!'  and a.trans='TRANSKASIR' 
and a.rekid like '103%' and c.sales like '!!$msalesid!!' group by a.bpid order by a.bpid
";

$sqlstr="select a.stoid,b.barcode,sum( ( a.qty*a.isi)+a.unit ) qty,sum(a.jmlhrg) jmlhrg,b.stonama,b.isi,b.satuan1,b.satuan2
from transjual2 a 
left join setstok b on a.stoid=b.stoid
left join setsup j on b.supid=j.supid
left join transjual1 c on a.nid=c.nid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and c.lgnid like '!!$mlgnid!!'  
and b.isppn like '$misppn%' and c.sales like '!!$msalesid!!' 
group by a.stoid order by b.stonama
";

echo(" 
UD. ANGEL
<br>
Laporan Rekap Penjualan
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

<th >No.</th>
<th align='left'>&nbsp;&nbsp;Bar Code</th>
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
while ($msx=mysql_fetch_object($maa))
{

$wrr=execute2("select sum(kredit) hpp from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and bpid='$msx->stoid' and rekid='10310' and kredit<>0 and trans='transjual' and nid in (select nid from transjual1 c where c.lgnid like '!!$mlgnid!!' and c.sales like '!!$msalesid!!') ");

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->barcode</td>
<td>$msx->stonama</td>
<td align=right>".cqty($msx->qty,$msx->isi,1,$msx->satuan1,$msx->satuan2,'')."</td>
<td align=right>".number_format($msx->jmlhrg,0,'.',',')."</td>
<td align=right>".number_format($wrr->hpp,0,'.',',')."</td>
<td align=right>".number_format($msx->jmlhrg-$wrr->hpp,0,'.',',')."</td>
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
<td align=right><b>".number_format($mtotal2,0,'.',',')."</td>
<td align=right><b>".number_format($mtotal-$mtotal2,0,'.',',')."</td>
</tr>
";

if ($misppn=='PPN')
{
echo "
<tr valign=>
<td colspan=4 align=right><b>PPN&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal*0.1,0,'.',',')."</td>
<td align=right><b> </td>
<td align=right><b> </td>
</tr>

<tr valign=>
<td colspan=4 align=right><b>TOTAL SETELAH PPN&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal-($mtotal*0.1),0,'.',',')."</td>
<td align=right><b> </td>
<td align=right><b> </td>
</tr>
";
}

}
if ($mLapo=='mlapjual2new')
{
	$sqlstr="
	select c.stonama, e.lgnnama, b.jmlhrg,
	case
		when e.golongan='A' then 'Golongan A'
		when e.golongan='B' then 'Golongan B'
		when e.golongan='C' then 'Golongan C'
	end as channel,
	f.karnama, date_format(a.tgl, '%d-%m-%Y') tgl, a.nid, b.totqty, ((b.hrgsat/b.isi) * ((b.qty*b.isi)+b.unit)) as jumlah, 
	ifnull(h.nid,'') as no_retur, ifnull(h.totqty,0) as totqty_retur, 
	ifnull(h.jmlhrg,0) as jumlah_retur, 
	((b.hrgsat/b.isi)*(b.diskonrp/100)*b.totqty) as diskon_rp, 
	(b.jmlhrg-ifnull(h.jmlhrg,0)) as jumlah_dpp,
	((b.jmlhrg-ifnull(h.jmlhrg,0))*0.1) as jumlah_ppn 
	from transjual1 a
	left join transjual2 b on a.nid=b.nid 
	left join setstok c on b.stoid=c.stoid 
	left join setsup d on c.supid=d.supid 
	left join setlgn e on a.lgnid=e.lgnid 
	left join setkaryawan f on a.sales=f.karid 
	left join transreturjual1 g on a.nid=g.jualid 
	left join transreturjual2 h on g.nid=h.nid and b.stoid=h.stoid 
	left join setgrp i on c.grpid=i.grpid 
	where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and a.lgnid like '!!$mlgnid!!'  and a.sales like '!!$msalesid!!' and c.grpid like '!!$mgrpid!!'
	";
	
	echo(" 
	UD. ANGEL
	<br>
	Laporan Penjualan Detail
	<br><br>Tgl.  $mtg1 s.d. $mtg2 $mtgt <br>
	Kasir : $msalesnama <br> 
	Pelanggan : $mlgnnama <br> 
	Group Stok : $mgrpnama<br><br>
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
		<th>Nama Produk</th>
		<th>Pelanggan</th>
		<th>Channel</th>
		<th>Sales</th>
		<th>Tgl Trans.</th>
		<th>No Trans.</th>
		<th>Qty</th>
		<th>Jumlah</th>
		<th>No.Retur</th>
		<th>Qty</th>
		<th>Jumlah</th>
		<th>Diskon</th>
		<th>Total</th>
		<th>PPN</th>
		<th>DPP</th>
	</tr>
	";
	$nn=1;
	$mnomor=1;
	$mtotaljumlah=0;
	$mtotaljmlretur=0;
	$mtotaljmldisk=0;
	$totaldpp=0;
	$totalppn=0;
	$totalnett=0;
	while ($msx=mysql_fetch_object($maa))
	{
		//$wrr=execute2("select sum(kredit) hpp from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and bpid='$msx->stoid' and rekid='10310' and kredit<>0 and trans='transjual' and nid in (select nid from transjual1 c where c.lgnid like '!!$mlgnid!!' and c.sales like '!!$msalesid!!') ");
		echo "
	<tr>
		<td align=right>$mnomor.</td>
		<td>$msx->stonama</td>
		<td>$msx->lgnnama</td>
		<td>$msx->channel</td>
		<td>$msx->karnama</td>
		<td>$msx->tgl</td>
		<td>$msx->nid</td>
		<td align=right>".number_format($msx->totqty,0,'.',',')."</td>
		<td align=right>".number_format($msx->jmlhrg,0,'.',',')."</td>
		<td>$msx->no_retur</td>
		<td align=right>".number_format($msx->totqty_retur,0,'.',',')."</td>
		<td align=right>".number_format($msx->jumlah_retur,0,'.',',')."</td>
		<td align=right>".number_format(0,0,'.',',')."</td>
		<td align=right>".number_format($msx->jumlah_dpp,0,'.',',')."</td>
		<td align=right>".number_format($msx->jumlah_ppn,0,'.',',')."</td>
		<td align=right>".number_format($msx->jumlah_dpp-$msx->jumlah_ppn,0,'.',',')."</td>
	</tr>
		";
		
		$mnomor++;
		$mtotaljumlah=$mtotaljumlah+$msx->jmlhrg;
		$mtotaljmlretur=$mtotaljmlretur+$msx->jumlah_retur;
		$mtotaljmldisk=$mtotaljmldisk+$msx->diskon_rp;
		$totaldpp=$totaldpp+$msx->jumlah_dpp;
		$totalppn=$totalppn+$msx->jumlah_ppn;
		$totalnett=$totalnett+($msx->jumlah_dpp-$msx->jumlah_ppn);
	}
	
	echo "
	<tr valign=>
	<td colspan=8 align=right><b>TOTAL&nbsp&nbsp</td>
	<td align=right><b>".number_format($mtotaljumlah,0,'.',',')."</td><td></td><td></td>
	<td align=right><b>".number_format($mtotaljmlretur,0,'.',',')."</td>
	<td align=right><b>".number_format(0,0,'.',',')."</td>
	<td align=right><b>".number_format($totaldpp,0,'.',',')."</td>
	<td align=right><b>".number_format($totalppn,0,'.',',')."</td>
	<td align=right><b>".number_format($totalnett,0,'.',',')."</td>
	</tr>
</table>
	";
}

if ($mLapo=='mlapjual2newexcel')
{
$sqlstr="
select d.supnama,i.grpnama,c.stonama,c.barcode,a.lgnid,e.lgnnama,e.alamat,e.rute,
case when e.golongan='A' then 'PROVISION' 
when e.golongan='B' then 'WHOLE SELLER' when e.golongan='C' then 'SUPERMARKET' end as channel,
a.sales,f.karnama, date_format(a.tgl,'%d-%m-%Y') tgl,a.nid,b.totqty,
((b.hrgsat/b.isi) * ((b.qty*b.isi)+b.unit)) as jumlah, 
ifnull(h.nid,'') as no_retur,ifnull(h.totqty,0) as totqty_retur, 
ifnull(h.jmlhrg,0) as jumlah_retur, 
((b.hrgsat/b.isi)*(b.diskonrp/100)*b.totqty) as diskon_rp, 
(b.jmlhrg-ifnull(h.jmlhrg,0)) as jumlah_dpp,
((b.jmlhrg-ifnull(h.jmlhrg,0))*0.1) as jumlah_ppn 
from transjual1 a left join transjual2 b on a.nid=b.nid 
left join setstok c on b.stoid=c.stoid 
left join setsup d on c.supid=d.supid 
left join setlgn e on a.lgnid=e.lgnid 
left join setkaryawan f on a.sales=f.karid 
left join transreturjual1 g on a.nid=g.jualid 
left join transreturjual2 h on g.nid=h.nid and b.stoid=h.stoid 
left join setgrp i on c.grpid=i.grpid 
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') 
and a.lgnid like '!!$mlgnid!!'  and a.sales like '!!$msalesid!!' and 
c.grpid like '!!$mgrpid!!'
";

echo(" 
UD. ANGEL
<br>
Laporan Penjualan Detail
<br><br>Tgl.  $mtg1 s.d. $mtg2 $mtgt <br>
Kasir : $msalesnama <br> 
Pelanggan : $mlgnnama <br> 
Group Stok : $mgrpnama<br><br>
");

$maa=executerow($sqlstr);
$mjumlah=mysql_num_rows($maa);
if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Supplier</th><th>Nama Group</th><th>Nama Produk</th><th>Barcode</th><th>Code Pelanggan</th>
<th>Nama Pelanggan</th><th>Alamat</th><th>Rute</th><th>Channel</th><th>Kode Sales</th>
<th>Nama Sales</th><th>Tgl Trans.</th><th>No Trans.</th><th>Qty</th><th>Jumlah</th>
<th>No.Retur</th><th>Qty</th><th>Jumlah</th><th>Diskon Rp</th>
<th>DPP</th><th>PPN</th><th>Nett</th>
</tr>
";
$nn=1;
$mnomor=1;
$mtotaljumlah=0;
$mtotaljmlretur=0;
$mtotaljmldisk=0;
$totaldpp=0;
$totalppn=0;
$totalnett=0;
while ($msx=mysql_fetch_object($maa))
{
//$wrr=execute2("select sum(kredit) hpp from bkbesar where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') and bpid='$msx->stoid' and rekid='10310' and kredit<>0 and trans='transjual' and nid in (select nid from transjual1 c where c.lgnid like '!!$mlgnid!!' and c.sales like '!!$msalesid!!') ");
echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx->supnama</td>
<td>$msx->grpnama</td>
<td>$msx->stonama</td>
<td>$msx->barcode</td>
<td>$msx->lgnid</td>
<td>$msx->lgnnama</td>
<td>$msx->alamat</td>
<td>$msx->rute</td>
<td>$msx->channel</td>
<td>$msx->sales</td>
<td>$msx->karnama</td>
<td>$msx->tgl</td>
<td>$msx->nid</td>
<!--<td align=right>".cqty($msx->qty,$msx->isi,1,$msx->satuan1,$msx->satuan2,'')."</td>-->
<td align=right>".number_format($msx->totqty,0,'.',',')."</td>
<td align=right>".number_format($msx->jumlah,0,'.',',')."</td>
<td>$msx->no_retur</td>
<td align=right>".number_format($msx->totqty_retur,0,'.',',')."</td>
<td align=right>".number_format($msx->jumlah_retur,0,'.',',')."</td>
<td align=right>".number_format($msx->diskon_rp,0,'.',',')."</td>
<td align=right>".number_format($msx->jumlah_dpp,0,'.',',')."</td>
<td align=right>".number_format($msx->jumlah_ppn,0,'.',',')."</td>
<td align=right>".number_format($msx->jumlah_dpp-$msx->jumlah_ppn,0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotaljumlah=$mtotaljumlah+$msx->jumlah;
$mtotaljmlretur=$mtotaljmlretur+$msx->jumlah_retur;
$mtotaljmldisk=$mtotaljmldisk+$msx->diskon_rp;
$totaldpp=$totaldpp+$msx->jumlah_dpp;
$totalppn=$totalppn+$msx->jumlah_ppn;
$totalnett=$totalnett+($msx->jumlah_dpp-$msx->jumlah_ppn);
}

echo "
<tr valign=>
<td colspan=15 align=right><b>TOTAL&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotaljumlah,0,'.',',')."</td><td></td><td></td>
<td align=right><b>".number_format($mtotaljmlretur,0,'.',',')."</td>
<td align=right><b>".number_format($mtotaljmldisk,0,'.',',')."</td>
<td align=right><b>".number_format($totaldpp,0,'.',',')."</td>
<td align=right><b>".number_format($totalppn,0,'.',',')."</td>
<td align=right><b>".number_format($totalnett,0,'.',',')."</td>
</tr>
";

}

if ($mLapo=='efaktur')
{
	echo(" 
	UD. ANGEL
	<br>
	Laporan e-Faktur
	<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
	<br><br>
	");
	
	$sqlstr="
	select a.nid, date_format(a.tgl, '%d-%m-%Y') tanggal_faktur, lgnnama as nama, npwp, alamat, b.stoid, d.stonama, b.jmlhrg as dpp, b.jmlhrg*0.1 as ppn,(b.hrgsat/b.isi) as hrgsat,(b.qty*b.isi)+b.unit as qty, ((b.hrgsat/b.isi)*(b.qty*b.isi)) + ((b.hrgsat/b.isi)*b.unit) as subtotal, (((b.hrgsat/b.isi)*(b.qty*b.isi)) + ((b.hrgsat/b.isi)*b.unit))-b.jmlhrg as diskon
	from transjual1 a
	left join transjual2 b on a.nid=b.nid
	left join setlgn c on a.lgnid=c.lgnid
	left join setstok d on b.stoid=d.stoid
	WHERE a.tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y') AND STR_TO_DATE('$mtg2', '%d-%c-%Y') and a.lgnid like '!!$mlgnid!!'  and a.sales like '!!$msalesid!!' and d.grpid like '!!$mgrpid!!'
	order by a.nid
	";
	
	$maa=executerow($sqlstr);
	$mjumlah=mysql_num_rows($maa);
	if($mjumlah==0)
	{
		return;
	}
	echo "
<table width='1300px' cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
	<tr bgcolor='lightgrey'>
		<th width='20px'>No. Faktur</th>
		<th width='20px'>Tgl Faktur</th>
		<th width='20px'>Nama</th>
		<th width='20px'>Kode Brg</th>
		<th width='20px'>Nama Brg</th>
		<th width='20px'>Hrg Satuan</th>
		<th width='20px'>Jml Barg</th>
		<th width='20px'>Sub Total</th>
		<th width='20px'>DISKON</th>
		<th width='20px'>DPP</th>
		<th width='7px'>PPN</th>
	</tr>
	";
	$nn=1;
	$totot=0;
	$tottunai=0;
	$tothutang=0;
	while ($mrr=mysql_fetch_object($maa))
	{
		echo "
	<tr>
		<td align=right>$mrr->nid </td>
		<td>&nbsp;$mrr->tanggal_faktur</td>
		<td>&nbsp;$mrr->nama</td>
		<td>&nbsp;$mrr->stoid</td>
		<td>&nbsp;$mrr->stonama</td>
		<td align=right width='85px'>".number_format($mrr->hrgsat,0,'.',',')."</td>
		<td align=right width='85px'>".number_format($mrr->qty,0,'.',',')."</td>
		<td align=right width='85px'>".number_format($mrr->subtotal,0,'.',',')."</td>
		<td align=right width='85px'>".number_format($mrr->diskon,0,'.',',')."</td>
		<td align=right width='85px'>".number_format($mrr->dpp,0,'.',',')."</td>
		<td align=right width='85px'>".number_format($mrr->ppn,0,'.',',')."</td>
	</tr>
		";
	}
	echo "
</table>
<br><br>
	";
}

if ($mLapo=='efakturexcel')
{
	echo(" 
	UD. ANGEL
	<br>
	Laporan e-Faktur
	<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
	<br><br>
	");
	
	$sqlstr = " select 1 as kd_jns_trx,0 as fg_pengganti ,a.nid,
	case when a.nomorfp='undefined' then '' else a.nomorfp end as nomorfp,
	month(tgl) masa_pajak,
	year(tgl) th_pjak,tgl tanggal_faktur,npwp,lgnnama as nama,
	alamat,b.jumlah_dpp,b.jumlah_ppn,0 as jumlah_ppnbm,'' as id_ket_tambahan,0 as fg_uangmuka,
	0 as uang_mukadpp,0 as uang_mukappn,0 as uang_mukappnbm,a.nid as referensi 
	from transjual1 a left join 
	(select x.nid,
	sum(y.jmlhrg) as jumlah_dpp,sum(y.jmlhrg*0.1) as jumlah_ppn 
	from transjual1 x, transjual2 y where x.nid=y.nid AND 
	x.tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y') 
	AND STR_TO_DATE('$mtg2', '%d-%c-%Y') and x.lgnid like '!!$mlgnid!!'  and x.sales like '!!$msalesid!!' 
	group by x.nid) b on a.nid=b.nid 
	left join setlgn c on a.lgnid=c.lgnid 
	WHERE a.tgl BETWEEN STR_TO_DATE('$mtg1', '%d-%c-%Y') 
	AND STR_TO_DATE('$mtg2', '%d-%c-%Y') and a.lgnid like '!!$mlgnid!!'  and a.sales like '!!$msalesid!!' 
	order by a.nid ";
	
	$maa=executerow($sqlstr);
	$mjumlah=mysql_num_rows($maa);
	if($mjumlah==0)
	{return;}
	
	echo "
	<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
	<tr bgcolor='lightgrey'>
	<th>FK</th><th>KD_JENIS_TRANSAKSI</th><th>FG_PENGGANTI</th><th>NOMOR_FAKTUR</th><th>MASA_PAJAK</th>
	<th>TAHUN_PAJAK</th><th>TANGGAL_FAKTUR</th><th>NPWP</th><th>NAMA</th><th>ALAMAT_LENGKAP</th>
	<th>JUMLAH_DPP</th><th>JUMLAH_PPN</th><th>JUMLAH_PPNBM</th><th>ID_KETERANGAN_TAMBAHAN</th>
	<th>FG_UANG_MUKA</th><th>UANG_MUKA_DPP</th><th>UANG_MUKA_PPN</th><th>UANG_MUKA_PPNBM</th>
	<th>REFERENSI</th>
	</tr>
	<tr>
	<th>LT</th><th>NPWP</th><th>NAMA</th><th>JALAN</th><th>BLOK</th><th>NOMOR</th><th>RT</th><th>RW</th>
	<th>KECAMATAN</th><th>KELURAHAN</th><th>KABUPATEN</th><th>PROPINSI</th><th>PROPINSI</th>
	<th>KODE_POS</th><th>NOMOR_TELEPON</th>
	</tr>
	<tr>
	<th>OF</th><th>KODE_OBJEK</th><th>NAMA</th><th>HARGA_SATUAN</th><th>JUMLAH_BARANG</th>
	<th>HARGA_TOTAL</th><th>DISKON</th><th>DPP</th><th>PPN</th><th>TARIF_PPNBM</th><th>PPNBM</th>
	</tr>
	";
	
	$nn=1;
	$totot=0;
	$tottunai=0;
	$tothutang=0;
	
	while ($mrr=mysql_fetch_object($maa))
	{
		echo "
		<tr>
		<td align=center>FK</td>
		<td>$mrr->kd_jns_trx</td>
		<td>$mrr->fg_pengganti</td>
		<td>$mrr->nomorfp </td>
		<td>$mrr->masa_pajak</td>
		<td>$mrr->th_pjak</td>
		<td>$mrr->tanggal_faktur</td>
		<td>$mrr->npwp</td>
		<td>$mrr->nama</td>
		<td>$mrr->alamat</td>
		<td align=right>$mrr->jumlah_dpp</td>
		<td align=right>$mrr->jumlah_ppn</td>
		<td align=right>$mrr->jumlah_ppnbm</td>
		<td>&nbsp;$mrr->id_ket_tambahan</td>
		<td align=right>$mrr->fg_uangmuka</td>
		<td align=right>$mrr->uang_mukadpp</td>
		<td align=right>$mrr->uang_mukappn</td>
		<td align=right>$mrr->uang_mukappnbm</td>
		<td>&nbsp;$mrr->referensi</td>
		</tr> ";

	$sqlstrdetil = " select a.stoid,stonama,hrgsat,(qty*a.isi)+a.unit as qty,
	diskonrp,((hrgsat/a.isi)*(qty*a.isi)) + ((hrgsat/a.isi)*a.unit) as subtotal,
	(((hrgsat/a.isi)*(qty*a.isi)) + ((hrgsat/a.isi)*a.unit))-a.jmlhrg as diskon, a.jmlhrg as dpp,
	a.jmlhrg*0.1 as ppn,0 as TARIF_PPNBM, 0 as PPNBM
	from transjual2 a, setstok b where nid='$mrr->nid' and a.stoid=b.stoid";
	$mss=executerow($sqlstrdetil);
	$mnomor=1;
	$mtotqty=0;
	while ($msx=mysql_fetch_object($mss))
	{
	
	echo "
	<tr>
	<td align=center>OF</td>
	<td align=center>$msx->stoid</td>
	<td align=center>$msx->stonama</td>
	<td align=right>".number_format($msx->hrgsat, 2, '.', '')."</td>
	<td align=right>$msx->qty</td>
	<td align=right>".number_format($msx->subtotal, 2, '.', '')."</td>
	<td align=right>".number_format($msx->diskon, 2, '.', '')."</td>
	<td align=right>".number_format($msx->dpp, 2, '.', '')."</td>
	<td align=right>".number_format($msx->ppn, 2, '.', '')."</td>
	<td align=right>".number_format($msx->TARIF_PPNBM, 2, '.', '')."</td>
	<td align=right>".number_format($msx->PPNBM, 2, '.', '')."</td>
	</tr>
	";
	$mnomor++;
	$mtotqty=$mtotqty+$msx->qty;
	}
	
	// echo "
	// <tr valign=top>
	// <td colspan=3 align=right><b>TOTAL&nbsp<br>&nbsp</td>
	// <td align=right><b>".number_format($mtotqty,0,'.',',')."</td>
	// <td colspan=2>&nbsp;</td>
	// <td align=right><b>".number_format($mrr->total,0,'.',',')."</td>
	// <td align=right><b>".number_format($mrr->total,0,'.',',')."</td>
	// <td align=right><b>".number_format($mrr->tunai,0,'.',',')."</td>
	// <td align=right><b>".number_format($mrr->jumlah,0,'.',',')."</td>
	// <td align=right><b>".date( 'd-m-Y', strtotime( $mrr->tgljt ))."</td>
	// </tr>
	// ";
	// $totot=$totot+$mrr->total;
	// $tottunai=$tottunai+$mrr->tunai;
	// $tothutang=$tothutang+$mrr->jumlah;
	// $nn++;
	}
	// echo "
	// <tr valign=top>
	// <td colspan=7 align=right><b>GRAND TOTAL&nbsp<br>&nbsp</td>
	// <td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($totot,0,'.',',')."</td>
	// <td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($tottunai,0,'.',',')."</td>
	// <td align=right><b>&nbsp;&nbsp;&nbsp;".number_format($tothutang,0,'.',',')."</td>
	// <td align=right></td>
	// </tr>
	echo "
	</table>
	<br><br>
	";
}


if ($mLapo=='mlapjualnota2')
{

$sqlstr="select a.tgl ,a.ppnkeluaran ,a.nid, x.jumlah,a.jumlah as jumlahdaria,a.lgnid ,a.supid ,a.soid,a.sales ,a.mobil ,
a. tunaikredit ,a.onreport ,a.ket ,a.pdiskon  ,y.diskon,a.tunai ,a.total ,a.report,
a. komp,a.user,a.status,a.tgljt ,a.terkirim ,a.ongkos,
case
    when a.nomorfp = 'undefined' then ''
    else  a.nomorfp
end as  nomorfp
,b.lgnnama,date_format(tgl,'%d-%m-%Y') tglc,date_format(tgljt,'%d-%m-%Y') tgljtc,date_format(tgljt,'') tgljth,c.retur,d.lunas,f.gaji
from transjual1 a 
left join (select nid,sum((hrgsat/isi)*totqty) as jumlah from transjual2 group by nid) x on a.nid=x.nid
left join (select nid,sum((hrgsat/isi)*(diskonrp/100)*totqty) as diskon from transjual2 group by nid) y  on a.nid=y.nid
left join setlgn b on a.lgnid=b.lgnid
left join (select nid2,sum(kredit) retur from bkbesar where rekid='10210' and trans='TRANSRETURJUAL' group by nid2) c on a.nid=c.nid2
left join (select nid2,sum(kredit) lunas from bkbesar where rekid='10210' and trans='TRANSLUNASPIUTANG' group by nid2) d on a.nid=d.nid2
left join setkaryawan f on a.sales=f.karid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and a.lgnid like '!!$mlgnid!!' and a.sales like '!!$mkarid!!'
order by a.nid,a.tgl
";

//$saa=execute2("select * from setkaryawan where karid='$mkarid'");

echo("
UD. ANGEL
<br>
Laporan Penjualan Periodik
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
<th>Kode Cust</th>
<th>Nama Pelanggan</th>
<th>Nota</th>
<th>Tgl Nota</th>
<th>Jt Tempo</th>
<th>Jumlah</th>
<th>Diskon</th>
<th>Tunai</th>
<th>Sisa</th>
<th>Retur</th>
<th>Lunas</th>
<th>Piutang</th>
<th>Nomor FP</th>
<th>PPN</th>
</tr>

";

$nn=1;

$totot=0;
$tottunai=0;
$totpiutang=0;
$totdiskon=0;
$sisa=0;
$totsisa=0;
$piutang=0;
while ($mrr=mysql_fetch_object($maa))
{

$mjppn=0;
//if (!empty($mrr->nomorfp))
if ($mrr->nomorfp!='')
{
$mpp=execute("select sum(a.jmlhrg) jmlhrg from transjual2 a left join setstok b on a.stoid=b.stoid where a.nid='$mrr->nid' and b.isppn='PPN' ");
$mjppn=$mpp[jmlhrg]-(($mpp[jmlhrg]/110)*100);
}
$sisa=$mrr->jumlah-$mrr->diskon-$mrr->tunai;
$piutang=$sisa-$mrr->retur-$mrr->lunas;
echo "
<tr valign= height=25 class='thetr' onmousemove=highl(this) >
<td>$nn</td>
<td>$mrr->lgnid</td>
<td>$mrr->lgnnama</td> 
<td><a href onclick=buka('$mrr->nid') >$mrr->nid </a> </td> 
<td>$mrr->tglc $mrr->tgljth</td> 
<td>$mrr->tgljtc</td> 
<td align=right>".number_format($mrr->jumlah,0,'.',',')."</td> 
<td align=right>".number_format($mrr->diskon,0,'.',',')."</td> 
<td align=right>".number_format($mrr->tunai,0,'.',',')."</td> 
<!--<td align=right>".number_format($mrr->total,0,'.',',')."</td> -->
<td align=right>".number_format($sisa,0,'.',',')."</td> 
<td align=right>".number_format($mrr->retur,0,'.',',')."</td> 
<td align=right>".number_format($mrr->lunas,0,'.',',')."</td> 
<!--<td align=right>".number_format($mrr->total-$mrr->retur-$mrr->lunas,0,'.',',')."</td>-->
<td align=right>".number_format($piutang,0,'.',',')."</td>  
<!--echo(($a==10)?'Yes its true':'Its false');
is_null($a)-->
<!--<td align=center> <?php echo (($mrr->nomorfp!='undefined')?$mrr->nomorfp:'') ?> </td>-->

<td align=center>$mrr->nomorfp</td>
<td align=right>".number_format($mjppn,0,'.',',')."</td> 
</td>
</tr>
";

$totot=$totot+$mrr->jumlah;
$totdiskon=$totdiskon+$mrr->diskon;
$tottunai=$tottunai+$mrr->tunai;
$totsisa=$totsisa+($mrr->jumlah-$mrr->diskon-$mrr->tunai);

$totretur=$totretur+$mrr->retur;
$totlunas=$totlunas+$mrr->lunas;
$totpiutang=$totpiutang+($mrr->jumlah-$mrr->diskon-$mrr->tunai-$mrr->retur-$mrr->lunas);
$totkomisi=$totkomisi+($mrr->total*$mrr->gaji*0.01);
$mtp=$mtp+$mjppn;
$nn++;
}


echo "
<tr valign=bottom>
<td colspan=6>&nbsp;<br></td>
<td align=right><b>".number_format($totot,0,'.',',')."</td> 
<td align=right><b>".number_format($totdiskon,0,'.',',')."</td> 
<td align=right><b>".number_format($tottunai,0,'.',',')."</td> 

<td align=right><b>".number_format($totsisa,0,'.',',')."</td> 
<td align=right><b>".number_format($totretur,0,'.',',')."</td> 
<td align=right><b>".number_format($totlunas,0,'.',',')."</td> 
<td align=right><b>".number_format($totpiutang,0,'.',',')."</td> 
<td align=right> </td> 
<td align=right><b>".number_format($mtp,0,'.',',')."</td> 
</td>
</tr>


<tr valign=bottom>
<td colspan=6 align =right>Komisi&nbsp;</td>
<td align=right><b>".number_format($totkomisi,0,'.',',')."</td> 
<td></td>
</tr>

</table>
";
}

if ($mLapo=='mlapmutasi')
{

$sqlstr="select  a.*,b.stonama,b.satuan1,b.satuan2,c.loknama asal,d.loknama tujuan
from transmutasigudang a 
left join setstok b on a.stoid=b.stoid
left join setlok c on a.lokid1=c.lokid
left join setlok d on a.lokid2=d.lokid
where tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
 order by a.nid,a.tgl
";

echo(" 
ESBAS TOYS & HANDY CRAFT
<br>
Laporan Mutasi Gudang
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

echo $awal+$tujuan; 
while ($mrr=mysql_fetch_object($maa))
{
	if($awal!='default' && $tujuan!='default'){
		if($awal == $mrr->asal && $tujuan == $mrr->tujuan){
			echo "

			<tr valign=top>
			<td> $nn </td>
			<td> $mrr->nid  </td>
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

	}elseif($awal!='default' || $tujuan!='default'){
		if($awal == $mrr->asal || $tujuan == $mrr->tujuan){
			echo "

			<tr valign=top>
			<td> $nn </td>
			<td> $mrr->nid  </td>
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

	}else{
		echo "

			<tr valign=top>
			<td> $nn </td>
			<td> $mrr->nid  </td>
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



}

echo "
</table>
<br><br>
";

}

?>
<?php
echo '
</body>
';
?>
</html>
