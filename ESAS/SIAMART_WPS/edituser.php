<html>
<head>
<title>SETUP user</title>
</head>
<body bgcolor=#286c00 onload='$mFoc' name=editstok style='font-family:Verdana;color:black'>

<?php
require ("utama.php");

$mstok=execute("
select *
from user 
where id='$_GET[mid]'");

$medit='';
if ($mstok[edit]==1)
{$medit='checked';}

?>

<form id='fform'>

<table>
<tr>
	<td><font color=white>Kode user  </td>
	<td> : <input id="lookkarid" type="button" value="F5"> 
	<input type=text size='20' name=mid id=mid value='<?php echo $mstok[id] ?>' maxlength='20' $msty></td>
	
</tr>

<tr>
	<td><font color=white>Nama user  </td>
	<td> : <input type=text name=mnama id=mnama size=50 maxlength='200' value='<?php echo $mstok[nama] ?>' title='Isikan Nama user'></td>
</tr>
<tr>
	<td><font color=white>Password  </td>
	<td> : <input type=text name=mpass id=mpass size=50 maxlength='200' value='<?php echo $mstok[password] ?>' title='Isikan password user'></td>
</tr>
<tr>
	<td><font color=white>Edit/Hapus  </td>
	<td> : <input type=checkbox name=medit id=medit <?php echo $medit ?>></td>
</tr>
</td></tr>
<tr>
	<td><font color=white>Akses Menu  </td>
	<td> :</td>
</tr>
</table>

<div id='backtabel' style='background-image: url(images/backt.png);height:300px;border-color:black;border-style:solid;border-width:1px;overflow-y:scroll'>

<font color=black>
<table border=1 cellpadding=0 cellspacing=0 bgcolor='white' style='border-collapse:collapse' >

<?php

$query="select a.*,b.user
from setmenu a left join menuuser b on a.menuid=b.menuid and user='$_GET[mid]'
order by ids";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
	{
	$mjeda="&nbsp;&nbsp;&nbsp;";
	if ($rows[menupos]=='topmenu')
	{$mjeda='';}
	
	$mck='checked';
	if ($rows[user]=='')
	{$mck='';}	
	
	$mjda=' ';
	
	echo "<tr id='tr_$mnom' class='thetr' ><td>$mnom.</td><input type=hidden value='$rows[menuid]'  id='id_$mnom' ><td hidden>$mjda-$rows[menuid] &nbsp; </td><td>$mjda-$rows[menucapt]&nbsp;</td><td align=center><input type=checkbox id='check_$mnom' $mck onmousemove=garis($mnom)></td></tr>";
	$mnom++;
	}
?>
</table>
</font>
</div>

<hr><font style='Verdana' size='4pt' color=white>
<input id=bsimpan type=button value='Simpan' $msty> <input id=bhapus type=button value='Hapus' $msty2> <input id=tutup type=button value='Tutup' $msty2> 
<input id=aksesall type=button value='Akses Semua Menu' $msty2> 
<input id=noaksesall type=button value='Lepas Semua Akses' $msty2> 
<div id="kotakdialog2" title="Setup Pelanggan">
		<center><iframe id="framehrg" height="450" width="100%"></iframe>
		</center></div>
</form>



<link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function(){

execajaxas("alter table user add edit numeric(1) default 0")

var lan='<?php echo $mstok[userlantai] ?>'
$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 800,
});
$Pcs2("#setper").css(
{
	'width': mws-665+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
});
	
$Pcs2('#mlantai').val(lan)

///
if ($Pcs2('#mid').val()!='')
{
$Pcs2('#mnama').select();
}
else
{
$Pcs2('#mid').select();
}
///
$Pcs2(document).keydown(function(){
	var mmv=event
	mmf2=event.element(event);
	tabOnEnter (mmf2, mmv);
	document.activeElement

	if (mmv.keyCode==27)
	{
		$Pcs2('#tutup').click();			
	}
	
	if (mmv.keyCode==117 && mmf2.id=='mgrpid')
	{
		xxw=window.open('setgrp.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=450,height=400,right=200,top=10'));
		xxw.focus();
	}
	
	
})

