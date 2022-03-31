<html>
<head>

<script type="text/javascript">
function loadform()
{
//window.print();
//window.close();
//parent.focus();
}
</script>
<title>
</title>
</head>

<?php
require("utama.php");

echo("
<body bgcolor=#FFFFFF onload='loadform()' style='font-family:tahoma'>
<form name='fprint' >
<Font size=3>
");


$link=open_connection();
$therow=21;

$rown=execute("
select * from setkaryawan where karid = '$msalesid'
");
$msales=$rown[karid].' - '.$rown[karnama];

$rowx=execute("
select count(*) cnt from  transjual1 where nid in $mrekap 
");

$juml1=round($rowx[cnt]/$therow,0);
$mtglw=$rowx[tgl];
$mmobil=$rowx[mobil];

$mhalall=$juml1;
if (($rowx[cnt]/$therow)-$juml1>0)
{
$mhalall=$juml1+1;
}

$juml=round($rowx[cnt],0);
$mlim=0;
$mnom=1;
$mput=1;

while ($juml>0)

{

/*
$sqlstr="select a.*,b.supnama,b.alamat,b.alamat2,b.alamat3,datediff(tgljt,tglsj) top from transbeli1 a left join setsup b on a.supid=b.supid where a.nid='$mnid' ";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL KASIR1!");
$row = mysql_fetch_assoc($result);

$mtgl=$row[tgl];
$mtgltampil=substr($mtgl,8,2).'-'.substr($mtgl,5,2).'-'.substr($mtgl,0,4);
$mtgljt=$row[tgljt];
$mtgljt=substr($mtgljt,8,2).'-'.substr($mtgljt,5,2).'-'.substr($mtgljt,0,4);

$mtglsj=$row[tglsj];
$mtglsj=substr($mtglsj,8,2).'-'.substr($mtglsj,5,2).'-'.substr($mtglsj,0,4);

$mnid=$row[nid];
$msjid=$row[sjid];

$mtotal=number_format($row[jumlah],0,',','.');
$mjumlah=number_format($row[total],0,',','.');
$mpelanggan=$row[supid].' - '.$row[supnama];
$msupnama=$row[supnama];
$malamat=$row[alamat];
$malamat2=$row[alamat2];
$malamat3=$row[alamat3];
$mtop='('.$row[top].' hari)';
*/

echo("
<table width=97%  border=0 cellpadding=0 cellspacing=1 id=Table1 >

<tr>
<td width=33%><b>TOKO LAKSMANA JAYA</td>
<td width=33% align=center><b>DAFTAR FAKTUR TAGIHAN</td>
<td width=33% align=right><font size=2>Hal $mput dari $mhalall</td>
</tr>

</table>
<hr  width='97%' align=left>

<table width=100%  border=0 cellpadding=0 cellspacing=1 id=Table2 >
<tr>
<td width=5%><b>Sales</td>
<td><b>: $msales</td>
</tr>
<tr>
<td width=5%><b>Tgl</td>
<td><b>: ".date('d-m-Y')."</td>
</tr>
</table>
<br>
");

$sqlstr="select a.nid,date_format(a.tgl,'%d-%m-%Y') tgl,date_format(a.tgljt,'%d-%m-%Y') tgljt,concat(a.sales,' - ',b.karnama) sales,c.lgnnama  pelanggan,
a.jumlah,ifnull(d.kredit,000000000000) terbayar,a.jumlah-ifnull(d.kredit,000000000000) sisa
from transjual1 a left join setkaryawan b on a.sales=b.karid left join setlgn c on a.lgnid=c.lgnid
left join (select nid2,bpid,sum(kredit) kredit from bkbesar where rekid='10210' group by nid2,bpid) d on a.nid=d.nid2 and a.lgnid=d.bpid
where a.nid in $mrekap and a.jumlah-ifnull(d.kredit,000000000000)>0
order by a.nid limit $mlim,$therow
";

$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL! $sqlstr");

echo("
<table border='0' width='97%' cellspacing='0' cellpadding='0' style='border-collapse:collapse'>
<tr>
<td colspan=9><hr></td>
</tr>
<tr>
<td bgcolor=#FFFFFF align=center width=5% ><b>No.</b></td>
<td bgcolor=#FFFFFF width=20% align=center ><b>Nama Outlet</b></td>
<td bgcolor=#FFFFFF align=center align=center width=10% ><b>No.<br>Faktur</b></td>
<td bgcolor=#FFFFFF align=center align=center width=10% ><b>Tgl.<br>Faktur</b></td>
<td bgcolor=#FFFFFF align=center align=center width=10% ><b>Tgl.<br>JT</b></td>
<td bgcolor=#FFFFFF align=center width=10% ><b>Jumlah</b></td>
<td bgcolor=#FFFFFF align=center width=10% ><b>Bayar</b></td>
<td bgcolor=#FFFFFF align=center width=12% ><b>Ket.</b></td>
</tr>
<tr>
<td colspan=9><hr></td>
</tr>
");

$mnom11=1;
$mjjm=0;
$mjjm2=0;

while ($row = mysql_fetch_assoc ($result))
{

echo("<tr height=25>
<td bgcolor=#FFFFFF align=right width=5% >$mnom.&nbsp;&nbsp;</td>
<td bgcolor=#FFFFFF width=20% >&nbsp;$row[pelanggan]</td>
<td bgcolor=#FFFFFF width=10% align=center>$row[nid]</td>
<td bgcolor=#FFFFFF width=10% align=center>$row[tgl]</td>
<td bgcolor=#FFFFFF width=10% align=center>$row[tgljt]</td>
<td bgcolor=#FFFFFF width=10% align=right >".number_format($row[sisa],0,'.',',')."</td>
<td bgcolor=#FFFFFF width=10% >&nbsp<input></td>
<td bgcolor=#FFFFFF width=12% >&nbsp</td>

</tr>");
$mnom=$mnom+1;
$mjjm=$mjjm+$row[jumlah];
$mjjm2=$mjjm+$row[sisa];
$mnom11++;
}




echo("
<tr>
<td colspan=9><hr></td>
</tr>

<tr>
<td colspan=5 align=right><b>TOTAL </td>
<td align=right><b>".number_format($mjjm,0,'.',',')."</td>
<td align=right><input></td>
</tr>

<tr>
<td colspan=5 align=right><b>UANG MAKAN </td>
<td align=right></td>
<td align=right><input></td>
</tr>

<tr>
<td colspan=5 align=right><b>UANG TRANSPORT </td>
<td align=right></td>
<td align=right><input></td>
</tr>

<tr>
<td colspan=5 align=right><b>LAIN-LAIN </td>
<td align=right></td>
<td align=right><input></td>
</tr>

<tr>
<td colspan=5 align=right><b>TOTAL SETOR </td>
<td align=right></td>
<td align=right><input></td>
</tr>

<tr>
<td colspan=9><br><hr></td>
</tr>

</table>
");

for ($count=$mnom11;$count<=$therow;$count ++)
{
//echo("<br>");
}
$mjjm=number_format($mjjm,'0','.',',');
echo("

<table width=50%>
<tr>

<td align=center>
Diserahkan,
<br><br><br><br>
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
</td>

<td align=center>
Diterima,
<br><br><br><br>
(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
</td>

<tr>
<table>
<hr  width='97%' align=left>
</form> 
<br>
<br>
");

$mlim=$mlim+$therow;
$juml=$juml-$therow;
$mput++;

}


mysql_close($link);

?>

</body>
</html>


