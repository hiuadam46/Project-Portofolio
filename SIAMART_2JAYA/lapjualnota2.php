<?php 
ob_start("ob_gzhandler");
session_start();

$linksa=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_2jaya_data',$linksa);
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
<title>Penjualan Per Nota</title>
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
	$Pcs2("#headertrans").html("<b>penjualan")
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
	
	$Pcs2("#mlkasir").click(function()
	{
		bukakasir()
	})
	
	$Pcs2("#mllgn").click(function()
	{
		bukapelanggan();
	})
	
	$Pcs2("#mkasir").blur(function()
	{
		buatlaporan()
		datas=taptabel("user", "id, nama", "id='"+this.value+"'")
		
		$Pcs2("#mkasir").val("")
		$Pcs2("#mkasirnama").val("")
		if (datas.id!=undefined)
		{
			$Pcs2("#mkasir").val(datas.id)
			$Pcs2("#mkasirnama").val(datas.nama)
		}
	})
	
	$Pcs2("#mlgnid").blur(function()
	{
		datas=taptabel("setlgn", "lgnid, lgnnama", "lgnid='"+this.value+"'");
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mlgnnama").val("")
		if (datas.lgnid!=undefined)
		{
			$Pcs2("#mlgnid").val(datas.lgnid)
			$Pcs2("#mlgnnama").val(datas.lgnnama)
		}
		buatlaporan()
	})
	
	$Pcs2("#chkall").click(function()
	{
		mpilih=$Pcs2("#chkall").attr('checked')
		alert(mpilih)
	})
	
	$Pcs2("#mtk").change(function()
	{
		buatlaporan()
	})
	
	$Pcs2("#mtgl1").change(function()
	{
		buatlaporan()
	})
	
	$Pcs2("#mkarid").change(function()
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
		$Pcs2("#44_"+qt).attr('checked', mpilih)
	}
	buatlaporan(false)
}

function buatlaporan(ngeprint)
{
	asd=$Pcs2("#mkasir").val()
	sal=$Pcs2("#mtk").val()
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val()
	
	mlgnid=$Pcs2("#mlgnid").val();
	
	if (!ngeprint)
	{
		$Pcs2("#framelap").attr("src", "isilaporan.php?mLapo=mlapjualnota2&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mkasir="+asd+"&mtk="+sal+"&mstoid="+$Pcs2("#mstoid").val()+"&lgnid="+mlgnid)
	}
	else
	{
		window.open("isilaporan.php?mLapo=mlapjualnota2&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mkasir="+asd+"&mtk="+sal+"&mstoid="+$Pcs2("#mstoid").val()+"&lgnid="+mlgnid)
	}
}
</script>
<script type="text/javascript">

function arah(theid)
{
	$Pcs2("#row"+theid.id).css("background-color","yellow")
	buatlaporan(false)
}

function bukakasir()
{
	/* mcomm="Select rpad(kasir,12,' ') Kode,left(lgnnama,50) Nama from setlgn where true"
	mordd="Kode"
	mffff=" concat($mkasir) "
	
	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mkasir')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup kasir');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus(); */
	mcomm="Select a.kasir User from ( select kasir from transkasir1 group by kasir) a where true "
	mordd="  kasir "
	mffff=" kasir "
	
	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mkasir')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup kasir');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}

function bukastok()
{
	$Pcs2("#framehrg").attr('src','lookstok.php?mobj=lookkrtstok')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}

function bukapelanggan()
{
	mcomm="Select rpad(lgnid, 12, ' ') Kode, left(lgnnama, 50) Nama, rpad(golongan, 12, ' ') rightGol from setlgn where true"
	mordd="Kode"
	mffff=" concat(lgnid, lgnnama, 'gol:', golongan) "

	$Pcs2("#framehrg").attr('src', 'genlookup.php?mobj=mlgnid')
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
	<div style="position: relative; width:100%; text-align: left">
		<table style="color: white; font-family: Arial" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl. <input id="mtgl1" readonly size="10" type="text"> 
				s.d. <input id="mtgl2" readonly size="10" type="text"></td>
				<td style="text-align:center"><a id="goprint" href="">
				<img alt="Print" src="images/icon_print.png"> </a></td>
			</tr>
			<tr>
				<td colspan="2">Kasir : <input id="mkasir" size="8" type="text"><input id="mlkasir" type="button" value="F5"><input id="mkasirnama" readonly type="text"> 
				Stok :
				<input id="mstoid" onblur="buatlaporan()" size="8" type="text"><input id="mlookstok" onclick="bukastok()" type="button" value="F5"><input id="mstonama" readonly type="text"> 
				Jenis : <select id="mtk">
				<option value="Semua">Semua</option>
				<option value="Tunai">Tunai</option>
				<option value="Kredit">Kredit</option>
				</select> 
	Pelanggan : <input type=text id=mlgnid size=8><input type='button' id=mllgn value='F5'><input type=text id=mlgnnama readonly></td>
			</tr>
		</table>
	</div>
</form>
<iframe id="framelap" height="450px" src="isilaporan.php" width="100%"></iframe>
<div id="kotakdialog2" title="Lookup kasir">
	<center><iframe id="framehrg" height="450" width="100%"></iframe></center>
</div>

</body>

</html>
