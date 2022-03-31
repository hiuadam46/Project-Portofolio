<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="../CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style>._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->
	<script src="js/jquery-1.3.2.min.js">	var $Pcs2 = jQuery.noConflict();</script>
    <script type="text/javascript">

	var mws=screen.width

	$Pcs2(document).ready(function(){

	$Pcs2("#mhead").css({
	'width': mws-550+'px',
	'align' : 'right',
	});
	
	})

	</script>
	
	
</head>
<body>
<center>

<!-- Start css3menu.com BODY section -->
<ul id="css3menu1" class="topmenu" style="top:-10px;text-align:right;width:900">
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<li class="topfirst"  id="mhead" align=left>
	<tr>
	<td rowspan=2><img src='../images/logolestari.png' ></td>
	
	<td width=35%>
	<font size=3 face='tahoma'><b>&nbsp;&nbsp;METRO BIKE SHOP</b>
	<br>&nbsp;&nbsp;<label id='lblheader2'>Kepanjen</label>
	</td>
	
	<td align=right style='text-align:right'>
	</i>
<?php

require("../utama.php");

$mrs=executerow("select * from setmenu where menupos='topmenu' and aktif=1 order by nomor");
while ($roow=mysql_fetch_assoc($mrs))
{

echo "
<li class='topmenu'>
<a href='$roow[menufile]' target='_blank' style='height:19px;line-height:19px;'>
<span >
$roow[menucapt]
</span>
</a><ul>
";

$mrs2=executerow("select * from setmenu where menuinduk='$roow[menuid]'   and aktif=1 order by nomor,menuid");
while ($roow2=mysql_fetch_assoc($mrs2))
{

$mjj=execute("select count(*) cnt from setmenu where menuinduk='$roow2[menuid]'   and aktif=1 order by nomor,menuid");

echo "
<li>
<a href='$roow2[menufile]?mdxdiik=$mdxdiik' target='_blank' style='height:19px;line-height:19px;'>
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

$mrs3=executerow("select * from setmenu where menuinduk='$roow2[menuid]'  and aktif=1 order by nomor,menuid");
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
if ($noo>1){echo "</ul>";}

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

	<li><a href="transmutasigudang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Mutasi Gudang"/>  Mutasi Gudang</a></li>
	
	</ul></li>
	
	<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Akunting</span></a>
	<ul>

	<li><a href="transkasmasuk.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kas Masuk"/>  Kas Masuk</a></li>
	<li><a href="transkaskeluar.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kas Keluar"/>  Kas Keluar</a></li>
	
	</ul></li>

	<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Laporan</span></a>
	<ul>

	
	<li><a href="#"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Penjualan</span></a>
	<ul>
	<li><a href="lapjual.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Penjualan"/>  Penjualan</a></li>	
	<li><a href="lapbukupenjualan.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Buku Penjualan"/>  Buku Penjualan</a></li>	
	<li><a href="lappiutangpernota.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Nota Piutang"/>  Nota Piutang</a></li>

	</ul></li>
<hr>
	<li><a href="lapdaftarhutang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar Hutang"/>  Daftar Hutang</a></li>
	<li><a href="lapkrtsup.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Hutang"/>  Kartu Hutang</a></li>
<hr>
	<li><a href="lapdaftarpiutang.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar piutang"/>  Daftar Piutang</a></li>
	<li><a href="lapkrtlgn.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Piutang"/>  Kartu Piutang</a></li>
<hr>
	<li><a href="lapdaftarstok.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Daftar Stok"/>  Daftar Stok</a></li>
	<li><a href="lapkrtstok.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Kartu Stok"/>  Kartu Stok</a></li>
<hr>
	<li><a href="lapnrclajur.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Neraca Lajur"/>  Neraca Lajur</a></li>
	<li><a href="lapbkbesar.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Buku Besar"/>  Buku Besar</a></li>
	
	</ul></li>
	
	<li class="topmenu"><a href="#" style="height:19px;line-height:19px;"><span><img src="CSS3 Menu_files/css3menu1/contact3.png" alt="Item 2"/>Utilitas</span></a>
	<ul>
	<li><a href="transwaktu.php" target="_blank"><img src="CSS3 Menu_files/css3menu1/service1.png" alt="Tgl. Transaksi"/>  Tgl. Transaksi</a></li>
	</ul></li>
-->
	
	<li class="toplast"><a href="#" style="height:19px;line-height:19px;"><span><font color=red>Keluar</font></span></a>
	</ul></li>

	</td>
	</tr>
	</table>	
	
</ul>
<p class="_css3m"><a href="http://css3menu.com/">CSS Button Rollover Css3Menu.com</a></p>
<!-- End css3menu.com BODY section -->
</center>

</body>
</html>
