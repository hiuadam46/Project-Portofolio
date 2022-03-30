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

<html>
		<script type="text/javascript" src="imask2_files/mootools.js"></script>
		<script type="text/javascript" src="imask2_files/moodalbo.js"></script>
		<script type="text/javascript" src="imask2_files/shCore00.js"></script>
		<script type="text/javascript" src="imask2_files/shBrushX.js"></script>
		<script type="text/javascript" src="imask2_files/shBrushJ.js"></script>
		<script type="text/javascript" src="imask2_files/imask-fu.js"></script>
		<script type="text/javascript">

//<![CDATA[
var Page = {
	initialize: function() {

		dp.SyntaxHighlighter.HighlightAll('usage_include');
		dp.SyntaxHighlighter.HighlightAll('usage_initialize');
		dp.SyntaxHighlighter.HighlightAll('usage_xhtml');

		new SmoothScroll({
			transition: Fx.Transitions.backOut,
			fps: 60,
			duration: 1500
		});

		new iMask({
			onFocus: function(obj) {
				obj.setStyles({"background-color":"#ff8", border:"1px solid #880"});
			},

			onBlur: function(obj) {
				obj.setStyles({"background-color":"#fff", border:"1px solid #ccc"});
			},

			onValid: function(event, obj) {
				obj.setStyles({"background-color":"#8f8", border:"1px solid #080"});
			},

			onInvalid: function(event, obj) {
				if(!event.shift) {
					obj.setStyles({"background-color":"#f88", border:"1px solid #800"});
				}
			}
		});
	}
};

window.onDomReady(Page.initialize);
//]]>

function getNextElement(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = 0; e < form.elements.length; e++) {
    if (fieldFound && form.elements[e].type != 'hidden' )
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  return form.elements[e % form.elements.length];
}

function getPrevElement(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = form.elements.length; e > 0; e--) {
    if (fieldFound && form.elements[e].type != 'hidden')
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  return form.elements[e % form.elements.length];
}

function tabOnEnter (field, evt) {
  var keyCode = document.layers ? evt.which : document.all ? 
evt.keyCode : evt.keyCode;
  if (keyCode != 13)
    return true;
  else {
    getNextElement(field).focus();
    getNextElement(field).select();
    return false;
  }
 
}

function foredit(msto)
{
xxw=window.open('setstok.php?mstoid='+msto,'aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=800,height=580,left=100,top=10'));
xxw.mstoid.value=msto
xxw.focus()
}

function forcari(mcc)
	{
		document.ford.action='lapdfstok.php?mCari='+mcc;
		document.ford.submit()
	}

function forcetak()
		{
		document.ford.action='printdfstok.php';
		document.ford.submit()
		}
		
</script>
<head>
<title>
Laporan Daftar Stok
</title>
</head>
<?php
require("menu.php");

$mgrpids=substr($mgrpid,0,4);
$dicari=$bCari;
if (empty($mtgl1))
{$mtgl1=date('d-m-Y');}

if (empty($mtgl2))
{$mtgl2=date('d-m-Y');}


if ($mbagian=='header')
{
$mback='#CCCCBB';
}
else
{
$mback='#FFFFFF';
$mfoc='onload=document.ford.xedit30.focus()';
}

if ($mbagian=='cetak')
{
$mvarwar='#FFFF80';
$mvarwarf='OOOOOO';
}
else
{
$mvarwar='#203545';
$mvarwarf='FFFFFF';
}

