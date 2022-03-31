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
<title>Laporan Penjualan Detil 2</title>
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
	
	$Pcs2("#mpn").change(function()
	{
		buatlaporan();
	})
	
		$Pcs2("#mgrpid").blur(function() {
			datas=taptabel("setgrp","grpid,grpnama","grpid='"+this.value+"'")

			$Pcs2("#mgrpid").val("")
			$Pcs2("#mgrpnama").val("")
			if (datas.grpid!=undefined)
			{
			$Pcs2("#mgrpid").val(datas.grpid)
			$Pcs2("#mgrpnama").val(datas.grpnama)
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

function buatlaporan(ngeprint, excel)//
{
	asd=$Pcs2("#mlgnid").val()
	mtgl1=$Pcs2("#mtgl1").val()
	mtgl2=$Pcs2("#mtgl2").val();
	mgrpid=$Pcs2("#mgrpid").val();
	mnid=$Pcs2("#mgrpid").val();
	
	mpn=$Pcs2("#mpn").val();
	if(!excel)
	{
		if (!ngeprint)
		{
			$Pcs2("#framelap").attr("src", "isilaporan.php?mLapo=mlapjual3_baru&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mlgnid="+asd+"&mgrpid="+mgrpid+"&mpn="+mpn);
		}
		else
		{
			window.open("isilaporan.php?mLapo=mlapjual3_baru&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mlgnid="+asd+"&mgrpid="+mgrpid+"&mpn="+mpn);
		}
	}
	else
	{
		window.open("isilaporan.php?mLapo=mlapjual3_baru&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mlgnid="+asd+"&mgrpid="+mgrpid+"&mpn="+mpn);
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
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
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

function bukagrp()
	{
		mcomm="Select rpad(grpid,12,' ') Kode,left(grpnama,50) Nama from setgrp where true"
		mordd="Kode"
		mffff=" concat(grpid,grpnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mgrpid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Group');
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
	<div style="position: relative; width: 100%; text-align: left">
		<table style="font-family: Arial; color: white" width="100%">
			<tr>
				<td>Tgl.&emsp;&emsp;&emsp;&nbsp;&nbsp; <input id="mtgl1" readonly size="10" type="text"> 
				s.d. <input id="mtgl2" readonly size="10" type="text"></td>
				<td align="right"><a id="goprint" href="">
				<img alt="Printer" src="images/icon_print.png"></a>&nbsp;
				<a id="goprintexcel" href="">
			<img alt="" height="32" src="images/excel.png"></a></td>
			</tr>
			<tr>
				<td colspan="2">Pelanggan :
				<input id="mlgnid" size="8" type="text"><input id="mllgn" type="button" value="F5"><input id="mlgnnama" readonly type="text"> 
				Group : <input type=text id=mgrpid size=8 onblur=buatlaporan()><input type='button' id=mlookgrp value='F5' onclick=bukagrp() ><input type=text id=mgrpnama readonly>&nbsp; 
				PKP :
					<select id="mpn" name="mpn">
				<option value=" ">Semua</option>
				<option value="PKP">PKP</option>
				<option value="Non PKP">Non PKP</option>
				</select></td>
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
