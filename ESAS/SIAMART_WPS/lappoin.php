<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_wps_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
	echo "<script> window.location='index.php' </script>";
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Laporan Poin Pelanggan</title>
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
	buatlaporan();
	$Pcs2("#headertrans").html("<b>Laporan Poin Pelanggan")
	$Pcs2("#mstoid").focus()

	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 800,
	});

	$Pcs2("#mlooklgn").click(function()
	{
		bukalgn();
	})
	
	$Pcs2("#goprint").click(function()
	{
		buatlaporan(true);
	})
	$Pcs2("#goprintexcel").click(function()
	{
		buatlaporan(true, true)
	})
	$Pcs2("#mlgnid").blur(function()
	{
		buatlaporan();
	})

	$Pcs2(document).keyup(function()
	{
		alert(Event.element(event))
		tabOnEnter (mmf2, event);
	})
});

function buatlaporan(ngeprint,excel)
{
	mlgnid=$Pcs2("#mlgnid").val();
	if (!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src", "isilaporan.php?mLapo=mpoin&mlgnid="+mlgnid);
		}
		else
		{
			window.open("isilaporan.php?mLapo=mpoin&isprint=YY"+"&mlgnid="+mlgnid);
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mpoin&excel=true&isprint=YY"+"&mlgnid="+mlgnid);
	}
}
</script>
<script type="text/javascript">
function bukalgn()
{
	//if ($Pcs2("#mnid").val()==''){$Pcs2("#mnid").focus();return;break;}
	$Pcs2("#framehrg").attr('src', 'looklgn.php?mobj=lookkrtlgn')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
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
	<div style="position: relative; width: 100%; text-align: left; font-family: Arial">
		<table style="color: white" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan :
				<input id="mlgnid" size="8" type="text"><input id="mlooklgn" type="button" value="F5"><input id="mlgnnama" readonly type="text">
				</td>
					<td style="text-align: center">
					<a id="goprint" href="">
					<img alt="Cetak" src="images/icon_print.png"></a> 
					<a id="goprintexcel" href="">
					<img alt="Excel" height="32" src="images/excel.png"></a>
				</td>
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
