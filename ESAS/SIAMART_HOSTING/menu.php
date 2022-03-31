<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<!-- Start css3menu.com HEAD section -->
<link href="CSS3%20Menu_files/css3menu1/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
._css3m
{
	display: none;
}
</style>
<!-- End css3menu.com HEAD section -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
var mws=screen.width
var $Pcs3 = jQuery.noConflict();

$Pcs3(document).ready(function()
{
	$Pcs3("#mmnu").corner('bottom 5px')

	$Pcs3('#mmnu').css(
	{
		'position':'absolute',
		'top':'-2px',
		'width':mws-30+'px',
		'height':'41px',
		'background-color':'Blue',
		'background-image':'url(images/pinelumb.jpg)',
		'border-color':'white',
		'border-style':'solid',
		'border-width':'2px'
	})

	$Pcs3('#mmisi').css(
	{
		'position':'absolute',
		'top':'50px',
		'width':mws-25+'px',
	})
})
function backupdata(){
	location.href='backup.php'
}
</script>
</head>

<body>

<center>
<!-- Start css3menu.com BODY section -->
<div id="mmnu" style="text-align: right">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" style="vertical-align: middle; width: 4%; background-color: white">
			<img alt="Troli" height="75%" src="images/belanja.gif" width="75%"></td>
			<td style="width: 1%">&nbsp;</td>
			<td align="left" style="width: 40%" valign="top"><b>
			<label style="color: white; font-family: Verdana; font-size: 14pt; text-decoration: underline">
			Toko PANCURMAS Motor</label></b><br>
			<span id="subtitle" style="color: white; font-family: Verdana">Desa Harjokuncaran no 1 RT 9. RW3, kec Sumbermanjing wetan.</span></td>
			<td valign="top">
			<ul id="css3menu1" class="topmenu" style="top: 0px;">
				<li id="mhead" class="topfirst" style="text-align: left">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td></td>
					</tr>
				</table>
<?php
require("utama.php");

/* Menu*/

execute("DROP TABLE IF EXISTS setmenu");

