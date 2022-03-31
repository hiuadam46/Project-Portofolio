<?php
ob_start("ob_gzhandler");
session_start();

$linksa=mysql_pconnect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_wps_data',$linksa);
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
<title>Penjualan Periodik</title>
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

	$Pcs2("#mllgn").click(function()
	{
		bukapelanggan()
	})

	$Pcs2("#mlgnid").blur(function()
	{
		//datas=taptabel("setlgn","lgnid,lgnnama","lgnid='"+this.value+"'")
		datas=taptabel("setlgn","lgnid,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+this.value+"'")

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

	$Pcs2("#mppn").change(function()
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
		{break;}
		$Pcs2("#44_"+qt).attr('checked',mpilih)
	}
	buatlaporan(false)
}

function buatlaporan(ngeprint, excel)
{
	asd=$Pcs2("#mlgnid").val()
	sal=$Pcs2("#mtk").val()
	mppn=$Pcs2("#mppn").val()
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val();
	
	alert ("sal = " + sal)
	alert("mppn " + mppn)
	
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlapjualnota&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mlgnid="+asd+"&mtk="+sal+"&mppn="+mppn+"&mstoid="+$Pcs2("#mstoid").val());
		}
		else
		{
			window.open("isilaporan.php?mLapo=mlapjualnota&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mlgnid="+asd+"&mtk="+sal+"&mppn="+mppn+"&mstoid="+$Pcs2("#mstoid").val());
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mlapjualnota&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mlgnid="+asd+"&mtk="+sal+"&mppn="+mppn+"&mstoid="+$Pcs2("#mstoid").val());
	}
}
</script>
<script type="text/javascript">
function arah(theid)
{
	$Pcs2("#row"+theid.id).css("background-color","yellow")
	buatlaporan(false)
}


function bukapelanggan()
{
	mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,50) Nama from setlgn where true"
	mordd="Kode"
	mffff=" concat(lgnid,lgnnama) "

	$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup pelanggan');
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
<style type="text/css">
.auto-style1 {
	text-align: center;
}
</style>
</head>

<body style="background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<form id="fform" name="fform">
	<div>
		<table style="position: relative; width: 100%; text-align: left; color: white; font-family: Arial" width="100%">
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp; Tgl.&nbsp;<input id="mtgl1" readonly size="10" type="text"> 
				s.d. <input id="mtgl2" readonly size="10" type="text"></td>
				<td class="auto-style1"><a id="goprint" href="">
				<img alt="Printer" src="images/icon_print.png"></a>
				<a id="goprintexcel" href="">
				<img alt="" height="32" src="images/excel.png"></a></td>
			</tr>
			<tr>
				<td colspan="2">Pelanggan :
				<input id="mlgnid" size="8" type="text"><input id="mllgn" type="button" value="F5"><input id="mlgnnama" readonly type="text">
				<!-- Stok : -->
				<!-- <input type=text id=mstoid size=8 onblur=buatlaporan()> -->
				<!-- <input type='button' id=mlookstok value='F5' onclick=bukastok() > -->
				<!-- <input type=text id=mstonama readonly> -->Jenis :
				<select id="mtk">
				<option value="Semua">Semua</option>
				<option value="Tunai">Tunai</option>
				<option value="Kredit">Kredit</option>
				</select> Jenis Barang :
				<select id="mppn" name="mppn" style="color: black; font-family: Arial">
				<option value="%">Semua</option>
				<option value="G001">BARANG PPN</option>
				<option value="G002">BARANG NON PPN</option>
				<option value="G003">BARANG LAIN-LAIN</option>
				</select> </td>
			</tr>
		</table>
	</div>
</form>
<iframe id="framelap" height="450px" src="isilaporan.php" width="100%"></iframe>
<div id="kotakdialog2" title="Lookup pelanggan">
	<center><iframe id="framehrg" height="450" width="100%"></iframe></center>
</div>

</body>

</html>
