<?php
if($excel)
{
	@header('Content-Type: application/ms-excel');
	@header('Content-disposition: inline; filename="'.$mLapo.' '.date('d-m-Y').'.xls"');
}
?>
<html>
<head>
<title>
Laporan Giro
</title>
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
<Font face=Arial  style='font-size:85%'>
<body bgcolor=#FFFFFF name=wjual>
<br>
");
}


if ($mrekid=='10220')
{
	$sqlstr="select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,a.nid2,date_format(a.tgl2,'%d-%m-%Y') tgl2x,a.bpid,a.debet jumlah,b.lgnnama  atasnama
	from bkbesar a left join setlgn b on a.bpid=b.lgnid
	where a.tgl2 between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
	and rekid='$mrekid' and debet<>0 and bpid2 like '%$mbankid%' order by tgl2
	";
}
else
{
	$sqlstr="select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,a.nid2,date_format(a.tgl2,'%d-%m-%Y') tgl2x,a.bpid,a.kredit jumlah,b.supnama atasnama
	from bkbesar a left join setsup b on a.bpid=b.supid
	where a.tgl2 between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
	and rekid='$mrekid' and kredit<>0 and bpid2 like '%$mbankid%' order by tgl2
	";
}

echo(" 
CV. WPS
<br>
Laporan Giro
<br>Tgl.  $mtg1 s.d. $mtg2 $mtgt
");

$maa=executerow($sqlstr);

$mjumlah=mysql_num_rows($maa);

if($mjumlah==0)
{return;}

echo "
<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'> 
<tr bgcolor='lightgrey'>

<th>No.</th>
<th>Tgl. Dibuat</th>
<th>Nomor</th>
<th>Tgl Jatuh Tempo</th>
<th>Nomor Giro</th>
<th>Atas Nama</th>
<th>Jumlah</th>
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

//$wrr=execute("select sum(jmlhrg) jmlhrg from transjual2 where stoid='$msx[stoid]' and ( tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') ) and nid in (select nid from transjual1 where lgnid like '!!$mlgnid!!') ");
//$wret=execute("select a.bpid stoid,sum(a.qtyout-a.qtyin) qty,sum(a.debet-a.kredit) hpp from bkbesar a where bpid='$msx[stoid]' and ( tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') ) and trans='TRANSRETURJUAL'");

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx[tgl]</td>
<td>$msx[nid]</td>
<td>$msx[tgl2x]</td>
<td>$msx[nid2]</td>
<td>$msx[atasnama]</td>
<td align=right>".number_format($msx[jumlah],0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotal=$mtotal+$msx[jumlah];

}

if($mbankid =='')
{
	$toba=execute("select sum(debet-kredit) saldo,rekid from bkbesar 
	where rekid in (select rekid from setrek where rekid like '101%' )  
	and tgl <= str_to_date('$mtg2','%d-%c-%Y') order by rekid limit 0,1");
}
else
{
	$toba=execute("select sum(debet-kredit) saldo,rekid from bkbesar 
	where rekid in (select rekid from setrek where rekid like '%$mbankid%' )  
	and tgl <= str_to_date('$mtg2','%d-%c-%Y') order by rekid limit 0,1");
}
//echo("select sum(debet-kredit) saldo from bkbesar where rekid='10110' and tgl < str_to_date('$mtg2','%d-%c-%Y')");

echo "
<tr valign=>
<td colspan=6 align=right><b>TOTAL&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal,0,'.',',')."</td>
</tr>

<tr valign=>
<td colspan=6 align=right><b>SALDO BANK&nbsp&nbsp</td>
<td align=right><b>".number_format($toba[saldo],0,'.',',')."</td>
</tr>
";
?>

</Font>
</body>
</html>