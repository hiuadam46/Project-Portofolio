<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Lookup Satuan</title>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <link type="text/css" href="css/mytablegrid2.css" rel="stylesheet">
    <link type="text/css" href="css/shCore.css" rel="stylesheet">
    <link type="text/css" href="css/shThemeRDark.css" rel="stylesheet" id="shTheme">
    <script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
	var mwh=window.innerWidth-2
	var mht=window.innerHeight-32
	var mobj='<?php echo $mobj; ?>'
	$Pcs2(document).ready(function(){
	$Pcs2("#msat1").select()

	$Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			mmf2=event.element(event)
			mid=event.element(event).id
			mhg=mid.replace('msat','mhrg');
			mis=mid.replace('msat','misi');
			misi=event.element(event).value
			misi2=$Pcs2("#"+mhg).val()
			misi3=$Pcs2("#"+mis).val()
			
			if (mmv==40){
				getNextElement(mmf2).select()
			}

			if (mmv==38){
				getPrevElement(mmf2).select()
			}
			
			if (mmv==27){
			
			parent.cdialog.click();
			mobj=obj.value;
			parent.$Pcs("#"+mobj).focus();
			parent.$Pcs("#"+mobj).select();

			}

			if (mmv==13){

			if (mobj=='looksatbeli')
			{
			parent.tableGrid1.setValueAt(misi,parent.tableGrid1.keys._xCurrentPos,parent.tableGrid1.keys._yCurrentPos);
			parent.tableGrid1.setValueAt(misi2,6,parent.tableGrid1.keys._yCurrentPos);
			parent.tableGrid1.setValueAt(misi3,12,parent.tableGrid1.keys._yCurrentPos);
			parent.focustogrid(4,parent.tableGrid1.keys._yCurrentPos)
			parent.$Pcs2("#kotakdialog2").dialog("close");
			return;
			}

			if (mobj=='looksatreturbeli')
			{
			parent.tableGrid1.setValueAt(misi,parent.tableGrid1.keys._xCurrentPos,parent.tableGrid1.keys._yCurrentPos);
			parent.tableGrid1.setValueAt(misi2,5,parent.tableGrid1.keys._yCurrentPos);
			parent.tableGrid1.setValueAt(misi3,10,parent.tableGrid1.keys._yCurrentPos);
			parent.focustogrid(4,parent.tableGrid1.keys._yCurrentPos)
			parent.$Pcs2("#kotakdialog2").dialog("close");			
			return;
			}

			if (mobj.substr(0,9)=='lookmutag')
			{
			moby=mobj.substr(9,20)
			parent.$Pcs2("#"+moby).val(misi)
			moby2=moby.replace('4_','5_')
			moby3=moby.replace('4_','6_')
			parent.$Pcs2("#"+moby2).val(misi3);
			parent.$Pcs2("#kotakdialog2").dialog("close");			
			parent.$Pcs2("#"+moby3).select();
			return;
			}
			
			}
			
		});

		
	});
	</script>
</head>
<body bgcolor='#285c00' >
<form>
<table border=1 width=50% cellpadding=0 cellspacing=0>
<tr>
<td bgcolor=lightgreen align=center>No.</td>
<td bgcolor=lightgreen align=center>Satuan</td>
<td bgcolor=lightgreen align=center>Harga Beli</td>
<td bgcolor=lightgreen align=center>Isi</td>
</tr>
<?php
require ("utama.php");
$msql="select * from 
(SELECT stoid,satuan1,hrgbeli,isi*isi2 isi FROM setstok union SELECT stoid,satuan2,round(hrgbeli/isi,0),isi2 isi FROM setstok 
union SELECT stoid,satuan3,round(hrgbeli/(isi*isi2),0),1 isi FROM setstok) a where stoid in (select stoid from setstok where stoid='$mstoid') and satuan1<>'' and POSITION(concat(stoid,satuan1) IN '$mdetek')<1"; 

$rww=executerow($msql);
$mnomor=1;
while ($row=mysql_fetch_assoc($rww))
{
echo("<tr>
<td  bgcolor=white align=right>".$mnomor.".</td>
<td  bgcolor=white> <input type='text' value='".$row[satuan1]."' id='msat$mnomor' readonly> </td>
<td  bgcolor=white align=right>".number_format($row[hrgbeli],0,',','.')."<input type=hidden id='mhrg$mnomor' value='".$row[hrgbeli]."'></td>
<td  bgcolor=white  align=right>".$row[isi]."<input type=hidden id='misi$mnomor' value='".$row[isi]."'></td>
</tr>");
$mnomor++;
}
?>
</table>
</form>
</body>
</html>