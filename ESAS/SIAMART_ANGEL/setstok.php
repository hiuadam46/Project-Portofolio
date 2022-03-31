<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_angel_data',$links);
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
<title>Stok</title>
</head>
<body bgcolor='#336600' name='setstok' style='font-family:arial'>

<?php
require("menu.php");
?>

<form id='dform' onsubmit='if (!this.submitted) return false; else return true;' method='POST'>
<font color=white>
 Filter <input type=text id='mcar'> 
 Grup : <input type=text size=20 id ='mgrpid' onblur=ambildata()><input type=button id='lookgrupp' value='F5' onclick=lookgrup('mgrpid')>

<hr>
</font>

<?php

execute("delete from setstok where false");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
$mad="<select><option>a</option><option>d</option></select>";
echo("
<div id='backtabel' style='height:39px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse;background:lightgreen;font-size:85%' >
<tr>");

echo("<th rowspan=2> No. </th>")          	;$mwd1='4 readonly';
echo("<th rowspan=2> Kode </th>")         	;$mwd2='8 readonly';
echo("<th rowspan=1 colspan=2> Barcode </th>")  ;$mwd34='8 readonly';
echo("<th rowspan=2> Nama </th>")         	;$mwd5='45 readonly';
echo("<th rowspan=2> Sat </th>")          	;$mwd6='4  readonly';
echo("<th rowspan=2> Isi </th>")          	;$mwd7='5   readonly';
echo("<th rowspan=2> Sat </th>")          	;$mwd8='4  readonly';
echo("<th rowspan=1 colspan=4> Harga </th>")   	;$mwd9101112='10  readonly';
echo("<th rowspan=2> Print<br>L/B </th>")    	;$mwd13='3';
echo("</tr>");

echo("<th rowspan=1> 1 </th>")   ;$mwd3='12  readonly';
echo("<th rowspan=1> 2 </th>")   ;$mwd4='12  readonly';
echo("<th rowspan=1> Beli </th>")   ;$mwd9='8  readonly';
echo("<th rowspan=1> Spesial </th>");$mwd10='8  readonly';
echo("<th rowspan=1> Grosir </th>") ;$mwd11='8  readonly';
echo("<th rowspan=1> Ecer </th>")   ;$mwd12='8 readonly';
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
<th><input size=$mwd11 type='text' disabled $msty></th>
<th><input size=$mwd12 type='text' disabled $msty></th>
<th><input size=$mwd13 type='text' disabled $msty></th>
</tr>

</table>

</div>

<div id='tabelisi' style='background-image: url(images/backt.png);height:450px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="select * 
from setstok 
where stonama like '%$mfilt%' or stoid like '%$mfilt%' and 1=3
order by stoid,POSITION('$mfilt' IN stonama),stonama limit 0,50";

/*$query="select * from temporer limit 0,50";*/

$rrw=executerow($query);

$mnom=1;
for ($ggg=1;$ggg<101;$ggg++)
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select() onkeydown=amb('$mnom',event)";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()  onkeydown=amb('$mnom',event)";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()  onkeydown=amb('$mnom',event)";
 		$nstt4="  onkeypress=arah(this) onfocus=arah(this);this.select() onkeydown=amb('$mnom',event)";
		$mjrow=10;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";

		echo "
		<tr id='bodiv_$mnom' class='thebodiv' $mhii height=25 hidden>
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
		value='".$rows[barcode]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".$rows[barcode2]."' $nstt onblur='ambilstok(this)'></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd5
		value='".$rows[stonama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[satuan1]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd7
		value='".$rows[isi]."' $nstt ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd8
		value='".$rows[satuan2]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd9
		value='".number_format($rows[hrgbeli],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd10
		value='".number_format($rows[hrgjual],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd11
		value='".number_format($rows[hrgjual2],0,'.',',')."' $nstt2 ></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd12
		value='".number_format($rows[hrgjual3],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd13
		value='0' $nstt3 ></td>
		";
		
		echo "
		<td><input type=button id='bedit_$mnom' value='Edit' class='rclass' 
		onmousemove=arah(this) 
		onkeypress=arah(this)
		onclick=edit('$mnom')
		onfocus=arah(this);this.select()
		></td>
		";

		echo "
		</tr>";

		$mnom++;
	}

	echo "
	</table>
	</div>
	<div id='backtabel' style='background-image: url(images/backt.png);border-color:black;border-style:solid;border-width:1px;overflow-y:hidden'>
	<b>
	<input type=button value='<<' id='b1'>
	<input type=button value='<'  id='b2'> 
	<span id='ketdata'> Jumlah Data : </span> 
	Tampil 
	<span id='ketdata2'> 0 </span> 
	sampai <span id='ketdata3'> 0 </span> 
	<input type=button value='>'   id='b3'> 
	<input type=button value='>>'  id='b4'>
	</div>
	";
	
