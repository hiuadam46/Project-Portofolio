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

$NAMA=$_SESSION['MANA'];

if ($mlol==33)
{
	$resultxa = mysql_query ("update transnomor set paswak=-3",$linksa) or die ("");
}

$resultxa = mysql_query ("select *, DATE_ADD(pastang, INTERVAL paswak day) jt, now(), datediff(DATE_ADD(pastang, INTERVAL paswak day), now()) beda from transnomor",$linksa) or die ("");
$rrwx=mysql_fetch_object ($resultxa);
$mbeda=$rrwx->beda;
$mwakk=$rrwx->paswak;
if ($mwakk>0)
{
	if ($mbeda<=3 && $mlol=='')
	{
		echo "
		<p align=center>
		<font size=8 color=red>
		Maaf ....! Masa pakai program anda Tinggal ".$mbeda." hari lagi ! 
		<br> Masukkan Password Aktivasi : <input id='thepass' onkeyup=rumus($mbeda, event, this.value)>
		";
		
		if ($mbeda>0)
		{
			echo "
			<br><input type='button' value='Lanjut' onclick=lanjutkan()>
			";
		}
		
		echo "
		<script>
		function rumus(mb, me, vall)
		{
			if (me.keyCode==13)
			{
				if (vall!='$rrwx->paspas')
				{
					alert('Password Salah !')
				}
				else
				{
					document.location='mainwall.php?mlol=33'
				}
			}
		}
		
		function lanjutkan()
		{
			document.location='mainwall.php?mlol=1'
		}
		</script>
		";
		return;
	}
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link href="images/newlogo5.png" rel="SHORTCUT ICON">
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
	
	setInterval(function()
	{
		$Pcs2.ajax(
		{
			type : 'POST',
			url:"backup.php",
			data : "mabc=1",
			success : function(data)
			{
			}
		})
		
		$Pcs2.ajax(
		{
			type : 'POST',
			url:"copydata.php",
			data : "mabc=1",
			success : function(data)
			{
			}
		})
	}, 360000);
})
</script>
<title>MENU dan INFO</title>
</head>

<?php 
require("menu.php");

/*Perubahan Data*/

$mkomn=gethostbyaddr($_SERVER['REMOTE_ADDR']);
if ($mkomn=='server-PC')
{
	$msql="
	SELECT TABLE_NAME NAMA, TABLE_SCHEMA DATAB
	FROM information_schema.TABLES
	WHERE TABLE_SCHEMA='siamart_2jaya_data'
	";
	
	$mee=executerow($msql);
	while ($mperr=mysql_fetch_object($mee))
	{
		set_time_limit(0);
		
		$mnaman=$mperr->NAMA;
		$mdatab=$mperr->DATAB;
		//echo("optimize TABLE ".$mdatab.".".$mnaman);
		execute("repair TABLE ".$mdatab.".".$mnaman);
		execute("optimize TABLE ".$mdatab.".".$mnaman);
		execute("flush TABLE ".$mdatab.".".$mnaman);
	}
}

/*
execute("ALTER TABLE siamart_2jaya_data.setstok DROP INDEX setstok1 , ADD INDEX setstok1 (stoid)");
execute("ALTER TABLE siamart_2jaya_data.setstok DROP INDEX setstok2 , ADD FULLTEXT setstok2 (stonama)");
execute("ALTER TABLE siamart_2jaya_data.setstok DROP INDEX setstok3 , ADD INDEX setstok3 (barcode)");
execute("ALTER TABLE siamart_2jaya_data.setstok DROP INDEX setstok4 , ADD INDEX setstok4 (grpid)");
execute("ALTER TABLE siamart_2jaya_data.setstok DROP INDEX setstok5 , ADD INDEX setstok5 (supid)");

execute("ALTER TABLE siamart_2jaya_data.bkbesar DROP INDEX bkbesar1,ADD INDEX bkbesar1 ( tgl, rekid , bpid , nid ) ");

execute("ALTER TABLE siamart_2jaya_data.transkasir1 DROP INDEX transkasir1 ,ADD INDEX transkasir1 ( tgl,nid ) ");
execute("ALTER TABLE siamart_2jaya_data.transkasir2 DROP INDEX transkasir2 ,ADD INDEX transkasir2 ( tgl,nid ) ");

execute("ALTER TABLE siamart_2jaya_data.transbeli1 DROP INDEX transbeli1 ,ADD INDEX transbeli1 ( tgl,nid ) ");
execute("ALTER TABLE siamart_2jaya_data.transbeli2 DROP INDEX transbeli2 ,ADD INDEX transbeli2 ( tgl,nid ) ");
*/

/* Perubahan Data*/
$mdaten=date('d M Y');
$query168=executerow("select * from user where id='".$mid."'");
$mtab=mysql_fetch_assoc ($query168);

$mpd=$mtab->password;

$mhi=date('Ymd');
if ($mhi>='20300213')
{
	echo "Maaf, Masa Pakai Program Sudah Habis, Silahkan Hub: Muhtar 0341-9566464, 081233279551 !";
}
else
{
	$mfoc="document.ford.mid.focus()";
	$mjam=time();
	echo('
	<body background="images/num.jpg">
	<font size=3 face=arial color="white">
		<table style="width:150px">
			<tr>
				<td style="border-bottom-style:solid;border-bottom-width:1px;text-align:center">&nbsp;'.$mdaten.'</td>
			</tr>
		</table>
	<br>
	&nbsp;&nbsp;User : '.$NAMA.'
	<br>
	&nbsp;&nbsp;Jam Login : '.date("g:i a").'
	');
}

$tbl_dicek='setsup';
$que_imei='SHOW FULL COLUMNS FROM '.$tbl_dicek;
$tbl_imei=executerow($que_imei);
$fld_nama = array();
while ($row_imei=mysql_fetch_assoc($tbl_imei))
{
	//echo $row_imei[Field].'<br>';
	array_push($fld_nama,$row_imei[Field]);
}
$fld_dicek='isppn';
if (in_array($fld_dicek,$fld_nama))
{
	//echo $tbl_dicek.' memiliki kolom '.$fld_dicek.'<br>';
}
else
{
	//echo $tbl_dicek.' tidak memiliki kolom '.$fld_dicek.'<br>';
	execute('ALTER TABLE '.$tbl_dicek.' ADD '.$fld_dicek.' char(10) DEFAULT "PPN" COMMENT "17PPN" AFTER kontak');
}
?>
<?php
echo '
</body>
';
?>

</html>