echo("
<body bgcolor=#FFFFFF background=images/back3.jpg onload=document.ford.mEdit1.focus()'>
<br><p align=center><Font size=5 face=Arial color=white>
Laporan Daftar Stok</font></p>
<form action=lapdfstok.php method=POST NAME='ford' >
<div align=right><input type=button value='Cetak' NAME='bCetak' onclick='forcetak()'> <input type=button value='Keluar' NAME='bClose' onclick='window.close()'> </div>
Cari...  <input type=text size=70% value='$bCari' NAME='bCari' onkeydown=if(event.keyCode==13){this.blur()}  onblur='document.ford.submit()'>
");

echo("<br>Tgl.&nbsp&nbsp&nbsp&nbsp&nbsp<input style='font-family:verdana;font-size:11pt' onblur='document.ford.submit();document.ford.mtgl2.focus()' size=10 maxlength='10' class=iMask id="); 
echo(' "myDate" name="mtgl1" type="text" ');
echo("value='$mtgl1'");
echo('alt="{');
echo("type:'fixed',mask:'99-99-9999',stripMask: false"); 
echo('}">');

echo(" S/d       <input style='font-family:verdana;font-size:11pt' onblur='document.ford.submit()' size=10 maxlength='10' class=iMask id="); 
echo(' "myDate" name="mtgl2" type="text" ');
echo("value='$mtgl2'");
echo('alt="{');
echo("type:'fixed',mask:'99-99-9999',stripMask: false"); 
echo('}">');

echo("<br>
Grup&nbsp&nbsp&nbsp<select name='mgrpid' size=1 id=Combobox1 z-index:0 style='font-family:verdana;font-size:12px' onchange=document.ford.submit()>
<option style='font-family:verdana;font-size:5pt'></option>");
$sqlstrg="select * from setgrp order by grpid";
$resultg = mysql_query ($sqlstrg) or die ("Kesalahan pada perintah SQL!");
while ($rowg = mysql_fetch_assoc ($resultg))
{
	$mgrpidinput=$rowg[grpid];
	$mgrpnamai=$rowg[grpnama];
	$mmsel="";
	if ($mgrpids=="$mgrpidinput")
	{$mmsel='selected';}
	echo("<option style='font-family:verdana;font-size:5pt' $mmsel >$mgrpidinput $mgrpnamai</option>");
}

$mvar3="style='border:0px solid;font:16px;color:#FFFFFF;background:$mvarwar' align=center readonly";

echo("</select>
<hr size=1 width=100% align=left color=white>
<table border=0 cellspacing=1 cellpadding=1 bgcolor=#FFFFFF align=center width=100%> 
<tr>
<td bgcolor=$mvarwar align=center width=5%><Font color=#$mvarwarf>No.</td>
<td bgcolor=$mvarwar align=center width=10%><Font color=#$mvarwarf>Kode</td>
<td bgcolor=$mvarwar align=center width=30%><Font color=#$mvarwarf>Nama</td>
<td bgcolor=$mvarwar align=center width=5%><Font color=#$mvarwarf>Isi</td>
<td bgcolor=$mvarwar align=center width=10%><Font color=#$mvarwarf>Awal</td>
<td bgcolor=$mvarwar align=center width=10%><Font color=#$mvarwarf>In</td>
<td bgcolor=$mvarwar align=center width=10%><Font color=#$mvarwarf>Out</td>
<td bgcolor=$mvarwar align=center width=10%><Font color=#$mvarwarf>Akhir</td> 
</tr>
");

$mnom=30;
$mjumlah=0;
$mgp1='';
$mgpx='#FFFFFF';
$mttgl1=substr($mtgl1,6,4).'-'.substr($mtgl1,3,2).'-'.substr($mtgl1,0,2);
$mttgl2=substr($mtgl2,6,4).'-'.substr($mtgl2,3,2).'-'.substr($mtgl2,0,2);

$result = executerow("
select a.stoid,a.stonama,a.grpid,a.satuan,a.isi,a.satuan2,d.grpnama,b.qawal,c.qin,c.qout from setstok a 
left join (select stoid,sum(qtyin-qtyout) as qawal from vkrtsto where tgl<'$mttgl1' group by stoid) b on a.stoid=b.stoid
left join (select stoid,sum(qtyin) as qin,sum(qtyout) as qout from vkrtsto where tgl between '$mttgl1' and '$mttgl2' group by stoid) c on a.stoid=c.stoid
left join setgrp d on a.grpid=d.grpid where a.grpid like '$mgrpids%' and a.stonama like '%$dicari%'
order by d.grpnama,a.stoid
");
while ($row = mysql_fetch_assoc ($result))
{
$mgrpid=$row[grpid];
$mgrpnama=$row[grpnama];
$mstoid=$row[stoid];
$mstonama=$row[stonama];
$mstosat=$row[satuan];
$misi=$row[isi];
$mstosat2=$row[satuan2];
$mawal=$row[qawal];
$min=$row[qin];
$mout=$row[qout];
$makhir=$mawal+$min-$mout;

$mawal=cqty($mawal,$misi,$mstosat,$mstosat2);
$min=cqty($min,$misi,$mstosat,$mstosat2);
$mout=cqty($mout,$misi,$mstosat,$mstosat2);
$makhir=cqty($makhir,$misi,$mstosat,$mstosat2);

$mhrgbeli=number_format($row[hrgbeli],0,',','.');
$mhrgjual2=number_format($row[hrgjual2],0,',','.');
$mhrgjual3=number_format($row[hrgjual3],0,',','.');

$mvar="
style='border:0px #FFFFFF solid;font:16px;font-color:#FFFFFF' readonly 
";
$mnomp=$mnom-1;
$mnomn=$mnom+1;
$mnbrs=$mnom-29;
$mvarb1="";
$mvarb2="";
$mvar2=" 
onkeypress='if(event.keyCode==40) document.ford.xedit$mnomn.focus(); 
if(event.keyCode==38) document.ford.xedit$mnomp.focus()' ";

if ($mgp1!=$mgrpid)
{
	echo("<tr><td bgcolor=#FFFFFF colspan=7 align=left ><font size=2>$mgrpnama</font></td></tr>");
	$mgp1=$mgrpid;
}

echo("
<tr> 
<td bgcolor=$mgpx align=right width=7%>$mnbrs.</td>
<td bgcolor=$mgpx width=10%>
");

if ($mbagian!='cetak')
{
echo("<input align=center type=button value=$mstoid name='xedit$mnom' $mvar2 onclick='foredit(this.value);'>");
}
else
{
echo("$mstoid");
}

echo("
</td>
<td bgcolor=$mgpx width=30%>$mstonama</td>
<td bgcolor=$mgpx align=center width=5%>$misi</td>
<td bgcolor=$mgpx align=left width=10%>$mawal</td>
<td bgcolor=$mgpx align=left width=10%>$min</td>
<td bgcolor=$mgpx align=left width=10%>$mout</td> 
<td bgcolor=$mgpx align=left width=10%>$makhir</td>
</tr>
");
$mnom=$mnom+1;
$mjjm=$row[jmlhrg];
$mjumlah=$mjumlah+$mjjm;

if ($mbagian!='cetak')
{
if ($mgpx=='#FFFFFF')
{
$mgpx='#FFFF80';
}
else
{
$mgpx='#FFFFFF';
}
}
}
echo("<tr><td colspan=6><input type=hidden></td></tr>
</table>");
$mvar3="style='border:0px solid;font:16px;color:#CCCCBB;background:#CCCCBB' align=center readonly";
$mvarwar='#FFFFFF';


?>
</Font>
</body>
</html>