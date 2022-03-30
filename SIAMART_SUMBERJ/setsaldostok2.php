<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_sumberj_data',$links);
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
<title>Stok Awal</title>
</head>
<body bgcolor='#336600' name='setstok' style='font-family:arial'>

<?php
require("menu.php");
?>

<form id='dform' onsubmit='if (!this.submitted) return false; else return true;' method='POST'>
<font color=white>
 Filter <input type=text id='mcar'> 
 Grup : <input type=text size=20 id ='mgrpid' onblur=ambildata()><input type=button id='lookgrupp' value='F5' onclick=lookgrup('mgrpid')>
 Lokasi : <?php combobox("select lokid misi,concat(lokid,'-',loknama) mtampil from setlok order by misi","mlokid"); ?>
 Data dari <input size=5 maxlength=5 id='jum1' value='1'> sampai <input size=5 maxlength=5 id='jum2' value='100'>
<hr>
</font>

<?php

//execute("delete from setstok where stonama=''");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";
$mad="<select><option>a</option><option>d</option></select>";
echo("
<div id='backtabel' style='height:37px;overflow:hidden;border-color:black;border-style:solid;border-width:1px;bgcolor:white'>
<table border=1 cellpadding=0 cellspacing=0 style='border-collapse:collapse;background:lightgreen;font-size:85%' >
<tr>");

echo("<th rowspan=1> No. </th>")    ;$mwd1='2 readonly';
echo("<th rowspan=1> Kode </th>")   ;$mwd2='8 readonly';
echo("<th rowspan=1> Nama </th>")   ;$mwd3='35 readonly';
echo("<th rowspan=1> HPP </th>")   ;$mwd4='7  readonly';
echo("<th rowspan=1> Qty. </th>")    ;$mwd5='4  ';
echo("<th rowspan=1> Sat </th>")    ;$mwd6='4  readonly';
echo("<th rowspan=1> Isi </th>")    ;$mwd7='5   readonly';
echo("<th rowspan=1> Qty. </th>")    ;$mwd8='4  ';
echo("<th rowspan=1> Sat </th>")    ;$mwd9='4  readonly';
echo("<th rowspan=1> Jumlah </th>")   ;$mwd10='7  readonly';
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

<div id='backtabel' style='background-image: url(images/backt.png);height:475px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse'>
");

$query="select * 
from setstok 
where stonama like '%$mfilt%' or stoid like '%$mfilt%' and 1=3
order by stoid,POSITION('$mfilt' IN stonama),stonama limit 0,100";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
for ($ggg=1;$ggg<101;$ggg++)
	{
		$mhii='';
		$nstt=" class='rcell' style='background-color:transparent;border:0' onkeypress=arah(this) onclick=arah(this) onfocus=arah(this);this.select()";
 		$nstt2=" class='rcell' style='background-color:transparent;border:0;text-align:right' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt3=" class='rcell' style='background-color:transparent;border:0;text-align:center' onkeypress=arah(this) onfocus=arah(this);this.select()";
 		$nstt4="  onkeypress=arah(this) onfocus=arah(this);this.select()";
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
		value='".$rows[stoid]."' $nstt></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd3
		value='".$rows[stonama]."' $nstt ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd4
		value='".number_format($rows[hrgbeli],0,'.',',')."' $nstt2 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td bgcolor=lightgrey><input type='text_$mnom' $midname size=$mwd5
		value='".number_format($rows[saldo1],0,'.',',')."' $nstt2 onkeyup=hitungsimpan(this)></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd6
		value='".$rows[satuan1]."' $nstt3 ></td>
		";

		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd7
		value='".$rows[isi]."' $nstt3 ></td>
		";


		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td bgcolor=lightgrey><input type='text_$mnom' $midname size=$mwd8
		value='".number_format($rows[saldo2],0,'.',',')."' $nstt2  onkeyup=hitungsimpan(this)></td>
		";
		
		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd9
		value='".$rows[satuan2]."' $nstt3 ></td>
		";

		$mjrow=$mjrow+1;$midname="id='$mjrow".'_'."$mnom'  name='$mjrow".'_'."$mnom'";		
		echo "	
		<td><input type='text_$mnom' $midname size=$mwd10
		value='".number_format($rows[jumlah],0,'.',',')."' $nstt2 ></td>
		";
		
		echo "
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

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></iframe></td></tr>
		</center>
	</div>	

<hr>

</form>

<link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var mfocc=''

$Pcs2(document).ready(function(){
	$Pcs2("#mcar").focus()	
	ambildata()
	 

$Pcs2("#mcar").keyup(function(){
	ambildata()
})

$Pcs2("#mlokid").change(function(){
	ambildata()
})

$Pcs2("#jum1").change(function(){
	ambildata()
})
 
$Pcs2("#jum2").change(function(){
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
	$Pcs2("#12_"+mfocc).focus();
	},

	open : function(){
	dialogisopen=true;
	},
});


$Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 800,

	close : function(){
	ambildata();
	dialogisopen=false;
	$Pcs2("#12_"+mfocc).focus();
	},

	open : function(){
	dialogisopen=true;
	},
});


$Pcs2("#tambah").click(function(){

return;

})

$Pcs2("#tcetakb").click(function(){

newDialog = window.open('printbarcode.php', '_form')
document.dform.target='_form'
document.dform.submit()

})

$Pcs2("#tcetakl").click(function(){

newDialog = window.open('printlabel.php', '_form')
document.dform.target='_form'
document.dform.submit()

})
	 
})

