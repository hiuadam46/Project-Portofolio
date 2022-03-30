<?php
require("utama.php");
$mnid=$_GET['mnid'];

$query = "select a.*,b.lgnnama,b.alamat,b.npwp from transjual1 a left join setlgn b on a.lgnid=b.lgnid where nid='$mnid'";

$jual1=execute2($query);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><strong>Faktur Pajak</strong></title>
</head>

<body onload=loadform()>
<font face='arial narrow'>
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><strong>FAKTUR PAJAK</strong></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width=30%>Kode dan Nomor Seri Faktur Pajak :</td>
        <td><strong><?php echo $jual1->nomorfp; ?></strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Pengusaha Kena Pajak.</strong></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width=80>Nama</td>
        <td>:</td>
        <td><strong>&nbsp;&nbsp;PUTRA MAJAPAHIT<strong></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>&nbsp;&nbsp;Jl Raya Trowulan No 77 Mojokerto</td>
      </tr>
      <tr>
        <td>NPWP</td>
        <td>:</td>
        <td>&nbsp;&nbsp;74.061.779.0-653.000</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak.</strong></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width=80>Nama</td>
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
    </table></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">No.<br>
    Urut</td>
    <td align="center">Nama Barang Kena Pajak /<br>
    Jasa Kena Pajak</td>
    <td align="center">Harga Jual/ Penggantian Uang<br>
    Muka / Termin<br>
    (Rp.)</td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php
  $query="select a.*,b.stonama,b.satuan1 from transjual2 a left join setstok b on a.stoid=b.stoid where nid='$mnid' and b.isppn='PPN' ";
	$rrw=executerow($query);
	$jumlahbaris=1;
	$hargajual=0;
	while($row=mysql_fetch_object($rrw)){
	$hargajual=number_format($row->jmlhrg,0,'.',',');
	$mhsat=($row->hrgsat/110)*100;
	$hargajual=$row->qty*$mhsat;
	$hargajual=round($hargajual,0);
	echo "
      <tr>
        <td width=72 align=right>$jumlahbaris.&nbsp;&nbsp;</td>
        <td>$row->stonama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".number_format($row->qty,0,'.',',')." $row->satuan1 X ".number_format($mhsat,0,'.',',')." </td>
        <td></td>
        <td align='right'>".number_format($hargajual,0,'.',',')."&nbsp;&nbsp;&nbsp;</td>
      </tr>
	  ";
	  $jumlahbaris++;
	  $totalhargajual=$totalhargajual+($hargajual);

	  }
	  for($abc=$jumlahbaris;$abc<26;$abc++){
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
    </table></td>
  </tr>
</table>
<table width="960" border="1" cellspacing="0" cellpadding="0">
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
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Pajak Penjualan Atas Barang Mewah</td>
  </tr>
</table>
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="607" rowspan="8" align="center"><table width="82%" border="1" cellspacing="0" cellpadding="1">
      <tr>
        <td align="center">TARIF</td>
        <td align="center">DPP</td>
        <td align="center">PPn BM</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>.......</td>
            <td>%</td>
          </tr>
          <tr>
            <td>.......</td>
            <td>%</td>
          </tr>
          <tr>
            <td>.......</td>
            <td>%</td>
          </tr>
          <tr>
            <td>.......</td>
            <td>%</td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" align="center">JUMLAH</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Rp.</td>
            <td>.......</td>
          </tr>
        </table></td>
        </tr>
    </table></td>
    <td colspan="3" align="center">Malang,&nbsp; <?php echo date( "d", strtotime($jual1->tgl)).' '.tampil_bulan(date( "n", strtotime($jual1->tgl))).' '.date( "Y", strtotime($jual1->tgl)); ?></td>
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
    <td colspan=3 align=center><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hidayatur Rahman &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></td>
  </tr>
  <tr>
    <td colspan=3 align=center>Direktur</td>
  </tr>
</table>
<p>&nbsp;</p>
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

