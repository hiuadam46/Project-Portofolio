<html>
<head>
<title>
Laporan Buku Penjualan
</title>
</head>
<body bgcolor="#FFFFFF">
<?php

$mssql="
select 
a.lgnid,
e.lgnnama,
e.alamat,
a.sales,
c.karnama,
date_format(a.tgl,'%d-%m-%Y') tgl,
a.nid,
b.stoid,
d.stonama,
b.hrgsat,
b.qty,
b.qty*b.hrgsat brutto,
b.hrgsat-(b.hrgsat*b.diskonp*0.01) diskr,
b.hrgsat-(b.hrgsat*b.diskonp3*0.01) diskp,
b.diskonrp,
b.jmlhrg
from 
transjual1 a left join transjual2 b on a.nid=b.nid
left join setlgn e on a.lgnid=e.lgnid
left join setkaryawan c on a.sales=c.karid
left join setstok d on b.stoid=d.stoid
where b.stoid<>''
order by a.lgnid,a.tgl,a.nid,b.stoid
";

 	 	  	 	 	 	

echo("<table border=1 cellpadding=0 cellspacing=0 width='150%'>
<tr>
<td align=center>OUTLET</td>
<td align=center>NAMA OUTLET</td>
<td align=center>ALAMAT</td>
<td align=center>KD SLS</td>
<td align=center>NAMA SALES</td>
<td align=center>TGLFAKTUR</td>
<td align=center>NO.FAKTUR</td>
<td align=center>STOK</td>
<td align=center>NAMA BARANG</td>
<td align=center>HARGA(RP)</td>
<td align=center>QUANTITY</td>
<td align=center>BRUTTO</td>
<td align=center>REG.DISC</td>
<td align=center>EXT.DISC</td>
<td align=center>PROMO<br>UANG</td>
<td align=center>TOTAL</td>
</tr>");

$mrrw=executerow($mssql);
while ($row=mysql_fetch_assoc($mrrw))
{

echo("<tr>
<td>$row[lgnid] </td>
<td>$row[lgnnama] </td>
<td>$row[alamat] </td>
<td>$row[sales] </td>
<td>$row[karnama] </td>
<td>$row[tgl] </td>
<td>$row[nid] </td>
<td>$row[stoid] </td>
<td>$row[stonama] </td>
<td align=right>".number_format(doubleval($row[hrgsat]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[qty]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[brutto]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[diskr]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[diskp]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[diskrp]),00,',','.')."</td>
<td align=right>".number_format(doubleval($row[jmlhrg]),00,',','.')."</td>
</tr>");

}
echo("</table>");

?>
</body>
</html>