?>

<div id="lookup">
	<iframe id=frame1 src='' width=100% height=500 align=center scrolling=no frameborder='0'></iframe>
</div>

<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></iframe></td></tr>
		</center>
</div>	

<div id="printkolom" title="Pilih Kolom Untuk Cetak">
<table width=100%>
<tr><td><input type=checkbox id='ck1' value='stoid' checked >Kode Stok</td></tr>
<tr><td><input type=checkbox id='ck2' value='stonama'  checked >Nama Stok</td></tr>
<tr><td><input type=checkbox id='ck3' value='barcode'  checked >Barcode</td></tr>
<tr><td><input type=checkbox id='ck4' value='barcode2'  checked >Barcode2</td></tr>
<tr><td><input type=checkbox id='ck5' value='satuan1'  checked >Satuan</td></tr>
<tr><td><input type=checkbox id='ck6' value='isi'  checked >Isi</td></tr>
<tr><td><input type=checkbox id='ck7' value='satuan2'  checked >Satuan 2</td></tr>
<tr><td><input type=checkbox id='ck8' value='hrgbeli'  checked >Hrg. Beli</td></tr>
<tr><td><input type=checkbox id='ck9' value='hrgjual'  checked >Hrg. Jual Grosir</td></tr>
<tr><td><input type=checkbox id='ck10' value='hrgjual2'  checked >Hrg. Spesial Grosir</td></tr>
<tr><td><input type=checkbox id='ck11' value='hrgjual3'  checked >Hrg. Eceran </td></tr>
<tr><td align=center bgcolor=green><input type=button id='theprint' value='Print'></td></tr>
</table>
</div>
<hr>


<input type='button' id="tambah" value="Data Baru" >&nbsp;&nbsp;
<input type='button' id="tcetak" value="Print Daftar" >&nbsp;&nbsp;

<input type='button' id="tcetakl" value="Print Label" >&nbsp;&nbsp;
<input type='button' id="tcetakb" value="Print Barcode" >&nbsp;&nbsp;


</form>

<link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var mfocc=''
var theratio=0
var maak=0;
var maww=0;
var aa='';
var mmul=0;

$Pcs2(document).ready(function(){
	$Pcs2("#mcar").focus()	
	ambildata()
	 

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
	dialogisopen=false;
	ambildata(maak)
	$Pcs2("#12_"+mfocc).focus();
	},

	open : function(){
	dialogisopen=true;
	},
});

$Pcs2("#printkolom").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 400,

});

$Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 800,

	close : function(){
	dialogisopen=false;
	$Pcs2("#12_"+mfocc).focus();
	},

	open : function(){
	dialogisopen=true;
	},
});


$Pcs2("#tabelisi").scroll(function(){
return;

mhh=$Pcs2("#tabelisi").scrollTop()

$Pcs2("#ketdata2").html(mhh)

kkk=theratio/801


kkk=parseInt(kkk,0)+2


mhh=mhh*(kkk)


if (mhh==801)
{mhh=1000000}

//document.title=kkk+' '+mhh

//ambildata(mhh)

})

$Pcs2("#tambah").click(function(){

$Pcs2("#frame1").attr('src','editsetstok.php?');
$Pcs2("span.ui-dialog-title").text('Tambah Stok'); 
$Pcs2("#lookup").dialog('open');

})

$Pcs2("#b3").click(function(){

msek=$Pcs2("#ketdata2").html()
msek=toval(msek)+99
ambildata(msek)

})

$Pcs2("#b2").click(function(){

msek=$Pcs2("#ketdata2").html()
msek=toval(msek)-101
ambildata(msek)

})

$Pcs2("#b4").click(function(){

ambildata(10000000)

})

$Pcs2("#b1").click(function(){

ambildata(-1)

})

$Pcs2("#tcetakb").click(function(){

mkali=0
for (abc=1;abc<101;abc++)
{
	mkali=mkali+toval(document.getElementById("23_"+abc).value)
}
mhas=mkali/3
mhas2=parseInt(mhas)
msis=mhas-mhas2
if (msis!=0 || mkali==0)
{
alert("Jumlah Total Barcode Harus kelipatan 3 !")
return;
}
newDialog = window.open('printbarcode.php', '_form')
document.dform.target='_form'
document.dform.submit()

})

