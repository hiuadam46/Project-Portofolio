<html>
<head>
<title>Stok</title>
</head>
<body bgcolor='#336600' name='setstok' style='font-family:arial'>

<?php
require("menu.php");
?>

<form id='dform'>
<font color=white>
Filter <input type=text id='mcar'>
<hr>

<?php

execute("delete from setstok where stonama=''");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
echo("
<div id='backtabel' style='height:19px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse;background:lightgreen;font-size:85%' >

<tr>");
echo("<th rowspan=1> No. </th>")          ;$mwd1='2 readonly';
echo("<th rowspan=1> Kode </th>")         ;$mwd2='8 readonly';
echo("<th rowspan=1> Nama </th>")         ;$mwd3='40 readonly';
echo("<th rowspan=1> Satuan </th>")       ;$mwd4='6  readonly';
echo("<th rowspan=1> Isi </th>")          ;$mwd5='5   readonly';
echo("<th rowspan=1> Satuan </th>")       ;$mwd6='6  readonly';
echo("<th rowspan=1> Hrg Beli </th>")   ;$mwd7='10  readonly';
echo("<th rowspan=1> Hrg Spesial </th>");$mwd8='10  readonly';
echo("<th rowspan=1> Hrg Grosir </th>") ;$mwd9='10  readonly';
echo("<th rowspan=1> Hrg Ecer </th>")   ;$mwd10='10 readonly';
echo("</tr>");

echo("
<tr>
<th><input size=$mwd1 type='text' disabled $msty></th>
<th><input size=$mwd2 type='text' disabled $msty></th>
<th><input size=$mwd3 type='text' disabled $msty></th>
<th><input size=$mwd4 type='text' disabled $msty></th>
<th><input size=$mwd5 type='text' disabled $msty></th>
<th><input size=$mwd6 type='text' disabled $msty></th>
<th><input size=$mwd7 type='text' disabled $msty></th>
<th><input size=$mwd8 type='text' disabled $msty></th>
<th><input size=$mwd9 type='text' disabled $msty></th>
<th><input size=$mwd10 type='text' disabled $msty></th>
</tr>

</table>

</div>

<div id='isitabel' style='background-image: url(images/backt.png);height:475px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll' onscroll=scrl()>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="select * 
from setstok 
where stonama like '%$mfilt%' 
order by POSITION('$mfilt' IN stonama),stonama limit 0,100";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
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
		value='".$rows[stoid]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[stonama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[isi]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[satuan2]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd7
		value='".number_format($rows[hrgbeli],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd8
		value='".number_format($rows[hrgjual],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd9
		value='".number_format($rows[hrgjual2],0,'.',',')."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd10
		value='".number_format($rows[hrgjual3],0,'.',',')."' $nstt2 ></td>
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

<link rel="stylesheet" type="text/css" href="../themes/sunny/ui.all.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.dialog.js"></script>
<script type="text/javascript" src="../js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function(){
	$Pcs2("#mcar").focus()	
	 

$Pcs2("#mcar").keyup(function(){
	ambildata()
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
	},

	open : function(){
	dialogisopen=true;
	},
});
	 
})

function ambildata()
{

mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi=stonama like '!!"+$Pcs2("#mcar").val()+"!!' order by POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit 0,100";
mdat='';
$Pcs2.ajax({
type:"POST",
url:"../phpexec.php",
dataType:'json',
async: false,
chace :true,
data : mjadi,
success : function(data){
			
			nn=1;
	        $Pcs2.each(data, function(index, array) {
	            $Pcs2("#11_"+nn).val(nn+'.');
	            $Pcs2("#12_"+nn).val(array['stoid']);
	            $Pcs2("#13_"+nn).val(array['stonama']);
	            $Pcs2("#14_"+nn).val(array['satuan1']);
	            $Pcs2("#15_"+nn).val(array['isi']);
	            $Pcs2("#16_"+nn).val(array['satuan2']);
	            $Pcs2("#17_"+nn).val(array['hrgbeli']);
	            $Pcs2("#18_"+nn).val(array['hrgjual']);
	            $Pcs2("#19_"+nn).val(array['hrgjual2']);
	            $Pcs2("#20_"+nn).val(array['hrgjual3']);
				$Pcs2("#bodiv_"+nn).show();
			nn++;
	        });
			
			for (gg=nn;gg<101;gg++)
			{
	            $Pcs2("#11_"+gg).val('');				
	            $Pcs2("#12_"+gg).val('');
	            $Pcs2("#13_"+gg).val('');
	            $Pcs2("#14_"+gg).val('');
	            $Pcs2("#15_"+gg).val('');
	            $Pcs2("#16_"+gg).val('');
	            $Pcs2("#17_"+gg).val('');
	            $Pcs2("#18_"+gg).val('');
	            $Pcs2("#19_"+gg).val('');
	            $Pcs2("#20_"+gg).val('');
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
mstoid=$Pcs2("#12_"+mnomor).val()
$Pcs2("#frame1").attr('src','../editsetstok.php?mstoid='+mstoid);
$Pcs2("span.ui-dialog-title").text('Edit Stok'); 
$Pcs2("#lookup").dialog('open');
}
	
</script>

</body>
</html>