execute("
CREATE TABLE IF NOT EXISTS setmenu
(
	menuid varchar(15) COLLATE latin1_general_ci NOT NULL,
	menupos char(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
	menucapt char(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
	menufile char(30) COLLATE latin1_general_ci NOT NULL,
	menupict char(100) COLLATE latin1_general_ci NOT NULL,
	menuinduk varchar(15) COLLATE latin1_general_ci NOT NULL,
	nomor int(11) NOT NULL DEFAULT '0',
	aktif int(1) NOT NULL,
	ids int(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (ids)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=53 ;
");

execute("ALTER TABLE menuuser CHANGE menuid menuid VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL");

execute("delete from setmenu");
//menuid,menupos,menucapt,menufile,menupict,menuinduk,nomor,aktif
execute("
insert into setmenu(menuid, menupos, menucapt, menufile, menupict, menuinduk, nomor, aktif) values
('MASTER','topmenu','Master','','','','1','1'),
	('SETSUP','','Suplier','setsup.php','','MASTER','1','1'),
	('SETLGN','','Pelanggan','setlgn.php','','MASTER','8','1'),
	('SETLOK','','Lokasi','setlok.php','','MASTER','6','1'),
	('SETGRUP','','Grup','setgrup.php','','MASTER','6','1'),
	('SETSATUAN','','Kemasan','setsatuan.php','','MASTER','6','1'),
	('SETSTOK','','Stok','setstok.php','','MASTER','6','1'),
	('BARCODE','','Barcode','setprintbarcode.php','','MASTER','6','1'),
	('SETSALDOSTOK','','Saldo Awal Stok','setsaldostok2.php','','MASTER','6','1'),
	('SETPROMO','','Promo','setpromo.php','','MASTER','9','1'),
	('SETSALES','','Sales','setkaryawan.php','','MASTER','9','1'),
	('AKUNTANSI','','Akuntansi','','','MASTER','9','1'),
		('SETKLASIFIKASI','','Klasifikasi','setklas.php','','AKUNTANSI','9','1'),
		('NERACA','','Neraca','setnrc.php','','AKUNTANSI','9','1'),
		('REKENING','','Rekening','setrek.php','','AKUNTANSI','9','1'),
('PEMBELIAN','topmenu','Pembelian','','','','1','1'),
	('TRANSPEMBELIAN','','Pembelian','transbeli.php','','PEMBELIAN','1','1'),
	('TRANSRETURPEMBELIAN','','Retur Pembelian','transreturbeli.php','','PEMBELIAN','1','1'),
	('TRANSLUNASHUTANG','','Pelunasan Hutang','translunashutang.php','','PEMBELIAN','1','1'),
('PENJUALAN','topmenu','Penjualan','','','','1','1'),
	('TRANSKASIR','','Kasir','transkasir.php','','PENJUALAN','1','1'),
	('TRANSRETURJUAL','','Retur Penjualan','transreturjual.php','','PENJUALAN','1','1'),
	('TRANSLUNASPIUTANG','','Pelunasan Piutang','translunaspiutang.php','','PENJUALAN','1','1'),
	('TRANSPOIN', '', 'Penukaran Poin', 'transpoin.php', '', 'PENJUALAN', '1', '1'),
('STOK','topmenu','Stok','','','','1','1'),
	('TRANSSESUAI','','Penyesuaian Stok','transsesuai.php','','STOK','1','1'),
	('TRANSMUTASIGUDANG','','Mutasi Gudang','transmutasigudang.php','','STOK','1','1'),
('AKUNTING','topmenu','Akunting','','','','1','1'),
	('TRANSKASMASUK','','Kas Masuk','transkasmasuk.php','','AKUNTING','1','1'),
	('TRANSKASKELUAR','','Kas Keluar','transkaskeluar.php','','AKUNTING','1','1'),
	('TRANSNONKAS','','Non Kas','transnonkas.php','','AKUNTING','1','1'),
('LAPORAN','topmenu','Laporan','','','','1','1'),
	('LAPJUALKASIR','','Laporan Penjualan Kasir','lapjualkasir.php','','LAPORAN','1','1'),
	('LAPJUALKASIRPERKASIR','','Laporan Penjualan per Kasir','lapjualkasirperkasir.php','','LAPORAN','1','1'),
	('LAPJUALPERIODIK','','Laporan Penjualan Per Nota','lapjualperiodik.php','','LAPORAN','1','1'),
	('LAPJUAL3','','Laporan Penjualan Detail ','lapjual3.php','','LAPORAN','1','1'),
	('LAPDISTRIBUSI','','Laporan Distribusi Barang','lapdistribusi.php','','LAPORAN','1','1'),
	('LAPPOIN','','Laporan Poin Pelanggan','lappoin.php','','LAPORAN','1','1'),
	('LAPLUNASPIUT','','Laporan Pelunasan Piutang','laplunaspiutang.php','','LAPORAN','1','1'),
	('LAPBELI','','Pembelian','','','LAPORAN','1','1'),
        ('LAPBELI','','Laporan Pembelian','lapbeli2.php','','LAPBELI','1','1'),
	    ('LAPBELI2PERIODIK','','Laporan Pembelian Per Nota','lapbeli2periodik.php','','LAPBELI','1','1'),
	    ('LAPBELIJT','','Laporan JT Tempo Pembelian','lapbelijt.php','','LAPBELI','1','1'),
	    ('LAP2BELI','','Laporan Pembelian Detail','lapbeli3.php','','LAPBELI','1','1'),
		('LAPRETURBELI','','Laporan Retur Pembelian','lapreturbeli.php','','LAPBELI','1','1'),
	('LAPLUNASHUT','','Laporan Pelunasan Hutang','laplunashutang.php','','LAPORAN','1','1'),
	('LAPKASHARIAN','','Laporan Kas Harian','lapkasharian.php','','LAPORAN','1','1'),
	('LAPPIUTANG','','Piutang','','','LAPORAN','1','1'),
		('LAPDFPIUTANG','','Laporan Daftar Piutang','lapdaftarpiutang.php','','LAPPIUTANG','1','1'),
		('LAPKRPIUTANG','','Laporan Kartu Piutang','lapkrtlgn.php','','LAPPIUTANG','1','1'),
	('LAPHUTANG','','Hutang','','','LAPORAN','1','1'),
		('LAPDFHUTANG','','Laporan Daftar Hutang','lapdaftarhutang.php','','LAPHUTANG','1','1'),
		('LAPKRHUTANG','','Laporan Kartu Hutang','lapkrtsup.php','','LAPHUTANG','1','1'),
	('LAPSTOK','','Stok','','','LAPORAN','1','1'),
		('LAPDFSTOK','','Laporan Daftar Stok','lapdaftarstok.php','','LAPSTOK','1','1'),
		('LAPKRSTOK','','Laporan Kartu Stok','lapkrtstok.php','','LAPSTOK','1','1'),
		('LAPPRODUKSI','','Laporan Produksi','lapproduksi.php','','LAPSTOK','1','1'),
	('LAPAKUNTANSI','','Akuntansi','','','LAPORAN','1','1'),
		('LAPBKESAR','','Laporan Buku Besar','lapbkbesar.php','','LAPAKUNTANSI','1','1'),
		('LAPNRCLJR','','Laporan Neraca Lajur','lapnrclajur.php','','LAPAKUNTANSI','1','1'),
		('LAPNRC','','Laporan Neraca','lapnrc.php','','LAPAKUNTANSI','1','1'),
		('LAPRL','','Laporan Laba Rugi','laprl.php','','LAPAKUNTANSI','1','1'),
('UTILITI','topmenu','Utiliti','','','','1','1'),
	('SETUSER','','User','setuser.php','','UTILITI','1','1'),
	('TUTUPBUKU','','Tutup Buku','tutupbuku.php','','UTILITI','1','1'),
	('BACKUP','','Backup Data','backup.php','','UTILITI','1','1')
");

/* Menu */

$mrs=executerow("
select *
from setmenu
where menupos='topmenu' and aktif=1 and menuid in
(
	select menuid
	from menuuser
	where user='".$_SESSION['MASUK']."'
)
order by ids
");
while ($roow=mysql_fetch_assoc($mrs))
{
	$abc="href='$roow[menufile]'";
	if ($roow[menufile]=='')
	{
		$abc='';
	}
	
	echo "
	<li class='topmenu'>
	<a $abc target='_blank' style='height:19px;line-height:19px;'>
	<span >
	$roow[menucapt]
	</span>
	</a><ul>
	";

	$mrs2=executerow("select * from setmenu where menuinduk='$roow[menuid]' and aktif=1 and menuid in (select menuid from menuuser where user='".$_SESSION['MASUK']."') order by ids,menuid");
	while ($roow2=mysql_fetch_assoc($mrs2))
	{
		$mjj=execute("select count(*) cnt from setmenu where menuinduk='$roow2[menuid]' and aktif=1 and menuid in (select menuid from menuuser where user='".$_SESSION['MASUK']."') order by ids,menuid");

		echo "
		<li>
		<a href='$roow2[menufile]' target='_blank' style='height:19px;line-height:19px;'>
		";

		if ($mjj[cnt]>0)
		{
			echo"<span>";
		}
		
		echo"$roow2[menucapt]";

		if ($mjj[cnt]>0)
		{
			echo"</span>";
		}

		echo"</a>";

		$mrs3=executerow("select * from setmenu where menuinduk='$roow2[menuid]' and aktif=1 and menuid in (select menuid from menuuser where user='".$_SESSION['MASUK']."') order by ids,menuid");
		$noo=1;
		while ($roow3=mysql_fetch_assoc($mrs3))
		{
			if ($noo==1){echo "<ul>";}
			echo "
			<li class='topmenu'>
			<a href='$roow3[menufile]' target='_blank' style='height:19px;line-height:19px;'>
			$roow3[menucapt]
			</a>";

			echo "
			</li>
			";
			$noo++;
		}
		if ($noo>1)
		{
			echo "</ul>";
		}

		echo "
		</li>
		";
	}

	echo "
	</ul>
	</li>
	";
}
?>
<!--
<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Stok</span></a>
<ul>

<li><a href="transmutasigudang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Mutasi Gudang"/> Mutasi Gudang</a></li>

</ul></li>

<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Akunting</span></a>
<ul>

<li><a href="transkasmasuk.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kas Masuk"/> Kas Masuk</a></li>
<li><a href="transkaskeluar.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kas Keluar"/> Kas Keluar</a></li>

</ul></li>

<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Laporan</span></a>
<ul>

<li><a href="#"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Penjualan</span></a>
<ul>
<li><a href="lapjual.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Penjualan"/> Penjualan</a></li>
<li><a href="lapbukupenjualan.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Buku Penjualan"/> Buku Penjualan</a></li>
<li><a href="lappiutangpernota.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Nota Piutang"/> Nota Piutang</a></li>

</ul></li>
<hr>
<li><a href="lapdaftarhutang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar Hutang"/> Daftar Hutang</a></li>
<li><a href="lapkrtsup.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Hutang"/> Kartu Hutang</a></li>
<hr>
<li><a href="lapdaftarpiutang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar piutang"/> Daftar Piutang</a></li>
<li><a href="lapkrtlgn.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Piutang"/> Kartu Piutang</a></li>
<hr>
<li><a href="lapdaftarstok.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar Stok"/> Daftar Stok</a></li>
<li><a href="lapkrtstok.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Stok"/> Kartu Stok</a></li>
<hr>
<li><a href="lapnrclajur.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Neraca Lajur"/> Neraca Lajur</a></li>
<li><a href="lapbkbesar.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Buku Besar"/> Buku Besar</a></li>

</ul></li>

<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Utilitas</span></a>
<ul>
<li><a href="transwaktu.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Tgl. Transaksi"/> Tgl. Transaksi</a></li>
</ul></li>
--></li>
				<li class="toplast">
				<a style="height: 19px; line-height: 19px;" onclick='window.close()'><span>
				<label style="color: red">Keluar</label></span></a> </li>
			</ul>
			</td>
		</tr>
	</table>
	<p class="_css3m"><a href="http://css3menu.com/">CSS Button Rollover Css3Menu.com</a></p>
	<!-- End css3menu.com BODY section --></div>
</center>
<?php
echo '
<div id="mmisi">
';
?>
<script type="text/javascript">
if (document.title!='MENU dan INFO')
{
	$Pcs3("#subtitle").html(document.title)
}
</script>

</body>

</html>
