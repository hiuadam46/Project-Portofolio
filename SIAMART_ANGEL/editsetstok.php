<html>
<head>
<title>SETUP STOK</title>
</head>
<body bgcolor=#286c00 onload='$mFoc' name=editstok style='font-family:Verdana;color:white'>

<?php
require ("utama.php");


$mstok=execute("
select a.*,b.grpnama,c.supnama 
from setstok a 
left join setgrp b on a.grpid=b.grpid
left join setsup c on a.supid=c.supid
where stoid='$_GET[mstoid]'");

$mmstoid=$mstok[stoid];
$mbarr=$mstok[barcode3];
$meed='Edit';

$mtra=execute("select nid from bkbesar where bpid='$_GET[mstoid]' and rekid='10310' limit 0,1");
$mdisall='';
if ($mtra[nid]!='')
{$mdisall='';}

if ($mmstoid=='')
{
$meed='Simpan';

$mstokx=execute("
select concat('B',lpad(convert(substring(stoid,2,5),signed)+1,5,'0')) nid
from setstok order by nid desc limit 0,1");

if ($mstokx[nid]=='')
{$mmstoid='B00001';}
else
{
$mmstoid=$mstokx[nid];
}
$mbarr=str_replace("B","",$mmstoid);

}
/*<tr><td>Nama Alias  </td><td> : <input type=text name=malias id=malias size=50 maxlength='200' value='<?php echo $mstok[alias] ?>' title='Isikan Nama Alias Stok'></td></tr>*/

?>

<form id='fform'>

<table>
<tr><td>Kode Stok  </td><td> : <input type=text size='20' name=mstoid id=mstoid value='<?php echo $mmstoid; ?>' maxlength='20' $msty readonly></td></tr>
<tr><td>Nama Stok  </td><td> : <input type=text name=mstonama id=mstonama size=50 maxlength='200' value='<?php echo $mstok[stonama] ?>' title='Isikan Nama Stok'></td></tr>
<!-- <tr><td>Barcode 1 </td><td> : <input type=text size='20' name=mbarcode id=mbarcode value='<?php echo $mbarr ?>' maxlength='20' $msty></td></tr>
<tr><td>Barcode 2 </td><td> : <input type=text size='20' name=mbarcode2 id=mbarcode2 value='<?php echo $mstok[barcode2] ?>' maxlength='20' $msty></td></tr> -->
<tr><td>Grup</td><td> : <input type=text id=mgrpid name=mgrpid  value='<?php echo $mstok[grpid] ?>' size=10><input type=button value='F5' id=lookgrup><input id=mgrpnama value='<?php echo $mstok[grpnama] ?>' disabled></td></tr>
<tr><td>Suplier</td><td> : <input type=text id=msupid name=msupid  size=10 value='<?php echo $mstok[supid] ?>'><input type=button value='F5' id=looksup><input id=msupnama value='<?php echo $mstok[supnama] ?>' disabled></td></tr>
</td></tr>
</table>

<br>
<table width=100% border=0 bordercolorlight=blue>
<!-- <tr><td align=left width=23%>Kemasan</td><td class='hju' > : <input type=text id=msatid name=msatid size=5 value='<?php echo $mstok[satuan] ?>'><input type=button id=mlooksatuan value='F5'><input type=text id=msatuan1 name=msatuan1 disabled size=5 value='<?php echo $mstok[satuan1] ?>'> Isi : <input size=5 maxsize=5 name='misi' id='misi' value='<?php echo $mstok[isi] ?>' <?php echo $mdisall ?> ><input type=text id=msatuan2 name=msatuan2  size=5 value='<?php echo $mstok[satuan2] ?>' disabled></td></tr> -->
<!-- HARGA BELI -->
<tr><td align=left>Hrg. Beli &nbsp</td> <td  colspan=3> : <input type=text size=10 name='mhrgbeli' id='mhrgbeli' $msty2 value='<?php echo number_format($mstok[hrgbeli],0,'.',',') ?>' style='text-align:right'></td></tr>
<!-- GOLONGAN -->
<tr><td align=left>Harga Jual&nbsp</td> <td colspan=3> : <input type=text size=10  $msty2  value='A' style='text-align:center'readonly disabled>&nbsp<input type=text size=10  $msty2  value='B' style='text-align:center' readonly disabled>&nbsp&nbsp<input type=text size="16"  $msty2  value='Kemasan' style='text-align:center' readonly disabled>&nbsp<input type=text size="5"  $msty2  value='Isi' style='text-align:center' readonly disabled>&nbsp&nbsp<input type=text size="10"  $msty2  value='Barcode' style='text-align:center' readonly disabled></td></tr>
<!-- HRG JUAL -->
<tr><td align=right>Harga 1</td> <td colspan=3> : <input type=text size=10 name='mhrgjual' id='mhrgjual' $msty2  value='<?php echo number_format($mstok[hrgjual],0,'.',',') ?>' style='text-align:right'>&nbsp<input type=text size=10 name='mhrgjualb' id='mhrgjualb' $msty2  value='<?php echo number_format($mstok[hrgjualb],0,'.',',') ?>' style='text-align:right'>
<!-- ISI 1 -->
&nbsp<input type=text id=msatid name=msatid size=3 value='<?php echo $mstok[satuan] ?>'><input type=button id=mlooksatuan value='F5'><input type=text id=msatuan1 name=msatuan1 disabled size=5 value='<?php echo $mstok[satuan1] ?>'> <input size=5 maxsize=5 name='misi' id='misi' value='<?php echo $mstok[isi] ?>' <?php echo $mdisall ?> ><input type=text id=msatuan2 name=msatuan2  size=5 value='<?php echo $mstok[satuan2] ?>' disabled hidden >
&nbsp<input type=text size=10 name='mbarcode' id='mbarcode' $msty2 value='<?php echo $mstok[barcode] ?>' style='text-align:right'></td></tr>
<tr><td align=right>Harga 2</td> <td colspan=3> : <input type=text size=10 name='mhrgjual2' id='mhrgjual2' $msty2  value='<?php echo number_format($mstok[hrgjual2],0,'.',',') ?>'  style='text-align:right'>&nbsp<input type=text size=10 name='mhrgjualb2' id='mhrgjualb2' $msty2  value='<?php echo number_format($mstok[hrgjualb2],0,'.',',') ?>'  style='text-align:right'>
<!-- ISI 2 -->
&nbsp<input type=text id=msatidb name=msatidb size=3 value='<?php echo $mstok[satuanb] ?>'><input type=button id=mlooksatuanb value='F5'><input type=text id=msatuanb1 name=msatuanb1 disabled size=5 value='<?php echo $mstok[satuanb1] ?>'> <input size=5 maxsize=5 name='misib' id='misib' value='<?php echo $mstok[isi2] ?>' <?php echo $mdisall ?> ><input type=text id=msatuanb2 name=msatuanb2  size=5 value='<?php echo $mstok[satuanb2] ?>' disabled hidden >
&nbsp<input type=text size=10 name='mbarcode2' id='mbarcode2' $msty2 value='<?php echo $mstok[barcode2] ?>' style='text-align:right'></td></tr>
<tr><td align=right>Harga 3</td> <td colspan=3> : <input type=text size=10 name='mhrgjual3' id='mhrgjual3' $msty2  value='<?php echo number_format($mstok[hrgjual3],0,'.',',') ?>'  style='text-align:right'>&nbsp<input type=text size=10 name='mhrgjualb3' id='mhrgjualb3' $msty2  value='<?php echo number_format($mstok[hrgjualb3],0,'.',',') ?>'  style='text-align:right'>
<!-- ISI 3 -->
&nbsp<input type=text id=msatidc name=msatidc size=3 value='<?php echo $mstok[satuanc] ?>'><input type=button id=mlooksatuanc value='F5'><input type=text id=msatuanc1 name=msatuanc1 disabled size=5 value='<?php echo $mstok[satuanc1] ?>'> <input size=5 maxsize=5 name='misic' id='misic' value='<?php echo $mstok[isi3] ?>' <?php echo $mdisall ?> ><input type=text id=msatuanc2 name=msatuanc2  size=5 value='<?php echo $mstok[satuanc2] ?>' disabled hidden >
&nbsp<input type=text size=10 name='mbarcode3' id='mbarcode3' $msty2 value='<?php echo $mbarr ?>' style='text-align:right'></td></tr>
<tr><td align=left>Stok Minimal&nbsp;</td><td align=left   class='hju' > : <input type=text size=5 id='mminimal' name='mminimal'   class='hju' $msty2  value='<?php echo number_format($mstok[minimal],0,'.',',') ?>'  style='text-align:right'></td>
</table>
<hr><font style='Verdana' size='4pt' color=white>
<input id=bsimpan type=button value='<?php echo $meed; ?>' $msty> <input id=bhapus type=button value='Hapus' $msty2> <input id=tutup type=button value='Tutup' $msty2> 
<<input type=button id='btnsaldo' style='font-color:white' value='Saldo Awal'></input>>

	<div id='kotakdialog2'>
		<center>
		<iframe id=framehrg width=100% height=350 top=30></iframe>
		</center>
	</div>	

</form>


<link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var mobjx='<?php echo $mobj; ?>'

$Pcs2(document).ready(function(){

///
$Pcs2('#mstonama').select();

///
$Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 730,

	close : function(){
	dialogisopen=false;
	},

	open : function(){
	dialogisopen=true;
	},
})

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
			
			if (mmv.keyCode==116 && mmf2.id=='mgrpid')
			{
				$Pcs2("#lookgrup").click()
			}

			if (mmv.keyCode==116 && mmf2.id=='mgrpid')
			{
				$Pcs2("#lookmerk").click()
			}
			
			if (mmv.keyCode==117 && mmf2.id=='mgrpid')
			{
				xxw=window.open('setgrp.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=450,height=400,right=200,top=10'));
				xxw.focus();
			}
			
			if (mmv.keyCode==116 && mmf2.id=='msatuan' || mmf2.id=='msatuanb' || mmf2.id=='msatuancb')
			{
				$Pcs2("#looksatuan").click()
			}

			if (mmv.keyCode==117 && mmf2.id=='msatuan' || mmf2.id=='msatuanb' || mmf2.id=='msatuanc')
			{
				xxw=window.open('setsatuan2.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=400,height=400,right=200,top=10'));
				xxw.focus();
			}

			if (mmv.keyCode==116 && mmf2.id=='msupid')
			{
				$Pcs2("#looksup").click()
			}

			if (mmv.keyCode==117 && mmf2.id=='msupid')
			{
				xxw=window.open('setsup.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=400,height=400,right=200,top=10'));
				xxw.focus();
			}
			
		})

