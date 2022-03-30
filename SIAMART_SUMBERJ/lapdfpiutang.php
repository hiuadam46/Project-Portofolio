<html>
<head>
<title>
Laporan Daftar Piutang
</title>
</head>
<body bgcolor="#FFFFFF" name="wjual" onload="document.fjual1.mnid.focus()">
<Font size=3 face="Arial ">
<?php
require("menu.php");

$link=open_connection();
$sqlstr="
select a.bpid,b.lgnnama,sum(a.debet-a.kredit) saldo from 
bkbesar a left join setlgn b on a.bpid=b.lgnid 
where a.rekid='10210'
group by a.bpid,b.lgnnama order by a.bpid
";
$result = mysql_query ($sqlstr) or die ("Kesalahan pada perintah SQL JUAL1!");
mysql_close($link);
echo("
<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;Laporan Daftar Piutang<br><br>
<table  width=100% cellspacing=1 cellpadding=0 bgcolor=#CCCCCC> 
<tr>
<td bgcolor=#CCCCCC align=center ><b>Kode</b></td>
<td bgcolor=#CCCCCC align=center ><b>Nama</b></td>
<td bgcolor=#CCCCCC align=center ><b>Saldo</b></td>
</tr>
");
$mnom=1;
$mtotdebet=0;
$mkredit=0;
while ($row = mysql_fetch_assoc ($result))
{
$mrekid=$row[bpid];
$mreknama=$row[lgnnama];
$mdebet=number_format($row[saldo],0,',','.');
echo("
<tr>
<td bgcolor=#FFFFFF align=left>$mrekid</td>
<td bgcolor=#FFFFFF align=left>$mreknama</td>
<td bgcolor=#FFFFFF align=right>$mdebet</td>
</tr>
");

$mnom=$mnom+1;
$mjjm=$row[jmlhrg];
$mjumlah=$mjumlah+$mjjm;
$mjumlahs=$mjumlahs+$mselisih;
$mtotdebet=$mtotdebet+($row[saldo]);
$mtotkredit=$mtotkredit+($row[kredit]);

}

$mjumlahsp=number_format($mjumlahs*0.1,0,',','.');;
$mjumlah=number_format($mjumlah,0,',','.');;
$mjumlahs=number_format($mjumlahs,0,',','.');;
$mtotdebet=number_format($mtotdebet,0,',','.');;
$mtotkredit=number_format($mtotkredit,0,',','.');;

echo("
<tr> 
<td bgcolor=#FFFFFF align=left  ><b></td>
<td bgcolor=#FFFFFF align=right ><b>TOTAL</td>
<td bgcolor=#FFFFFF align=right ><b>$mtotdebet</td>
</tr>
</table>
");
?>
</Font>
</body>
</html>