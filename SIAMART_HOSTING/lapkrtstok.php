<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_pancurmas',$links);
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
<title>Kartu Stok</title>
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
	$Pcs2("#headertrans").html("<b>Kartu Stok")
	$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});
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

	$Pcs2("#mlookstok").click(function()
	{
		bukastok()
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
	
	$Pcs2("#mstoid").blur(function()
	{
		buatlaporan()
	})

	$Pcs2("#mlokid").change(function()
	{
		buatlaporan()
	})

	$Pcs2(document).keyup(function()
	{
		alert(Event.element(event))
		tabOnEnter (mmf2, event);
	})
});

function buatlaporan(ngeprint, excel)
{
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val()
	mstoid=$Pcs2("#mstoid").val()
	mlokid=$Pcs2("#mlokid").val();
	
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mkrtstok&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mstoid="+mstoid+"&mlokid="+mlokid);
		}
		else
		{
			window.open("isilaporan.php?mLapo=mkrtstok&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mstoid="+mstoid+"&lokid="+mlokid);
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mkrtstok&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mstoid="+mstoid+"&lokid="+mlokid);
	}
}
</script>
<script type="text/javascript">
function bukastok()
{
	query1="select left(a.stoid,12) stoid,a.stonama Nama from setstok a "
	query2=" where true "

	mcomm=query1+query2

	mordd="stoid "
	mffff=" stonama "

	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mstoid')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
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
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl.&nbsp;<input id="mtgl1" readonly size="10" type="text">-<input id="mtgl2" readonly size="10" type="text"> 
				Stok : <input id="mstoid" size="8" type="text"><input id="mlookstok" type="button" value="F5"><input id="mstonama" readonly type="text"> 
				Lokasi : <?php
combobox("select a misi,a mtampil from temporer union select lokid misi,concat(lokid,' - ',loknama) mtampil from setlok order by misi","mlokid")
?></td>
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
