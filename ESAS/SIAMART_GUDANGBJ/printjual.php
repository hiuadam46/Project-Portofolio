<html>
<head>

<script type="text/javascript">
function loadform()
{
window.print();
window.close();
parent.focus();
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

$rowx=execute("select count(*) cnt from transjual2 where nid='$mnid'");

$juml1=round($rowx->cnt/10,0);
$mhalall=$juml1;
if (($rowx->cnt/10)-$juml1>0)
{
$mhalall=$juml1+1;
}

$juml=round($rowx->cnt,0);
$mlim=0;
$mnom=1;
$mput=1;
$juml=1;

while ($juml>0)

{


$sqlstr="select a.*,b.lgnnama  from transjual1 a left join setlgn b on a.lgnid=b.lgnid where a.nid='$mnid' ";

$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL KASIR1!");
$row = mysql_fetch_object($result);

$mtgl=$row->tgl;
$mtgltampil=substr($mtgl,8,2).'-'.substr($mtgl,5,2).'-'.substr($mtgl,0,4);
$mtgljt=$row->tgljt;
$mtgljt=substr($mtgljt,8,2).'-'.substr($mtgljt,5,2).'-'.substr($mtgljt,0,4);

$mtglsj=$row->tglsj;
$mtglsj=substr($mtglsj,8,2).'-'.substr($mtglsj,5,2).'-'.substr($mtglsj,0,4);

$mnid=$row->nid;
$msjid=$row->sjid;

$mtotal=number_format($row->jumlah,0,',','.');
$mjumlah=number_format($row->total,0,',','.');
$mpelanggan=$row->supid.' - '.$row->lgnnama;
$mlgnnama=$row->lgnnama;
$malamat=$row->alamat;
$malamat2=$row->alamat2;
$malamat3=$row->alamat3;
$mtop='('.$row->top.' hari)';

echo("
<table width=50%  border=0 cellpadding=0 cellspacing=1 id=Table1 >

<tr>
<td width=43%><b>Wijaya</td>
<td width=7% colspan=2><b>Barang Keluar</td>
<td width=33%>&nbsp;</td>
</tr>

<tr>
<td width=3%>Blitar</td>
<td width=50% colspan=2>Ke : $mlgnnama</td>
</tr>

<tr>
<td> </td>
<td width=7%>&nbsp;</td>
<td width=33%>$malamat</td>
</tr>

<tr>
<td> </td>
<td width=7%>&nbsp;</td>
<td width=33%>$malamat2</td>
</tr>

<tr>
<td></td>
<td width=7%>&nbsp;</td>
<td width=33%>$malamat3</td>
</tr>

</table>
<hr  width='50%' align=left>

<table width=50%  border=0 cellpadding=0 cellspacing=1 id=Table2 >

<tr>
<td><b>No.</td>
<td><b>: $mnid</td>
</tr>

<tr>
<td align=left valign=bottom width=15% height=25><b>Tgl.</b></td>
<td align=left valign=bottom width=20% height=25><b>: $mtgltampil</b></td>
</tr>
</table>
");


$sqlstr="select a.*,left(b.stonama,30) stonama,b.satuan1,b.satuan2 from transjual2 a left join setstok b on a.stoid=b.stoid where a.nid='$mnid' and a.stoid<>''  order by nomor limit 0,100" ;

$resultx = executerow ($sqlstr) ;

echo("<hr  width='50%' align=left>
<table border='0' width='50%' cellspacing='0' cellpadding='0'>
<tr>
<td bgcolor=#FFFFFF width=30% align=center ><b>Nama Barang</b><hr></td>
<td bgcolor=#FFFFFF width=5% align=center ><b>Qty</b><hr></td>
</tr>");

$mnom11=1;

while ($row = mysql_fetch_object ($resultx))
{

$mstoid=$row->stoid;
$mstonama=$row->stonama;

$mqty=number_format($row->qty,0,',','.').' '.$row->satuan1.' '.number_format($row->unit,0,',','.').' '.$row->satuan2;


$munit=number_format($row->unit,0,',','.');
$mbonus=number_format($row->extra,0,',','.');
$mhrgsat=number_format($row->hrgsat,0,',','.');
$mjmlhrg=number_format($row->jmlhrg,0,',','.');

$mdr1=number_format($row->diskonp,2,',','.');
$mdr2=number_format($row->diskonp2,2,',','.');
$mdr22=number_format($row->diskonp3,2,',','.');
$mdr3=number_format($row->diskonrp,0,',','.');

$mdr4=number_format($row->diskonp3,0,',','.');
$mdr5=number_format($row->diskonp4,0,',','.');
$mdr6=number_format($row->diskonrp2,0,',','.');

echo("<tr height=25>
<td bgcolor=#FFFFFF >&nbsp;&nbsp;$mstonama</td>
<td bgcolor=#FFFFFF align=right width=25%>$mqty&nbsp;&nbsp;</td>

</tr>");
$mnom=$mnom+1;
$mjjm=$row->jmlhrg;
$mnnid=$mstoid;
$mnom11++;

}


for ($count=$mnom11;$count<=10;$count ++)
{
//echo("<tr><td>&nbsp;</td></tr>");
}

echo("
</table>
<hr  width='50%' align=left>
");

$mtott="Total :<hr></td> <td align=right><b>$mjumlah<hr>";

//echo("
//<hr  width='50%' align=left>
//<div align=right>TOTAL : $mjumlah</div>
//<hr  width='50%' align=left>
//&nbsp;
//");

//if ($mput==$mhalall) 
//{
//$mtott="Total :<hr></td> <td align=right><b>$mjumlah<hr>";
//}
//else
//{
//$mtott="";
//}

echo("
</form> <br>
");

$mlim=$mlim+10;
$juml=$juml-10;
$mput++;

}

mysql_close($link);

?>

</body>
</html>


