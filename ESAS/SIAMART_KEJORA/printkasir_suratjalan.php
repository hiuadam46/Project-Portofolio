<!DOCTYPE html>
<html>

<head>
<meta content="id" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Print</title>
<?php
require("utama.php");
require("terbilang.php");
$mnid=$_GET['mnid'];

$mtjpoin=$_GET['mtjpoin'];

$query11=executerow('
select a.*, b.lgnnama, b.alamat, b.telp
from transkasir1 a
left join setlgn b on a.lgnid=b.lgnid
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
	// window.close();
	opener.focus();
})
document.onkeydown = function (e) {
	if (e.keyCode === 13 || e.keyCode === 27) {
		self.close();
	}
};
</script>
<style type="text/css">
.auto-style1 {
	font-weight: bold;
	font-size: 14pt;
}
</style>
</head>

<body style="font-family:Arial">

<?php
$query117=executerow('
select a.*, b.stonama, b.satuan1, b.satuan2
from transkasir2 a
left join setstok b on a.stoid=b.stoid
where a.nid="'.$mnid.'"
order by a.num
');
$numjual2=mysql_num_rows($query117);
$barisperhal=14;
$jumlahhal=ceil($numjual2/$barisperhal);
/* echo $jumlahhal;
return; */
for($j=0;$j<$jumlahhal;$j++)
{
?>
<div>
	<table cellpadding="0" cellspacing="0" style="width: 100%">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="6" style="text-align: right">Halaman&nbsp;<?php echo $j+1 ?> dari&nbsp;<?php echo $jumlahhal ?> halaman</td>
		</tr>
		<tr>
			<td colspan="5" style="font-weight: bold; font-size: 14pt">
			<label id="Label1" style="display: ">KEJORA MART</label></td>
			<td>&nbsp;</td>
			<td style="text-align: center" class="auto-style1">SURAT JALAN</td>
			<td>&nbsp;</td>
			<td>Kepada</td>
			<td>:</td>
			<td colspan="6" style="font-weight: bold; font-size: 14pt"><?php echo $rowjual1[lgnnama]; ?>
			</td>
		</tr>
		<tr>
			<td colspan="5"><label id="Label2" style="display: ">Ruko White House Kav D</label></td>
			<td>&nbsp;</td>
			<td style="text-align:center">Kasir : <?php echo $mkasir; ?></td>
			<td>&nbsp;</td>
			<td>Alamat</td>
			<td>:</td>
			<td colspan="6"><?php echo $rowjual1[alamat]; ?></td>
		</tr>
		<tr>
			<td colspan="5"><label id="Label3" style="display: ">Telp 085606462700, 082141777854</label></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Telp.</td>
			<td>:</td>
			<td colspan="6"><?php echo $rowjual1[telp]; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" style="font-weight: bold">Faktur No.: <?php echo $mnid; ?>
			</td>
			<td>&nbsp;</td>
			<td style="font-weight: bold">Tanggal : <?php echo date('d-m-Y',strtotime($rowjual1[tgl])); ?>
			</td>
			<td>&nbsp;</td>
			<td style="font-weight: bold">&nbsp;</td>
			<td style="font-weight: bold">&nbsp;</td>
			<td colspan="6" style="font-weight: bold">&nbsp;</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="width: 100%;height:103mm">
		<thead>
			<tr style="border-style: solid; border-width: 1px">
				<th style="width: 39px; <?php echo borders(1,0,1,1,2) ?>">NO.</th>
				<th colspan="3" style="<?php echo borders(1,0,1,1,2) ?>">NAMA BARANG</th>
				<th colspan="4" style="<?php echo borders(1,1,1,1,2) ?>">QTY. JUAL</th>
				<th colspan="7" style="<?php echo borders(1,0,1,1,2) ?>;display:none">&nbsp; HARGA</th>
				<th style="<?php echo borders(1,1,1,1,2) ?>;display:none">SUB TOTAL</th>
			</tr>
		</thead>
<?php
/* $query117=executerow('
select a.*, b.stonama, b.satuan1, b.satuan2
from transjual2 a
left join setstok b on a.stoid=b.stoid
where a.nid="'.$mnid.'"
order by a.nomor
');
$numjual2=mysql_num_rows($query117); */
/* echo $numjual2;
return; */
$total=0;
/* $barisperhal=15; */
//for ($i=0;$i<$numjual2;$i++)
for ($i=0;$i<$barisperhal;$i++)
{
	$rowjual2=mysql_fetch_assoc($query117);
	$qtyj=$rowjual2[qty];
	$qtyj2=$rowjual2[qty];
	
	$satuan1j=$rowjual2[satuan];
	if($qtyj==0)
	{
		$qtyj='';
		$satuan1j='';
		
		$qtyj2=1;
	}
	$unitj=$rowjual2[unit];
	$satuan2j=$rowjual2[satuan2];
	if($unitj==0)
	{
		$unitj='';
		$satuan2j='';
	}
	
	$extra=$rowjual2[extra];
	$satuan1e=$rowjual2[satuan1];
	if($extra==0)
	{
		$extra='';
		$satuan1e='';
	}
	$extraunit=$rowjual2[extraunit];
	$satuan2e=$rowjual2[satuan2];
	if($extraunit==0)
	{
		$extraunit='';
		$satuan2e='';
	}
	
	$hrgsat=number_format($rowjual2[hrgsat], 0, ".", ",");
	if($hrgsat=='0')
	{
		$hrgsat='';
	}
	
	$diskonrp=number_format($rowjual2[diskonrp], 0, ".", ",");
	if($diskonrp=='0')
	{
		$diskonrp='';
	}
	
	$hrgsatnet=number_format($rowjual2[jmlhrg]/$qtyj2, 0, ".", ",");
	if($hrgsatnet=='0')
	{
		$hrgsatnet='';
	}
	
	$jmlhrg=number_format($rowjual2[jmlhrg], 0, ".", ",");
	if($jmlhrg=='0')
	{
		$jmlhrg='';
		$no='';
	}
	else
	{
		$no=$i+1+($j*$barisperhal).'.';
	}
?>
		<tr>
			<td style="text-align: right"><?php echo $no; ?>&nbsp;</td>
			<td colspan="3">&nbsp;<?php echo $rowjual2[stonama]; ?></td>
			<td style="text-align: right"><?php echo $qtyj; ?>&nbsp;</td>
			<td><?php echo $satuan1j; ?></td>
			<td style="text-align: right"><?php echo $unitj; ?>&nbsp;</td>
			<td><?php echo $satuan2j; ?></td>
			<td style="text-align: right;display:none"><?php echo $extra; ?>&nbsp;</td>
			<td style="display:none"><?php echo $satuan1e; ?></td>
			<td style="text-align: right;display:none"><?php echo $extraunit; ?>&nbsp;</td>
			<td style="display:none"><?php echo $satuan2e; ?></td>
			<td>&nbsp;</td>
			<td style="text-align: right;display:none" colspan="2"><?php echo $hrgsatnet; ?>&nbsp;</td>
			<td style="text-align: right;display:none" class="auto-style1"><?php echo $jmlhrg; ?>&nbsp;</td>
		</tr>
<?php
	$total=$total+$rowjual2[jmlhrg];
}
?>
		<tfoot>
			<tr>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td colspan="2" style="<?php echo borders(0,0,1,0,2) ?>">Jatuh Tempo 
				: <?php echo $tgljatuh; ?></td>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td style="<?php echo borders(0,0,1,0,2) ?>">&nbsp;</td>
				<td colspan="6" style="font-weight: bold; text-align: right;display:none; <?php echo borders(1,0,1,0,2) ?>" rowspan="2">
				Total :</td>
				<td colspan="2" style="font-weight: bold; text-align: right;display:none; <?php echo borders(0,1,1,0,2) ?>" rowspan="2">
				<?php echo number_format($rowjual1[total],0,".",","); ?>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="display:none">Terbilang :</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">&nbsp;</td>
				<td colspan="6" style="vertical-align: top;display:none" rowspan="2">===<?php echo $terbilang; ?> 
				rupiah=== </td>
				<td>&nbsp;</td>
				<td colspan="6" style="font-weight: bold; text-align: right;display:none; <?php echo borders(1,0,0,1,2) ?>">
				Bayar :</td>
				<td colspan="2" style="font-weight: bold; text-align: right;display:none; <?php echo borders(0,1,0,1,2) ?>">
				<?php echo number_format($rowjual1[bayar],0,".",","); ?>&nbsp;
</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="6" style="font-weight: bold; text-align: right;display:none; <?php echo borders(1,0,0,0,2) ?>">
				Kembali :</td>
				<td colspan="2" style="font-weight: bold; text-align: right;display:none; <?php echo borders(0,1,0,0,2) ?>">
				<?php echo number_format($rowjual1[kembali],0,".",","); ?>&nbsp;</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">&nbsp;</td>
				<td colspan="6" style="vertical-align:middle">Keterangan :</td>
				<td>&nbsp;</td>
				<td colspan="6" style="font-weight: bold; text-align: right;display:none; <?php echo borders(1,0,0,1,2) ?>">
				Saldo Poin :</td>
				<td colspan="2" style="font-weight: bold; text-align: right;display:none; <?php echo borders(0,1,0,1,2) ?>">
				<?php echo number_format($mtjpoin,0,".",","); ?>&nbsp;
</td>
			</tr>
		</tfoot>
	</table>
	<table cellpadding="0" cellspacing="0" style="width: 100%">
		<tr>
			<td colspan="2">1. Sebelum ada pelunasan semua barang adalah titipan</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align: center">Yang menerima,</td>
			<td>&nbsp;</td>
			<td style="text-align: center">Yang menyerahkan,</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">2. Pembayaran dengan Cheque/Bilyet Giro</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;dianggap lunas setelah bisa dicairkan</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">3. Faktur asli merupakan bukti sah penagihan/pelunasan</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>4. Harga sudah termasuk PPN 10%</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align: center">(____________________)</td>
			<td>&nbsp;</td>
			<td style="text-align: center">(____________________)</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align: center">&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align: center">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>
<?php
}
?>

</body>

</html>
