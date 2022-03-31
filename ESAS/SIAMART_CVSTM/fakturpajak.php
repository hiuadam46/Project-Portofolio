<?php
require("utama.php");
$mnid=$_GET['mnid'];

/* $query = "select a.*,b.lgnnama,b.alamat
,case when b.npwp<>'' and b.npwp is not null then b.npwp else
case when b.nik<>'' and b.nik is not null then b.nik else '00.000.000.0-000.000' end end as npwp from transjual1 a left join setlgn b on a.lgnid=b.lgnid where nid='$mnid'"; */
$query = "
select a.*, b.lgnnama, b.alamat,
case
	when b.npwp<>'' and b.npwp is not null
	then b.npwp
	else
	case
		when b.nik<>'' and b.nik is not null
		then b.nik
		else '00.000.000.0-000.000'
	end
end as npwp
from transjual1 a
left join setlgn b on a.lgnid=b.lgnid
where nid='$mnid'
";

$jual1=execute2($query);

$query02 = '
select a.stoid, c.manid
from transjual2 a
left join setstok b on a.stoid=b.stoid
left join setgrp c on b.grpid=c.grpid
where a.nid="'.$jual1->nid.'"
order by a.nomor limit 0, 1
';
$jual2=execute2($query02);
?>
<!doctype html>
<html>

<head>
<meta charset="utf-8">
<title><strong>Faktur Pajak</strong></title>
</head>

<body onload="loadform()">

<font face="arial narrow">
<table border="0" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td align="center"><strong>FAKTUR PAJAK</strong></td>
	</tr>
</table>
<table border="1" cellpadding="1" cellspacing="0" width="960">
	<tr>
		<td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="30%">Kode dan Nomor Seri Faktur Pajak :</td>
				<td><strong><?php echo $jual2->manid.'.'.$jual1->nomorfp; ?></strong></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td><strong>Pengusaha Kena Pajak.</strong></td>
	</tr>
</table>
<table border="1" cellpadding="1" cellspacing="0" width="960">
	<tr>
		<td colspan="3">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="80">Nama</td>
				<td>:</td>
				<td><strong>&nbsp;&nbsp;CV. SUMBER TANI MANDIRI</strong></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>&nbsp;&nbsp;Jl Jombang Dpn Zipur 5 Babatg</td>
			</tr>
			<tr>
				<td>NPWP</td>
				<td>:</td>
				<td>&nbsp;&nbsp;74.061.779.0-653.000</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td><strong>Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak.</strong></td>
	</tr>
</table>
<table border="1" cellpadding="1" cellspacing="0" width="960">
	<tr>
		<td colspan="3">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="80">Nama</td>
				<td>:</td>
				<td><?php echo $jual1->lgnnama; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?php echo $jual1->alamat; ?></td>
			</tr>
			<tr>
				<td>NPWP</td>
				<td>:</td>
				<td><?php echo $jual1->npwp; ?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td align="center">No.<br>Urut</td>
		<td align="center">Nama Barang Kena Pajak /<br>Jasa Kena Pajak</td>
		<td align="center">Harga Jual/ Penggantian Uang<br>Muka / Termin<br>(Rp.)</td>
	</tr>
</table>
<table border="1" cellpadding="1" cellspacing="0" width="960">
	<tr>
		<td colspan="4">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
<?php
/* $query="select a.*,b.stonama,b.satuan1 from transjual2 a left join setstok b on a.stoid=b.stoid where nid='$mnid' and b.isppn='PPN' "; */
$query="
select a.*, b.stonama, b.satuan1
from transjual2 a
left join setstok b on a.stoid=b.stoid
where nid='$mnid' and b.isppn='PPN'
";

$rrw=executerow($query);
$jumlahbaris=1;
$hargajual=0;
while($row=mysql_fetch_object($rrw))
{
	$hargajual=number_format($row->jmlhrg,0,'.',',');
	$mhsat=($row->hrgsat/110)*100;
	$hargajual=$row->qty*$mhsat;
	$hargajual=round($hargajual,0);
	echo "
			<tr>
				<td width=72 align=right>$jumlahbaris.&nbsp;&nbsp;</td>
				<td>$row->stonama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".number_format($row->qty,0,'.',',')." $row->satuan1 X ".number_format($mhsat,0,'.',',')." </td>
				<td>&nbsp;</td>
				<td align='right'>".number_format($hargajual,0,'.',',')."&nbsp;&nbsp;&nbsp;</td>
			</tr>
	";
	$jumlahbaris++;
	$totalhargajual=$totalhargajual+($hargajual);
}

for($abc=$jumlahbaris;$abc<26;$abc++)
{
	echo "
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
	";
}
?>
		</table>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td>Harga Jual / Pengggantian / Uang Muka / Termin *)</td>
		<td align="right"><?php echo number_format($totalhargajual,0,'.',','); ?>&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>Dikurangi potongan harga</td>
		<td align="right"><?php echo number_format(0,0,'.',','); ?>&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>Dikurangi uang muka yang telah diterima</td>
		<td align="right">-&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>Dasar Pengenaan Pajak</td>
		<td align="right"><?php echo number_format($totalhargajual,0,'.',','); ?>&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>PPN = 10% x Dasar Pengenaan Pajak</td>
		<td align="right"><?php echo number_format($totalhargajual*10/100,0,'.',','); ?>&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td>Pajak Penjualan Atas Barang Mewah</td>
	</tr>
</table>
<!-- <table width="960" border="0" cellspacing="0" cellpadding="0" style="display: none"> -->
<table border="0" cellpadding="0" cellspacing="0" width="960">
	<tr>
		<td align="center" rowspan="8" width="607">
		<table border="0" cellpadding="1" cellspacing="0" width="82%">
			<tr>
				<td align="center">&emsp;&nbsp;</td>
				<td align="center">&ensp;&nbsp;</td>
				<td align="center">&emsp;&ensp;</td>
			</tr>
			<tr>
				<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>&emsp;&ensp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&emsp;&ensp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&emsp;&ensp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&emsp;&ensp;&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				</td>
				<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>&emsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
				</table>
				</td>
				<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">&ensp;&nbsp;&ensp;&nbsp;</td>
				<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>&ensp;&nbsp;</td>
						<td>&emsp;&ensp;&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
		<td align="center" colspan="3">Malang,&nbsp; <?php echo date( "d", strtotime($jual1->tgl)).' '.tampil_bulan(date( "n", strtotime($jual1->tgl))).' '.date( "Y", strtotime($jual1->tgl)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="3"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		Hidayatur Rahman &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="3">Direktur</td>
	</tr>
</table>
<p>&nbsp;</p>
</font>

</body>

</html>
<!-- coba siapin perintah disini -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<!-- coba siapin perintah disini -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
	window.print();
	window.close();
	opener.focus();
})
</script>
