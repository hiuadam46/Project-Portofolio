<?php
ob_start("ob_gzhandler");
require("utama.php");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_2jaya_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
	echo "<script> window.location='index.php' </script>";
}
$mnid = $_GET["mobj"];
$mtgl = $_GET["mtgl"];
$mlgnid = $_GET["mlgnid"];
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Laporan Penjualan Kasir</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.js" type="text/javascript"></script>
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
	buatlaporan();
	$Pcs2("#headertrans").html("<b>Penjualan")
	
	$Pcs2("#framelap").css(
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
		width: 680,
		height: 470,
	});
	
	$Pcs2("#mlgrpid").click(function()
	{
		mcomm="Select rpad(grpid,12,' ') Kode,left(grpnama,50) Nama from setgrp where true"
		mordd="Kode"
		mffff=" grpnama "
		//$Pcs2("#framehrg").attr('height', 330);
		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mgrpid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})
	
	//$Pcs2("#mgrpid").blur(function()
	$Pcs2("#mgrpid").change(function()
	{
		datas=taptabel("setgrp","*","grpid='"+this.value+"'")
		$Pcs2("#mgrpnama").val("")
		if (datas.grpnama!=undefined)
		{
			$Pcs2("#mgrpid").val(datas.grpid)
			$Pcs2("#mgrpnama").val(datas.grpnama)
		}
		buatlaporan()
	})
	
	$Pcs2("#goprint").click(function()
	{
		buatlaporan(true)
	})
});

function buatlaporan(ngeprint)
{
	mgrpid=$Pcs2("#mgrpid").val();
	
	mnid=$Pcs2("#mnid_2").val();
	mtgl=$Pcs2("#mtgl_2").val();
	mlgnid=$Pcs2("#mlgnid_2").val();
	mgrpnama=$Pcs2("#mgrpnama").val();
	
	if (!ngeprint)
	{
		$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mprintgrp&mgrpid="+mgrpid+"&mnid="+mnid+'&mtgl='+mtgl+'&mlgnid='+mlgnid+'&mgrpnama='+mgrpnama);
	}
	else
	{
		window.open("isilaporan.php?mLapo=mprintgrp&isprint=YY"+"&mgrpid="+mgrpid+"&mnid="+mnid+'&mtgl='+mtgl+'&mlgnid='+mlgnid+'&mgrpnama='+mgrpnama);
	}
}
</script>
</head>

<body style="background-image: url('images/num.jpg')">

<form id="fform" name="fform">
	<table style="color: white; font-family: Arial" width="100%">
		<tr>
			<td>Grup Stok : 
			<input style="display:none" id="mgrpid_3" size="8" type="text" name="mgrpid_3"><input style="display:none" id="mlgrpid" type="button" value="F5"><input style="display:none" id="mgrpnama" readonly type="text">
			<input style="display:none" readonly="readonly" id="mnid_2" name="mnid_2" type="text" value="<?php echo $mnid ?>">
			<input style="display:none" readonly="readonly" id="mtgl_2" name="mtgl_2" type="text" value="<?php echo $mtgl ?>">
			<input id="mlgnid_2" readonly size="5" style="font-weight: bold;display:none" type="text" name="mlgnid_2" value="<?php echo $mlgnid ?>"><?php combobox('
			select "" misi,"" mtampil
			union
			select b.grpid misi, c.grpnama mtampil
			from transkasir2 a
			left join setstok b on a.stoid=b.stoid
			left join setgrp c on b.grpid=c.grpid
			where a.nid="'.$mnid.'"
			', 'mgrpid'); ?></td>
			<td style="text-align:center"><a id="goprint" href="">
			<img alt="Print" src="images/icon_print.png"></a></td>
		</tr>
		</table>
</form>
<iframe id="framelap" height="447px" src="isilaporan.php" width="100%"></iframe>
<div id="kotakdialog2">
	<center><iframe id="framehrg" height="400" width="100%"></iframe></center>
</div>

</body>

</html>