///		
		$Pcs2(document).keyup(function(){
			var mmv=event
			mmf2=event.element(event);
			if (mmf2.id=='misi' || mmf2.id=='misi2' || mmf2.id=='misib'  || mmf2.id=='mminimal' || mmf2.id.substr(0,8)=='mhrgbeli' || mmf2.id.substr(0,8)=='mhrgjual')
			{
				maa=tra(Event.element(event).value)
				Event.element(event).value=maa
			}
			
		})

///	
		$Pcs2('#misi').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mstonama').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mgrpid').blur(function(){
		valigrup()
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#lookgrup').click()
			}
		})

		
		$Pcs2('#msatid').blur(function(){
		valisat('a')
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#mlooksatuan').click()
			}

		})

		$Pcs2('#msatidb').blur(function(){
		valisat('b')
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#mlooksatuanb').click()
			}

		})

		$Pcs2('#msatidc').blur(function(){
		valisat('c')
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#mlooksatuanc').click()
			}

		})

		$Pcs2('#mhrgbeli').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mhrgjual3').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mbarcode').blur(function(){
			if (this.value!='' && this.value==$Pcs2('#mbarcode2').val())
			{
				alert("Barcode 1 dan 2 Tidak Boleh Sama !")
				this.select()
				this.value=''
				return;
			}
			tpt=taptabel("setstok","stoid,stonama","barcode='"+this.value+"' or barcode2='"+this.value+"' and stoid<>'"+$Pcs2('#mstoid').val()+"'")
			if (this.value!='' && $Pcs2('#mstoid').val()!=tpt.stoid && tpt.stonama!=undefined)
			{
				alert("Barcode  "+this.value+"  sudah dipakai di Stok "+tpt.stonama)
				this.select()
				this.value=''
				return;
			}
		})

		$Pcs2('#mbarcode2').blur(function(){
			if (this.value!='' && this.value==$Pcs2('#mbarcode').val())
			{
				alert("Barcode 1 dan 2 Tidak Boleh Sama !")
				this.select()
				this.value=''
				return;
			}
			tpt=taptabel("setstok","stonama","barcode='"+this.value+"' or barcode2='"+this.value+"'  and stoid<>'"+$Pcs2('#mstoid').val()+"' ")
			if (this.value!=''  && $Pcs2('#mstoid').val()!=tpt.stoid  && tpt.stonama!=undefined)
			{
			alert("Barcode "+this.value+" sudah dipakai di Stok "+tpt.stonama)
			this.select()
			this.value=''
			return;
			}
		})

		$Pcs2('#btnsaldo').click(function(){
			$Pcs2("#framehrg").attr('src','setsaldostok.php?mstoid='+$Pcs2("#mstoid").val())
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			dialogisopen=true;		
		})
		
		$Pcs2('#lookgrup').click(function(){
		
		query1="select rpad(grpid,12,' ') Kode,rpad(grpnama,15,' ') Nama from setgrp "
		query2="where true "

		mcomm=query1+query2

		mordd="grpid"
		mffff=" concat(grpnama) "
		mmid='mgrpid'

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		})

		$Pcs2('#looksup').click(function(){

		query1="select rpad(supid,12,' ') Kode,supnama Nama from setsup "
		query2="where true "

		mcomm=query1+query2

		mordd="supid"
		mffff=" concat(supnama) "
		mmid='msupid'

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		})
		
		$Pcs2('#lookmerk').click(function(){
			xxw=window.open('lookmerk.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=400,height=480,right=200,top=10'));
			xxw.focus();
		})
		
		$Pcs2('#mlooksatuan').click(function(){

		query1="select rpad(satuanid,12,' ') ID,satuan Satuan1 from setsatuan where true "
		query2=""
		mcomm=query1+query2

		mordd="satuanid"
		mffff=" concat(satuan,satuan2) "
		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msatid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Satuan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		$Pcs2("#framehrg").tcari.focus();	

		})
		

		$Pcs2('#mlooksatuanb').click(function(){

		query1="select rpad(satuanid,12,' ') ID,satuan Satuan1 from setsatuan where true "
		query2=""
		mcomm=query1+query2

		mordd="satuanid"
		mffff=" concat(satuan,satuan2) "
		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msatidb')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Satuan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		$Pcs2("#framehrg").tcari.focus();	

		})

		$Pcs2('#mlooksatuanc').click(function(){

		query1="select rpad(satuanid,12,' ') ID,satuan Satuan1 from setsatuan where true "
		query2=""
		mcomm=query1+query2

		mordd="satuanid"
		mffff=" concat(satuan,satuan2) "
		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msatidc')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Satuan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		$Pcs2("#framehrg").tcari.focus();	

		})

		$Pcs2('#looksup').click(function(){
			xxw=window.open('looksup.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=500,height=400,right=200,top=10'));
			xxw.focus();
		})
		
	  $Pcs2('#mgrpid').focus(function(){
	  mmdd=fform.mgrpid.value;
	  if (mmdd=='')
	  {$Pcs2('#lookmerk').click()}
	  })

	  $Pcs2('#msatuan').focus(function(){
	  mmdd=fform.msatuan.value;
	  if (mmdd=='')
	  {$Pcs2('#looksatuan').click()}
	  })
	  
	$Pcs2('#msupid').blur(function(){
		valisup();
	})
	
    $Pcs2('#bsimpan').click(function(){
			mstonama=fform.mstonama.value;
			//malias=fform.malias.value;
			mgrpid=fform.mgrpid.value;
			msatid=fform.msatid.value;
			misi=fform.misi.value;
			$Pcs2('#msatuan1').attr('disabled',false)
			$Pcs2('#msatuan2').attr('disabled',false)
			$Pcs2('#msatuanb1').attr('disabled',false)
			$Pcs2('#msatuanb2').attr('disabled',false)
			$Pcs2('#msatuanc1').attr('disabled',false)
			$Pcs2('#msatuanc2').attr('disabled',false)
			
			//$Pcs2("#mstonama").css("background-color","white")
			//$Pcs2("#mgrpid").css("background-color","white")
			//$Pcs2("#msatid").css("background-color","white")
			//$Pcs2("#misi").css("background-color","white")
			
			//$msimpan=true;
			
			//Ceking valid
			//if (mstonama==''){$Pcs2("#mstonama").css("background-color","pink");$msimpan=false;}
			//if (msatid==''){$Pcs2("#msatid").css("background-color","pink");$msimpan=false;}
			//if (misi==''){$Pcs2("#misi").css("background-color","pink");$msimpan=false;}

			//if (mgrpid==''){alert('Grup Tidak Boleh Kosong!');fform.mgrpid.select();return}
			//if (msatid==''){alert('Satuan Tidak Boleh Kosong!');fform.msatid.select();return}
			//if (misi==''){alert('Satuan Tidak Boleh Kosong!');fform.misi.select();return}
			//if ($msimpan==false)
			//{
			//alert("Tidak Bisa Disimpan ! ada fields yang kosong !");return;
			//}
			//
			var conf=window.confirm("Simpan Transaksi ?")
			if (conf==false){return}

			transaksi($Pcs2("form").serialize()+"&mTransaksixx=fsstx001");			
			
			execajaxas("delete from setstok where stonama=''")

			if (parent.document.title=='Pembelian')
			{
			parent.$Pcs2("#"+mobjx).val(fform.mstoid.value)
			parent.$Pcs2("#"+mobjx).select()
			parent.$Pcs2("#kotakdialog2").dialog('close');
			parent.$Pcs2("#"+mobjx).blur()
			return;
			}
			if (this.value=='Simpan')
			{		
			document.location='editsetstok.php?mstoid=aaaxxx'
			parent.ambildata()
			}
			else
			{
			$Pcs2('#tutup').click();
			}
			//document.location.reload()
						

	})

	  $Pcs2('#bhapus').click(function(){
			//Ceking valid
			//
			var conf=window.confirm("Hapus Data ?")

			transaksi($Pcs2("form").serialize()+"&mTransaksixx=fsstx002");			

			$Pcs2('#tutup').click();
		})	
	
	$Pcs2('#tutup').click(function(){
		//mmm=parent.document.title
		//if (mmm=="Setup Stok")
		//{
		//mm=parent.tableGrid1.keys._yCurrentPos;
		parent.$Pcs2("#lookup").dialog('close');
		//parent.tableGrid1.refresh(0,mm,true);
		parent.focus();
		//}

		//if (mmm=="Pembelian")
		//{
		//parent.$Pcs2("#kotakdialog2").dialog('close');
		//parent.focus();
		//}
		
	})
	
})

