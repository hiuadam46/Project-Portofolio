<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_pelangi_data',$links);
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
<title>Neraca Lajur</title>
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
	buatlaporan();
	$Pcs2("#headertrans").html("<b>Neraca Lajur")
	$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});

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
		width : 800,
	});

	$Pcs2("#mlsup").click(function()
	{
		bukasuplier()
	})

	$Pcs2("#mtgl1").change(function()
	{
		buatlaporan()
	})

	$Pcs2("#mtgl2").change(function()
	{
		buatlaporan()
	})

	$Pcs2("#goprint").click(function()
	{
		buatlaporan(true)
	})
	
	$Pcs2("#goprintexcel").click(function()
	{
		buatlaporan(true, true);
	})
});

function buatlaporan(ngeprint, excel)
{
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val();
	
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mnrcljr&mtg1="+mtgl1+"&mtg2="+mtgl2);
		}
		else
		{
			window.open("isilaporan.php?mLapo=mnrcljr&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY");
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mnrcljr&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY");
	}
}
</script>
<script type="text/javascript">
function bukasuplier()
{
	//if ($Pcs2("#mnid").val()==''){$Pcs2("#mnid").focus();return;break;}
	$Pcs2("#framehrg").attr('src','looksup.php?mobj=lookdfhutang')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
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
		<table style="color: white; font-family: Arial" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl.&nbsp;<input id="mtgl1" readonly size="10" type="text"> 
				s.d. <input id="mtgl2" readonly size="10" type="text"></td>
				<td align="right"><a id="goprint" href="">
				<img alt="Printer" src="images/icon_print.png"></a>&nbsp;
				<a id="goprintexcel" href="">
				<img alt="" height="32" src="images/excel.png"></a></td>
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
