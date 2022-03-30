<?php
ob_start("ob_gzhandler");
session_start();

$linksa=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_sumberj_data',$linksa);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$linksa) or die ("");
$rrwx=mysql_fetch_object ($resultx);
if ($rrwx->id=='')
{
	echo "<script> window.location='index.php' </script>";
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Daftar Stok</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
$Pcs2(document).ready(function()
{
	$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
	$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
	//buatlaporan();
	$Pcs2("#headertrans").html("<b>Daftar Stok")
	$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});

	var mws=screen.width

	$Pcs2("#framelap").css(
	{
		'width': mws-25+'px',
	});

	$Pcs2("#tabelhead").css(
	{
		'width': mws-25+'px',
	});

	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 800,
	});

	$Pcs2("#mlsup").click(function()
	{
		bukasuplier()
	})

	$Pcs2("#mqty").change(function()
	{
		//buatlaporan()
	})

	$Pcs2("#mtgl1").change(function()
	{
		//buatlaporan()
	})

	$Pcs2("#mtgl2").change(function()
	{
		//buatlaporan()
	})

	$Pcs2("#msupid").change(function()
	{
		//buatlaporan()
	})

	$Pcs2("#mgrpid").change(function()
	{
		//buatlaporan()
	})

	$Pcs2("#goprint").click(function()
	{
		buatlaporan(true)
	})
	
	$Pcs2("#goprintexcel").click(function()
	{
		buatlaporan(true, true);
	})
	
	$Pcs2("#btnref").click(function()
	{
		buatlaporan()
	})

	$Pcs2("#msupid").blur(function()
	{
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup","*","supid='"+this.value+"'")
		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
			$Pcs2("#msupid").val(datas.supid)
			$Pcs2("#msupnama").val(datas.supnama)
		}
	})

	$Pcs2("#mgrpid").blur(function()
	{
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setgrp","*","grpid='"+this.value+"'")
		$Pcs2("#mgrpid").val("")
		$Pcs2("#mgrpnama").val("")
		if (datas.grpid!=undefined)
		{
			$Pcs2("#mgrpid").val(datas.grpid)
			$Pcs2("#mgrpnama").val(datas.grpnama)
		}
	})
});

function buatlaporan(ngeprint, excel)
{
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val()
	msupid=$Pcs2("#msupid").val()
	mgrpid=$Pcs2("#mgrpid").val()
	mlokid=$Pcs2("#mlokid").val()
	msaldo=$Pcs2("#mqty").val();
	
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo);
		}
		else
		{
			window.open("isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo);
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mdfs&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo);
	}
}
</script>
<script type="text/javascript">
function bukasuplier()
{
	mcomm="Select rpad(supid,12,' ') Kode,left(supnama,50) Nama from setsup where true"
	mordd="Kode"
	mffff=" concat(supid,supnama) "

	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msupid')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}

function bukagrup()
{
	mcomm="Select rpad(grpid,12,' ') Kode,left(grpnama,50) Nama from setgrp where true"
	mordd="Kode"
	mffff=" concat(grpid,grpnama) "

	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mgrpid')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}
</script>
</head>

<body style="background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<form id="fform" name="fform">
	<div>
		<table id="tabelhead" style="color: white; font-family: Arial" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl.
				<input id="mtgl1" readonly size="10" type="text"> s.d.
				<input id="mtgl2" readonly size="10" type="text">&nbsp;&nbsp; Suplier
				<input id="msupid" size="5" type="text"><input id="lookmsupid" onclick="bukasuplier()" type="button" value="F5"><input id="msupnama" disabled size="22" type="text">&nbsp;&nbsp; 
				Grup <input id="mgrpid" size="5" type="text"><input id="lookgrpid" onclick="bukagrup()" type="button" value="F5"><input id="mgrpnama" disabled size="22" type="text">
				<?php

echo "&nbsp;&nbsp;Lokasi";
combobox("select a misi, a mtampil from temporer union select lokid misi,loknama mtampil from setlok order by misi","mlokid");
?>&nbsp; Saldo QTY <select id="mqty">
				<option value="Semua">Semua Stok</option>
				<option value="Minimal">Minimal</option>
				<option value="Saldo">Yang ada saldonya</option>
				</select> </td>
				<td align="right"><a id="goprint" href="">
				<img alt="Printer" src="images/icon_print.png"></a>&nbsp;
				<a id="goprintexcel" href="">
				<img alt="" height="32" src="images/excel.png"></a></td>
			</tr>
			<tr>
				<td align="center" colspan="2" style="background-color: yellow">
				<input id="btnref" type="button" value="REFRESH DATA"> </td>
			</tr>
		</table>
	</div>
</form>
<div id="kotakdialog2" title="Setup Pelanggan">
	<center><iframe id="framehrg" height="400" width="700"></iframe></center>
</div>
<iframe id="framelap" height="500px" src="isilaporan.php" width="100%"></iframe>

</body>

</html>
