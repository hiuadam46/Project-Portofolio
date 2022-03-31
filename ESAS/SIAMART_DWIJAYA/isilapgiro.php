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
$sqlstr="select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,a.nid2,date_format(a.tgl2,'%d-%m-%Y') tgl2,a.bpid,a.debet jumlah,b.lgnnama  atasnama
from bkbesar a left join setlgn b on a.bpid=b.lgnid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and rekid='$mrekid' and debet<>0 order by tgl
";
}
else
{
$sqlstr="select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,a.nid2,date_format(a.tgl2,'%d-%m-%Y') tgl2,a.bpid,a.kredit jumlah,b.supnama atasnama
from bkbesar a left join setsup b on a.bpid=b.supid
where a.tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y')
and rekid='$mrekid' and kredit<>0 order by tgl
";
}

echo(" 
DWI JAYA SENTOSA
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

$wrr=execute("select sum(jmlhrg) jmlhrg from transjual2 where stoid='$msx[stoid]' and ( tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') ) and nid in (select nid from transjual1 where lgnid like '!!$mlgnid!!') ");
$wret=execute("select a.bpid stoid,sum(a.qtyout-a.qtyin) qty,sum(a.debet-a.kredit) hpp from bkbesar a where bpid='$msx[stoid]' and ( tgl between str_to_date('$mtg1','%d-%c-%Y') and str_to_date('$mtg2','%d-%c-%Y') ) and trans='TRANSRETURJUAL'");

echo "
<tr>
<td align=right>$mnomor.</td>
<td>$msx[tgl]</td>
<td>$msx[nid]</td>
<td>$msx[tgl2]</td>
<td>$msx[nid2]</td>
<td>$msx[atasnama]</td>
<td align=right>".number_format($msx[jumlah],0,'.',',')."</td>
</tr>
";

$mnomor++;
$mtotal=$mtotal+$msx[jumlah];

}

echo "

<tr valign=>
<td colspan=6 align=right><b>TOTAL&nbsp&nbsp</td>
<td align=right><b>".number_format($mtotal,0,'.',',')."</td>
</tr>

";

?>


</Font>
</body>
</html>