///		
$Pcs2(document).keyup(function(){
	var mmv=event
	mmf2=event.element(event);
	if (mmf2.id=='misi' || mmf2.id=='misi2' || mmf2.id=='mminimal' || mmf2.id.substr(0,8)=='mhrgbeli' || mmf2.id.substr(0,8)=='mhrgjual')
	{
		maa=tra(Event.element(event).value)
		Event.element(event).value=maa
	}
	
})

$Pcs2('#aksesall').click(function(){
for (hj=1;hj<100;hj++)
{
	$Pcs2("#check_"+hj).attr("checked",true)
}	
})

$Pcs2('#noaksesall').click(function(){
for (hj=1;hj<100;hj++)
{
	$Pcs2("#check_"+hj).attr("checked",false)
}	
})

$Pcs2("#mid").blur(function()
    {
        datas=taptabel("setkaryawan","karid,karnama","karid='"+this.value+"'")
        // $Pcs2("#mkarid").val("")
        // $Pcs2("#mkarnama").val("")
        if (datas.karid!=undefined)
        {
            $Pcs2("#mid").val(datas.karid)
            $Pcs2("#mnama").val(datas.karnama)
        }
    })

$Pcs2("#lookkarid").click(function()
    {
        mcomm="Select rpad(karid,12,' ') Kode, left(karnama,50) Nama from setkaryawan where true"
        mordd="Kode"
        mffff=" concat(karid,karnama) "
        
        $Pcs2("#framehrg").attr('src','genlookup.php?mobj=mid')
        $Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
        $Pcs2("#kotakdialog2").dialog('open');
        $Pcs2("#kotakdialog2").click();
        $Pcs2("#framehrg").contentWindow.focus();
    })


    $Pcs2('#bsimpan').click(function(){

	mid=fform.mid.value;
			
			//Ceking valid
			if (mid==''){alert('Kode Tidak Boleh Kosong!');fform.mid.select();return}
			//
			mnama=fform.mnama.value;
			//Ceking valid
			if (mnama==''){alert('Nama Tidak Boleh Kosong!');fform.mnama.select();return}
			//

			var conf=window.confirm("Simpan Transaksi ?")
			if (conf==false){return}
			medd=0
			if ($Pcs2("#medit").attr('checked'))
			{medd=1}
			execajaxas("delete from user where id='"+$Pcs2("#mid").val()+"'")
			execajaxas("delete from menuuser where user='"+$Pcs2("#mid").val()+"'")
			execajaxa("insert into user(id,nama,password,edit) values('"+$Pcs2("#mid").val()+"','"+$Pcs2("#mnama").val()+"','"+$Pcs2("#mpass").val()+"','"+medd+"')")

		for (hj=1;hj<100;hj++)
		{
			abc=$Pcs2("#check_"+hj).attr("checked")
			if ($Pcs2("#id_"+hj).val()==undefined){break;}

			if (abc)
			{
			execajaxa("insert into menuuser(user,menuid) values('"+$Pcs2("#mid").val()+"','"+$Pcs2("#id_"+hj).val()+"')")
			}
		}	

			$Pcs2('#tutup').click();

	})

	  $Pcs2('#bhapus').click(function(){
			mid=fform.mid.value;

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}

			execajaxas("delete from user where id='"+$Pcs2("#mid").val()+"'")

			$Pcs2('#tutup').click();
		})	
	
	$Pcs2('#tutup').click(function(){
		parent.$Pcs2("#lookup").dialog('close');
		parent.focus();
	})
	
})
///
	function garis(thee)
	{
		$Pcs2(".thetr").css("background-color","white")
		$Pcs2("#tr_"+thee).css("background-color","yellow")
	}

///
</script>

</body>
</html>