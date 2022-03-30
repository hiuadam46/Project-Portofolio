<?php
if($excel)
{
	@header('Content-Type: application/ms-excel');
	@header('Content-disposition: inline; filename="'.$mLapo.' '.date('d-m-Y').'.xls"');
}
?>
<html>

<head>
<title>Laporan Produksi</title>
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
<font face=Arial>
<body bgcolor=#FFFFFF name=wjual onload=printer() style='font-size:85%'>
<br>
	");
}
else
{
	echo("
<font face=Arial style='font-size:85%'>
<body bgcolor=#FFFFFF name=wjual>
<br>
	");
}
?>
<?php
echo('
TB. SUMBER JAYA MAKMUR 2
<br>
Laporan Produksi
<br>Tgl. '.$mtg1.' s.d. '.$mtg2.' '.$mtgt.'
<br><br>
');

$sqlstr1='
select nid, tgl
from bkbesar
where trans="TRANSPRODUKSI" and tgl between str_to_date("'.$mtg1.'", "%d-%c-%Y") and str_to_date("'.$mtg2.'", "%d-%c-%Y")
group by nid, tgl
';

echo "
<table width=80% border=0>
";

$maax=executerow($sqlstr1);
while ($mrrt=mysql_fetch_object($maax))
{
	echo "
	<tr>
		<td colspan=2>$mrrt->nid $mrrt->tgl </td>
	</tr>
	";

	echo "
	<tr>
		<td valign=top>
	";

	$sqlstr="
	select a.*, b.stonama, b.satuan1
	from bkbesar a
	left join setstok b on a.bpid=b.stoid
	where nid='$mrrt->nid' and qtyout>0
	";

	$maa=executerow($sqlstr);

	echo "
	Bahan :
			<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
				<tr bgcolor='lightgrey'>
					<th>No.</th>
					<th>Kode Stok</th>
					<th>Nama Stok</th>
					<th>Qty</th>
					<th>Sat.</th>
					<th>Nilai</th>
				</tr>
	";

	$nn=1;

	$totot=0;
	$tottunai=0;
	$tothutang=0;

	while ($mrr=mysql_fetch_object($maa))
	{
		echo "
				<tr >
					<td>&nbsp;$nn</td>
					<td >&nbsp;&nbsp;$mrr->bpid</td>
					<td >&nbsp;&nbsp;$mrr->stonama</td>
					<td >&nbsp;&nbsp;$mrr->qtyout</td>
					<td >&nbsp;&nbsp;$mrr->satuan1</td>
					<td align=right>".number_format($mrr->kredit,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
		";
		$nn++;
		$totot=$totot+$mrr->kredit;
	}
	
	$mbb_122=executerow("
	select kredit
	from bkbesar
	where nid='$mrrt->nid' and rekid='10010'
	");
	$mbb=mysql_fetch_object($mbb_122);
	
	echo "
				<tr>
					<td colspan=5><b>Total</td>
					<td align=right><b>".number_format($totot,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan=5><b>Biaya Produksi</td>
					<td align=right><b>".number_format($mbb->kredit,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan=5><b>Jumlah</td>
					<td align=right><b>".number_format($totot+$mbb->kredit,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
			</table><br>.
		</td>
		<td valign=top>
	";

	$sqlstr="
	select a.*, b.stonama, b.satuan1
	from bkbesar a
	left join setstok b on a.bpid=b.stoid
	where nid='$mrrt->nid' and qtyin>0
	";

	$maa=executerow($sqlstr);

	echo "
	Barang Jadi :
			<table width=100% cellspacing=0 cellpadding=0 bgcolor=white border=1 style='border-collapse:collapse;font-size:85%'>
				<tr bgcolor='lightgrey'>
					<th>No.</th>
					<th>Kode Stok</th>
					<th>Nama Stok</th>
					<th>Qty</th>
					<th>Sat.</th>
					<th>Nilai</th>
				</tr>
	";

	$nn=1;

	$totot=0;
	$tottunai=0;
	$tothutang=0;

	while ($mrr=mysql_fetch_object($maa))
	{
		echo "
				<tr >
					<td>&nbsp;$nn</td>
					<td >&nbsp;&nbsp;$mrr->bpid</td>
					<td >&nbsp;&nbsp;$mrr->stonama</td>
					<td >&nbsp;&nbsp;$mrr->qtyin</td>
					<td >&nbsp;&nbsp;$mrr->satuan1</td>
					<td align=right>".number_format($mrr->debet,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
		";
		$nn++;
		$totot=$totot+$mrr->debet;
	}

	echo "
				<tr>
					<td colspan=5><b>Total</td>
					<td align=right><b>".number_format($totot,0,'.',',')."&nbsp;&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	";
}
echo "
</table>
";
?>
<?php echo '
</font>
</body>
' ?>

</html>
