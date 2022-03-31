<!DOCTYPE html>
<html>

<head>
<meta content="id" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Print</title>
<?php
require("utama.php");
require("terbilang.php");
$idkaryawan=$_GET['idgaji'];
$query11=executerow('
select *
from transjual1 a
left join setlgn b on a.lgnid=b.lgnid
left join setkaryawan c on a.sales=c.karid
where a.nid="'.$mnid.'"
');
$rowjual1=mysql_fetch_assoc($query11);
$tgljatuh=str_replace('01-01-1970', 'tunai', date('d-m-Y',strtotime($rowjual1[tgljt])));
$terbilang=str_replace('sejuta', 'satu juta', terbilang($rowjual1[jumlah]));
?>
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
</head>

<body style="font-family:Arial">
<table style='border:1px solid black; width:100%'>
	<thead>
		<tr>
			<th colspan=4>
				<u>SLIP GAJI</u>
			</th>
		</tr>
		<br>
		<br>
		<br>
		<tr align='center'>
			<th>
				<img src="logo.jpg" style='height:150px; width:auto'>
			</th>
			<th colspan=2>
				PUTRA MAJAPAHIT <br>
				Building Material Supplier
			</th>
			<th>
				Tanggal : <?php echo $_GET['tanggal'];?>
			</th>
		</tr>
		<br>
		<br>
		
	</thead>
	<tbody>
		<tr>
			<td>
			</td>
		</tr>
	</tbody>
	<br>
</table>
<table style='border:1px solid black; width:100%'>
	<tbody>
		<tr></tr>
		<tr>
			<td colspan=4>
				ID&nbsp;&nbsp;:<?php echo $_GET['idgaji'];?>
			</td>
		</tr>
		<tr>
			<td colspan=4>
				Nama&nbsp;&nbsp;:<?php echo $_GET['namagaji'];?>
			</td>
		</tr>
		<tr>
			<td colspan=4>
				Jabatan&nbsp;&nbsp;:
			</td>
		</tr>
	</tbody>
	<br>
</table>
<table style='border:1px solid black; width:100%'>
	<tbody>
		<tr align='center'>
			<td colspan=2>
				Gaji
			</td>
			<td colspan=2>
				Pengeluaran
			</td>
		</tr>
		<tr>
			<td>
				Gaji Pokok
			</td>
			<td>
				Rp. <?php echo number_format($_GET['gajipokok'], 0, ".", ",");?>
			</td>
			<td>
				Pajak Penghasilan
			</td>
			<td>
				Rp.  <?php echo number_format($_GET['pajakpenghasilan'], 0, ".", ",");?>
			</td>
		</tr>
		<tr>
			<td>
				Santunan Khusus
			</td>
			<td>
				Rp. <?php echo number_format($_GET['santunankhusus'], 0, ".", ",");?>
			</td>
			<td>
				Iuran Jamsostek
			</td>
			<td>
				Rp.  <?php echo number_format($_GET['iuranjamsostek'], 0, ".", ",");?>
			</td>
		</tr>
		<tr>
			<td>
				Uang Lembur
			</td>
			<td>
				Rp. <?php echo number_format($_GET['uanglembur'], 0, ".", ",");?>
			</td>
			<td>
				Potongan Lain-lain
			</td>
			<td>
				Rp.  <?php echo number_format($_GET['potonganlain'], 0, ".", ",");?>
			</td>
		</tr>
		<tr>
			<td>
				Uang Makan
			</td>
			<td>
				Rp. <?php echo number_format($_GET['uangmakan'], 0, ".", ",");?>
			</td>
			<td>
				
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
				Tambahan Lain-lain
			</td>
			<td>
				Rp. <?php echo number_format($_GET['tambahanlain'], 0, ".", ",");?>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr></tr>
		<tr align='left'>
			<th>
				Jumlah Gaji
			</th>
			<th>
				Rp. <?php echo number_format($_GET['jumlahgaji'], 0, ".", ",");?>
			</th>
			<th>
				Jumlah Potongan
			</th>
			<th>
				Rp.  <?php echo number_format($_GET['jumlahpotongan'], 0, ".", ",");?>
			</th>
		</tr>
		<tr></tr>
		<tr align='left'>
			<th>
				Sisa Dibayar
			</th>
			<th>
				Rp. <?php echo number_format($_GET['sisadibayar'], 0, ".", ",");?>
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
	</tbody>
	<br>
</table>
<table style='border:1px solid black; width:100%'>
	<thead>
		<tr>
			<th colspan=2>
				Penerima
			</th>
			<th colspan=2>
				majapahit, <?php echo $_GET['tanggal'];?><br>
				Menyetujui
			</th>
		</tr>
		<br><br><br><br>
		<tr>
			<th colspan=2>
				<?php echo $_GET['namagaji'];?>
			</th>
			<th colspan=2>
				Manager
			</th>
		</tr>
	</thead>
	<br>
</table>


</body>

</html>
