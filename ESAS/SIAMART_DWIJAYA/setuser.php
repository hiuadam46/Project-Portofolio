<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_dwijaya_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>User</title>
</head>
<body bgcolor='#336600' name='user' style='font-family:arial'>

<?php
require("menu.php");
?>

<form id='dform'>
<font color=white>
Filter <input type=text id='mcar'>
<hr>
</font>
<?php

execute("delete from user where nama=''");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse;background:lightgreen;font-size:85%' >

<tr>");
echo("<th rowspan=1> No. </th>")          ;$mwd1='2 readonly';
echo("<th rowspan=1> Kode </th>")         ;$mwd2='8 readonly';
echo("<th rowspan=1> Nama </th>")         ;$mwd3='45 readonly';
echo("</tr>");

echo("
<tr>
<th><input size=$mwd1 type='text' disabled $msty></th>
<th><input size=$mwd2 type='text' disabled $msty></th>
<th><input size=$mwd3 type='text' disabled $msty></th>
</tr>

</table>

</div>

<div id='backtabel' style='background-image: url(images/backt.png);height:475px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="select *
from user 
where concat(id,nama) like '%$mfilt%' 
ORDER BY id limit 0,100";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeypress=arah(this) onfocus=arah(this);this.select()";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";

		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";
		echo "
		<td><input value='$mnom.' type='text' $midname size=$mwd1 $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "
		<td><input type='text_$mnom' $midname size=$mwd2
		value='".$rows[id]."' $nstt onblur='ambiluser(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[nama]."' $nstt ></td>
		";
		
		echo "
		<td><input type=button id='bedit_$mnom' value='Edit' class='rclass' 
		onmousemove=arah(this) 
		onkeypress=arah(this)
		onclick=edit('$mnom')
		onfocus=arah(this);this.select()
		></td>
		</tr>";

		$mnom++;
	}

	echo "
	</table>
	</div>
	";
	
?>

<div id="lookup">
	<iframe id=frame1 src='' width=100% height=500 align=center scrolling=no frameborder='0'></iframe>
</div>

<hr>
<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
<input type='button' id="tkeluar" value="Tutup" >

</form>

<link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var lastgrid=$Pcs2("#mcar")

$Pcs2(document).ready(function(){
	$Pcs2("#mcar").focus()	

$Pcs2(document).keydown(function(){
	var mmv=event.keyCode
	if (mmv==112){$Pcs2("#mcar").focus();}
	if (mmv==113){
	currObj = document.activeElement
	mid=toval(currObj.id.substr(3,2))
	edit(mid);
	
	}
	
	if (mmv==114){$Pcs2("#tambah").click();}			
})	 

$Pcs2("#mcar").keyup(function(){
	ambildata()
})

$Pcs2("#tambah").click(function(){

$Pcs2("#frame1").attr('src','edituser.php?');
$Pcs2("span.ui-dialog-title").text('Tambah user'); 
$Pcs2("#lookup").dialog('open');

})

$Pcs2("#tcetak").click(function() {
	window.open("isilaporan.php?mLapo=mSetup&mtabelnya=user&detitle=Fakultas Teknik UM <br> Daftar user<br>")
})

$Pcs2("#mcar").keypress(function(){
	var mmv=event.keyCode
	if (mmv==13 || mmv==40)
	{$Pcs2("#11_1").focus()}
})

$Pcs2("#lookup").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 800,

	close : function(){
	ambildata();
	dialogisopen=false;
	lastgrid.select()
	},

	open : function(){
	dialogisopen=true;
	},
});
	 
})

function ambildata()
{

mjadi="func=EXECTAB&field=*&tabel=user&kondisi=nama like '!!"+$Pcs2("#mcar").val()+"!!' order by id limit 0,100";
mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
async: false,
chace :true,
data : mjadi,
success : function(data){
			
			nn=1;
	        $Pcs2.each(data, function(index, array) {
	            $Pcs2("#11_"+nn).val(nn+'.');
	            $Pcs2("#12_"+nn).val(array['id']);
	            $Pcs2("#13_"+nn).val(array['nama']);
				$Pcs2("#bodiv_"+nn).show();
			nn++;
	        });
			
			for (gg=nn;gg<101;gg++)
			{
	            $Pcs2("#11_"+gg).val('');				
	            $Pcs2("#12_"+gg).val('');
	            $Pcs2("#13_"+gg).val('');
				$Pcs2("#bodiv_"+gg).hide();
			}

}});

}

function arah(theid)
{
			mname=theid.id;
			mtable1foc=mname
			mlg=mname.indexOf("_")
			msatu=mname.substr(mlg+1,1000)
			mdua=mname.substr(0,mlg)
			$Pcs2(".thebodiv").css("background-color","transparent")
			$Pcs2(".rcell").css("background-color","transparent")


				mggg=theid
				if (mggg.type!='button' && mggg.type!='checkbox')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			if (event.keyCode==13)
			{
				$Pcs2("#buka").click()
			}
			if (event.keyCode==39)
			{

				mggg=getNextElement(theid)
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				mggg.focus()
				mggg.select()
				mtable1foc=mggg.id
			}
			
			if (event.keyCode==37)
			{

				mjjj=getPrevElement(theid)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				mjjj.focus()
				mjjj.select()
				mtable1foc=mjjj.id
				
			}
			
			if (event.keyCode==38)
			{

				mbawah=parseInt(msatu)-1
				mjjj=document.getElementById(mdua+'_'+mbawah)
				mjjj.focus()
				mjjj.select()
				mtable1foc=mjjj.id

				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
			}
			if (event.keyCode==40)
			{
				mjjjd=$Pcs2("#tabjumlah").val()
				mbawah=parseInt(msatu)+1
				document.getElementById(mdua+'_'+mbawah).focus()
				document.getElementById(mdua+'_'+mbawah).select()
				mtable1foc=mdua+'_'+mbawah
				mjjj=document.getElementById(mdua+'_'+mbawah)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
			}
			
}

function edit(mnomor)
{
lastgrid = document.activeElement

mid=$Pcs2("#12_"+mnomor).val()
$Pcs2("#frame1").attr('src','edituser.php?mid='+mid);
$Pcs2("span.ui-dialog-title").text('Edit user'); 
$Pcs2("#lookup").dialog('open');
}
	
</script>

</body>
</html>