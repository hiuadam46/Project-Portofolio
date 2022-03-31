<?php 
ob_start("ob_gzhandler");
session_start();

$linksa=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_laksmana_data',$linksa);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$linksa) or die ("");
$rrwx=mysql_fetch_object ($resultx);
if ($rrwx->id=='')
{
	echo "<script> window.location='index.php' </script>";
}

$NAMA=$_SESSION['MANA'];
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script type="text/javascript">

var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
	var mws=screen.width
	$Pcs2("#setper").css(
	{
		'width': mws-665+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
	});
	
	//window.history.pushState('Object', 'Title', '/SIADICOM');
	$Pcs2.ajax(
	{
		type : 'POST',
		url:"backup.php",
		data : "mabc=1",
		success : function(data)
		{
		}
	})
})

</script>
<title>MENU dan INFO</title>
</head>

<?php 
require("menu.php");
/*Perubahan Data*/
execute("optimize table bkbesar");
execute("optimize table transkasir1");
execute("optimize table transkasir2");
execute("optimize table setstok");
execute("optimize table transbeli1");
execute("optimize table transbeli2");
/* Perubahan Data*/
$mdaten=date('d M Y');
$mtab_64=executerow("select * from user where id='$mid'");
$mtab=mysql_fetch_assoc($mtab_64);
$mpd=$mtab[password];

$mfoc="document.ford.mid.focus()";
$mjam=time();
echo('
<body background="images/num.jpg">
<font size=3 face=arial color="white">
	<table style="width:150px">
		<tr>
			<td style="border-bottom-style:solid;border-bottom-width:1px;text-align:center">&nbsp;'.$mdaten.'</td>
		</tr>
	</table> <br>
&nbsp;&nbsp;User : '.$NAMA.' <br>
&nbsp;&nbsp;Jam Login : '.date("g:i a").'
</body>
');

$tbl_dicek='setgrp';
$que_cek='SHOW FULL COLUMNS FROM '.$tbl_dicek;
$tbl_elmt=executerow($que_cek);
$fld_nama = array();
while ($row_elmt=mysql_fetch_assoc($tbl_elmt))
{
	//echo $row_elmt[Field].'<br>';
	array_push($fld_nama,$row_elmt[Field]);
}
$fld_dicek='poin_rp';
if (in_array($fld_dicek,$fld_nama))
{
	//echo $tbl_dicek.' memiliki kolom '.$fld_dicek.'<br>';
}
else
{
	//echo $tbl_dicek.' tidak memiliki kolom '.$fld_dicek.'<br>';
	execute('ALTER TABLE '.$tbl_dicek.' ADD '.$fld_dicek.' decimal(15,0) NOT NULL COMMENT "12Nominal Poin" AFTER grpnama');
}

$querytranspoin1="
CREATE TABLE IF NOT EXISTS `transpoin1`
(
	`tgl` date NOT NULL,
	`lgnid` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
	`nid` varchar(20) COLLATE latin1_general_ci NOT NULL,
	`poin_d` double(10,2) NOT NULL DEFAULT '0.00',
	`poin_k` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
";
execute($querytranspoin1);
?>

</html>