$Pcs2("#tcetakl").click(function(){

aa=""
for (abb=1;abb<100;abb++)
{
gg=$Pcs2("#23_"+abb).val()
if (gg!=undefined)
{
if (gg!='0' && gg!='')
{
gg1=$Pcs2("#12_"+abb).val()
aa=aa+"'"+gg1+"',"
}
}
else
{
break;
}
}
aa=aa+"''"

newDialog = window.open('printlabel.php', '_form')
document.dform.target='_form'
document.dform.submit()

})

$Pcs2("#tcetak").click(function() {
	$Pcs2("#printkolom").dialog('open');
	//window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setstok&detitle=Master Stok<br>")
})
	 
$Pcs2("#theprint").click(function() {
	mkolnya=''
	for (jkl=1;jkl<12;jkl++)
	{
	
	mkk=$Pcs2("#ck"+jkl).attr('checked')
	if (mkk)
	{
	mkolnya=mkolnya+"'"+$Pcs2("#ck"+jkl).val()+"',"
	}
	
	}
	mkolnya=mkolnya+"'abc'"

	mgrpid=$Pcs2("#mgrpid").val()
	mgrpid=mgrpid.substr(0,4)
	
	mjadi="&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!' ";
	
	window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setstok&detitle=Master Stok<br>&mkol="+mkolnya+mjadi)
})

})

function amb(nom,ev)
{

if (ev.keyCode==13)
{
edit(nom)
}

}

function ambildata(maww)
{

if (maww==undefined || maww<0)
{
maww=0;
}

maak=maww;

mgrpid=$Pcs2("#mgrpid").val()
mgrpid=mgrpid.substr(0,4)

mjadi="func=EXEC&field=count(*) cnt &tabel=setstok&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!' ";

mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
chace :true,
async : false,
data : mjadi,
success : function(data){
	$Pcs2("#ketdata").html("Jumlah data : "+data.cnt)
	theratio=data.cnt
	if (maww>data.cnt)
	{
		mak=toval(data.cnt)-100;
		//alert(mak)
		//dd=mak.length
		//mak=mak.substr(0,dd-2)
		//mak=mak+'00'
		maww=toval(mak);
		//alert(maww)
	}

	mkkk=maww+100
	if(mkkk>data.cnt)
	{mkkk=data.cnt}
	
	$Pcs2("#ketdata2").html(maww+1)
	$Pcs2("#ketdata3").html(mkkk)
}})

mmul=maww

if ($Pcs2("#mcar").val()=='')
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!'  order by stoid,POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit "+maww+",100";
}
else
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!'  ) and grpid like '!!"+mgrpid+"!!'  order by POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit  "+maww+",100";
}

mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
chace :true,
data : mjadi,
success : function(data){
			
		nn=1;
	        $Pcs2.each(data, function(index, array) {
	            $Pcs2("#11_"+nn).val((maww+nn)+'.');
	            $Pcs2("#12_"+nn).val(array['stoid']);
	            $Pcs2("#13_"+nn).val(array['barcode3']);
	            $Pcs2("#14_"+nn).val(array['barcode2']);
	            $Pcs2("#15_"+nn).val(array['stonama']);
	            $Pcs2("#16_"+nn).val(array['satuan1']);
	            $Pcs2("#17_"+nn).val(array['isi']);
	            $Pcs2("#18_"+nn).val(array['satuanc1']);
	            $Pcs2("#19_"+nn).val(tra(toval(array['hrgbeli'])));
	            $Pcs2("#20_"+nn).val(tra(toval(array['hrgjualb'])));
	            $Pcs2("#21_"+nn).val(tra(toval(array['hrgjualb2'])));
	            $Pcs2("#22_"+nn).val(tra(toval(array['hrgjualb3'])));
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
	            $Pcs2("#21_"+gg).val('');
	            $Pcs2("#22_"+gg).val('');
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
mfocc=mnomor
mstoid=$Pcs2("#12_"+mnomor).val()
$Pcs2("#frame1").attr('src','editsetstok.php?mstoid='+mstoid);
$Pcs2("span.ui-dialog-title").text('Edit Stok'); 
$Pcs2("#lookup").dialog('open');
}
	
</script>

</body>
</html>