function  hitungsimpan(theee)
{

midd=theee.id
mnom=midd.substr(3,10)
mstoid=$Pcs2("#12_"+mnom).val()
mlokid=$Pcs2("#mlokid").val()

mhrgbeli=toval($Pcs2("#14_"+mnom).val())
misi=toval($Pcs2("#17_"+mnom).val())
mmhrgbeli=mhrgbeli/misi
mmhrgbeli=mmhrgbeli

mq1=toval($Pcs2("#15_"+mnom).val())
mq2=toval($Pcs2("#18_"+mnom).val())

mtotqty=(mq1*misi)+mq2

mjmlhrg=parseInt(mtotqty*mmhrgbeli,0)

$Pcs2("#20_"+mnom).val(tra(mjmlhrg))

mjadi="mTransaksixx=SETSALSTO&mstoid="+mstoid+"&mlokid="+mlokid+"&mqty="+mtotqty+"&mjmlhrg="+mjmlhrg

$Pcs2.ajax({
type:"POST",
url:"phpexec2.php",
async: true,
data : mjadi,
success : function(data){
}})

}

function amb(nom,ev)
{

if (ev.keyCode==13)
{
edit(nom)
}

}

function ambildata()
{
mgrpid=$Pcs2("#mgrpid").val()
mgrpid=mgrpid.substr(0,4)
mlim1=toval($Pcs2("#jum1").val())-1
mlim2=$Pcs2("#jum2").val()
mlokid=$Pcs2("#mlokid").val()

if (false)
{
if ($Pcs2("#mcar").val()=='')
{
mjadi="func=EXECTAB&field=if(c.bpid=a.stoid,true,false) saldo,a.*,ifnull(b.qtyin,000000000) qtyin , ifnull(b.debet,00000000000) debet & tabel=setstok a left join bkbesar b on a.stoid=b.bpid and b.bpid2='"+mlokid+"' and b.trans='SA' left join (select bpid from bkbesar where trans<>'SA' and bpid2='"+mlokid+"' group by bpid ) c on a.stoid=c.bpid &kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!'  order by stoid,POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit "+mlim1+","+mlim2+"";
}
else
{
mjadi="func=EXECTAB&field=a.*,ifnull(b.qtyin,000000000) qtyin , ifnull(b.debet,00000000000) debet & tabel=setstok a left join bkbesar b on a.stoid=b.bpid and b.bpid2='"+mlokid+"' and b.trans='SA' &kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!'  order by POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit "+mlim1+","+mlim2+"";
}
}

if ($Pcs2("#mcar").val()=='')
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!' ) and grpid like '!!"+mgrpid+"!!'  order by stoid,POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit "+mlim1+","+mlim2+"";
}
else
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+$Pcs2("#mcar").val()+"!!' or stoid like '!!"+$Pcs2("#mcar").val()+"!!' or barcode like '!!"+$Pcs2("#mcar").val()+"!!' or barcode2 like '!!"+$Pcs2("#mcar").val()+"!!'  ) and grpid like '!!"+mgrpid+"!!'  order by POSITION('"+$Pcs2("#mcar").val()+"' IN stonama),stonama limit "+mlim1+","+mlim2+"";
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

		gg=taptabel("bkbesar","qtyin,debet","trans='SA' and bpid2='"+mlokid+"' and bpid='"+array['stoid']+"'")

		qaa=0
		if (gg.qtyin!=undefined)
		{qaa=gg.qtyin}

		ddb=0
		if (gg.debet!=undefined)
		{ddb=gg.debet}
		
		qty1=toval(qaa)/toval(array['isi'])
		qty1=parseInt(qty1,0)
		qty2=gg.qtyin-(array['isi']*qty1)
		
	            $Pcs2("#11_"+nn).val(nn+'.');
	            $Pcs2("#12_"+nn).val(array['stoid']);
	            $Pcs2("#13_"+nn).val(array['stonama']);
	            $Pcs2("#14_"+nn).val(tra(toval(array['hrgbeli'])));
		    //$Pcs2("#15_"+nn).attr('disabled',array['saldo']==1)
		    $Pcs2("#15_"+nn).val(tra(qty1));
	            $Pcs2("#16_"+nn).val(array['satuan1']);
	            $Pcs2("#17_"+nn).val(array['isi']);

		    //$Pcs2("#18_"+nn).attr('disabled',array['saldo']==1)
	            $Pcs2("#18_"+nn).val(tra(qty2));

	            $Pcs2("#19_"+nn).val(array['satuan2']);
	            $Pcs2("#20_"+nn).val(tra(toval(ddb)));
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
				

			if (event.keyCode==39 || event.keyCode==13)
			{

				mggg=getNextElement2(theid)
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

				mjjj=getPrevElement2(theid)
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
return;
}
	
</script>

</body>
</html>