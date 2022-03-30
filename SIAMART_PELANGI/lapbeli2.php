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
<title>Pembelian</title>
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
	$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
	$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
	buatlaporan();
	$Pcs2("#headertrans").html("<b>Pembelian")
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

	$Pcs2("#msupid").blur(function()
	{
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup","supid,supnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","supid='"+this.value+"'")

		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
			$Pcs2("#msupid").val(datas.supid)
			$Pcs2("#msupnama").val(datas.supnama)
		}
		buatlaporan()
	})

	$Pcs2("#chkall").click(function()
	{
		mpilih=$Pcs2("#chkall").attr('checked')
		alert(mpilih)
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
	
	$Pcs2(".rows").click(function()
	{
		arah(this.id)
	})
});

function alls()
{
	mpilih=$Pcs2("#chkall").attr('checked')

	for (qt=1;qt<100;qt++)
	{
		asd2=$Pcs2("#42_"+qt).val()
		if(asd2==undefined)
		{
			break;
		}
		$Pcs2("#44_"+qt).attr('checked',mpilih)
	}
	buatlaporan(false)
}

function buatlaporan(ngeprint, excel)
{
	asd=$Pcs2("#msupid").val()
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val();
	
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlapbeli2&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msupid="+asd+"&mstoid="+$Pcs2("#mstoid").val());
		}
		else
		{
			window.open("isilaporan.php?mLapo=mlapbeli2&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&msupid="+asd+"&mstoid="+$Pcs2("#mstoid").val());
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mlapbeli2&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&msupid="+asd+"&mstoid="+$Pcs2("#mstoid").val());
	}
}
</script>
<script type="text/javascript">
function arah(theid)
{
	$Pcs2("#row"+theid.id).css("background-color","yellow")
	buatlaporan(false)
}

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

function bukastok()
{
	//if ($Pcs2("#mnid").val()==''){$Pcs2("#mnid").focus();return;break;}
	$Pcs2("#framehrg").attr('src','lookstok.php?mobj=lookkrtstok')
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
		<table style="position: relative; text-align: left; color: white; font-family: Arial" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl.
				<input id="mtgl1" readonly size="10" type="text"> s.d.
				<input id="mtgl2" readonly size="10" type="text"></td>
				<td align="right"><a id="goprint" href="">
				<img alt="Printer" src="images/icon_print.png"></a>&nbsp;
				<a id="goprintexcel" href="">
				<img alt="" height="32" src="images/excel.png"></a></td>
			</tr>
			<tr>
				<td colspan="2">Suplier :
				<input id="msupid" size="8" type="text"><input id="mlsup" type="button" value="F5"><input id="msupnama" readonly type="text"> 
				Stok :
				<input id="mstoid" onblur="buatlaporan()" size="8" type="text"><input id="mlookstok" onclick="bukastok()" type="button" value="F5"><input id="mstonama" readonly type="text">
				</td>
			</tr>
		</table>
	</div>
</form>
<iframe id="framelap" height="450px" src="isilaporan.php" width="100%"></iframe>
<div id="kotakdialog2" title="Lookup Suplier">
	<center><iframe id="framehrg" height="450" width="100%"></iframe></center>
</div>

</body>

</html>