///
	function ambilstok()
	{
		mvstoid=$Pcs2('#mstoid').val();
		if (mvstoid==''){
		fform.bsimpan.value='Simpan'
		$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=stoid&tabel=setstok&kondisi=(1=1)  order by stoid desc limit 1",
			dataType:'json',
			success: function(data){
			mmstoid=data.stoid;
			//alert(data);
			if (mmstoid!=undefined)
			{
			//alert(msatuanid);
			mmstoid=mmstoid.substr(1,15)
			mmstoid=parseFloat(mmstoid);
			//alert(msatuanid);
			mmstoid=mmstoid+1;
			mmstoid=''+mmstoid
			mmstoid='B'+padl(mmstoid,'0',5);
			}
			else
			{
			mmstoid='B00001';
			}
			fform.mstoid.value=mmstoid;
			$Pcs2('#mstoid').select();
			execajaxas("insert into setstok(stoid,aktif) values('+mmstoid+',0)")
			}
		});
		}
		else
		{
		setstok=taptabel("setstok","*","stoid='"+mvstoid+"'");
		fform.bsimpan.value='Edit'
		$Pcs2('#mstonama').val(setstok.stonama);
		$Pcs2('#mbarcode').val(setstok.barcode);
		$Pcs2('#mbarcode2').val(setstok.barcode2);
		$Pcs2('#msatid').val(setstok.satuan);
		$Pcs2('#mgrpid').val(setstok.grpid);
		$Pcs2('#msupid').val(setstok.supid);
		$Pcs2('#msatuan').val(setstok.satuan);
		$Pcs2('#misi').val(setstok.isi);
		$Pcs2('#misi2').val(setstok.isi2);				
		$Pcs2('#mhrgbeli').val(tra(toval(setstok.hrgbeli)));
		$Pcs2('#mhrgjual').val(tra(toval(setstok.hrgjual)));
		$Pcs2('#mhrgjual2').val(tra(toval(setstok.hrgjual2)));
		$Pcs2('#mhrgjual3').val(tra(toval(setstok.hrgjual3)));
		$Pcs2('#mminimal').val(tra(toval(setstok.minimal)));
		valigrup();
		valisup();
		// alert(mvstoid)
		valisat('a');
		valisat('b');
		valisat('c');
		$Pcs2('#mstoid').attr('readonly','true')
		$Pcs2('#mstonama').select();
		
		saldo=taptabel("bkbesar","qtyin","bpid='"+mvstoid+"' and trans='SA'");
		
		if (saldo.qtyin!=undefined)
		{
		msd=saldo.qtyin;
		mi1=setstok.isi;
		mi2=setstok.isi2;
		mss1=parseInt(msd/(mi1*mi2),0);

		if (mi1==1){mss1=0;}

		mp1=(msd-(mss1*mi1*mi2));

		$Pcs2('#msaldo1').val(mss1);
		$Pcs2('#msaldo2').val(mp1);
		//$Pcs2('#msaldo3').val(mss3);
		}
		
		}
	}
	
	function valigrup()
	{
		mvgrpid=$Pcs2('#mgrpid').val();

		if (mvgrpid==''){$Pcs2("#mmerknama").val("");return;}
		setgrp=taptabel("setgrp","*","grpid='"+mvgrpid+"'")
		if (!setgrp)
			{
				alert('Grup Tidak Valid !');
				$Pcs2('#mgrpid').select();
				return;
			}
			else 
			{
				$Pcs2("#mgrpid").val(setgrp.grpid);
				$Pcs2("#mmerknama").val(" "+setgrp.merknama+" ");
				setgrup=taptabel("setgrp","grpid,grpnama,supid","grpid='"+setgrp.grpid+"'")
				$Pcs2("#mgrpid").val(setgrup.grpid);
				$Pcs2("#mgrpnama").val(setgrup.grpnama);
				$Pcs2("#msupid").select();
			}	
	}

	function valisup()
	{
		mvsupid=$Pcs2('#msupid').val();
		if (mvsupid==''){$Pcs2("#msupnama").val("");return;}
		setsup=taptabel("setsup","supnama","supid='"+mvsupid+"'")
		if (!setsup)
			{
				alert('Suplier Tidak Valid !');
				$Pcs2('#msupid').select();
				return;
			}
			else 
			{
				$Pcs2("#msupid").val(setsup.supid);
				$Pcs2("#msupnama").val(" "+setsup.supnama+" ");
				$Pcs2('#mhrgbeli').select();
			}	
	}
	
	function valisat(input)
	{

		if(input == 'a'){
			mvsatuanid=$Pcs2('#msatid').val();
		}else if(input =='b'){
			mvsatuanid=$Pcs2('#msatidb').val();
		}else if(input =='c'){
			mvsatuanid=$Pcs2('#msatidc').val();
		}
		if (mvsatuanid==''){return;}
		data=taptabel("setsatuan","*","satuanid='"+mvsatuanid+"'")
		msatuanid=data.satuanid;
				if (msatuanid==undefined)
					{
						alert('Satuan Tidak Valid !');
						if(input == 'a'){
							$Pcs2('#msatid').select();
						}else if(input =='b'){
							$Pcs2('#msatidb').select();
						}else if(input =='c'){
							$Pcs2('#msatidc').select();
						}
						return;
					}
				else 
					{
						if(input == 'a'){
							$Pcs2("#msatuan1").val(data.satuan);
							$Pcs2("#msatuan2").val(data.satuan2);
							$Pcs2("#misi").select();
						}else if(input =='b'){
							$Pcs2("#msatuanb1").val(data.satuan);
							$Pcs2("#msatuanb2").val(data.satuan2);
							$Pcs2("#misib").select();
						}else if(input =='c'){
							$Pcs2("#msatuanc1").val(data.satuan);
							$Pcs2("#msatuanc2").val(data.satuan2);
							$Pcs2("#misic").select();
						}
	
					}
	
	}

///
</script>

</body>
</html>