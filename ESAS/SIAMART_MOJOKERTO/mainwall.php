<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_mojokerto_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

$NAMA=$_SESSION['MANA'];

if ($mlol==33)
{
$resultxa = mysql_query ("update transnomor set paswak=-3",$links) or die ("");
}

$resultxa = mysql_query ("select *,DATE_ADD(pastang, INTERVAL paswak day) jt,now(),datediff(DATE_ADD(pastang, INTERVAL paswak day),now()) beda from transnomor",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultxa);
$mbeda=$rrwx[beda];
$mwakk=$rrwx[paswak];
if ($mwakk>0)
{

if ($mbeda<=3 && $mlol=='')
{
echo "
<p align=center>
<font size=8 color=red>
Maaf ....! Masa pakai program anda Tinggal ".$mbeda." hari lagi ! 
<br> Masukkan Password Aktivasi : <input id='thepass' onkeyup=rumus($mbeda,event,this.value)>
";

if ($mbeda>0)
{
echo "
<br> <input type='button' value='Lanjut' onclick=lanjutkan()>
";
}

echo "
<script> 

function rumus(mb,me,vall)
{

if (me.keyCode==13)
{

if (vall!='$rrwx[paspas]')
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

</script>";
return;
}

}

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<link rel='SHORTCUT ICON' href='images/newlogo5.png' />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript">

	var $Pcs2 = jQuery.noConflict();
	$Pcs2(document).ready(function(){
		var mws=screen.width
		$Pcs2("#setper").css({
		'width': mws-665+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
		});

		//window.history.pushState('Object', 'Title', '/SIADICOM');

		$Pcs2.ajax({
		type : 'POST',
		url:"backup.php",
		data : "mabc=1",
		success : function(data){	
		}})
	})
		
	</script>
	<title>MENU & INFO</title>
	</head>
	 <?php 
	 require("menu.php");

	 /*Perubahan Data*/

if (1==3)
{
execute("delete from setmenu");
//menuid 	menupos 	menucapt 	menufile 	menupict 	menuinduk 	nomor
$mnof=1;
execute("insert into setmenu values (concat('ME',lpad($mnof,3,'0')),'topmenu','Master','','','','1') ");
$mnof=2;
execute("insert into setmenu values (concat('ME',lpad($mnof,3,'0')),'','Suplier','setsup.php','','ME001','1') ");
$mnof=3;
execute("insert into setmenu values (concat('ME',lpad($mnof,3,'0')),'','Pelanggan/Mitra','setlgn.php','','ME001','2') ");
$mnof=4;
execute("insert into setmenu values (concat('ME',lpad($mnof,3,'0')),'','Kontrak','transkontrak.php','','ME001','3') ");
}	 
	/* Perubahan Data*/
	 $mdaten=date('d M Y');
	 $mtab=execute("select * from user where id='$mid'");
	 $mpd=$mtab[password];

$mhi=date('Ymd');
if ($mhi>='20500213')
{
echo "Maaf , Masa Pakai Program Sudah Habis, Silahkan Hub: Muhtar 0341-9566464, 081233279551 !";
}
else
{	 
	 $mfoc="document.ford.mid.focus()";
	 $mjam=time();
	 echo("
	 <body background='images/num.jpg'>
	 <font size=3 face=arial color='white'>
	 &nbsp;<u>____ $mdaten ____</u>
	 <br>
	 <br>
	 &nbsp;&nbsp;User : $NAMA
	 <br>
	 &nbsp;&nbsp;Jam Login : ".date("g:i a")."
	 ");
}	 
	 ?>
	</body>
</html>