<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html>
<head>
	<title>SETUP STOK</title>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" type="text/css" href="themes/base/ui.all.css">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.datepicker.js"></script>
	<script type="text/javascript" src="js/ui.dialog.js"></script>
	<script type="text/javascript" src="js/ui.draggable.js"></script>
	<script type="text/javascript" src="js/myfunc.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/format.js"></script>
	<script type="text/javascript" src="js/jScrollPane.min.js"></script>
	<script type="text/javascript">
	var $Pcs2 = jQuery.noConflict();

    $Pcs2(document).ready(function()
	{

	$Pcs2('#mstonama').select();

		ambilstok();

		$Pcs2(document).click(function(){
			document.elements.style.border='2px solid red';
		})
		
		$Pcs2(document).keydown(function(){
			var mmv=event
			mmf2=event.element(event);
			tabOnEnter (mmf2, mmv);
			document.activeElement

			//field.style.border='2px solid grey';
    //document.activeElement.style.border='2px solid red';
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
			
			if (mmv.keyCode==116 && mmf2.id=='msatuan')
			{
				$Pcs2("#looksatuan").click()
			}

			if (mmv.keyCode==117 && mmf2.id=='msatuan')
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

		$Pcs2(document).keyup(function(){
			var mmv=event
			mmf2=event.element(event);

			if (mmf2.id=='misi' || mmf2.id=='misi2' || mmf2.id=='mminimal' || mmf2.id.substr(0,8)=='mhrgbeli' || mmf2.id.substr(0,8)=='mhrgjual')
			{
				maa=tra(Event.element(event).value)
				Event.element(event).value=maa
			}
			
		})

		$Pcs2('#misi').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.focus()
			}
		})

		$Pcs2('#msatid').blur(function(){
		valisat()
		})
		
		$Pcs2('#misi2').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.focus()
			}
		})

		$Pcs2('#btnsaldo').click(function(){
			//$Pcs2("#framehrg").attr('src','setsaldostok.php?mstoid='+$Pcs2("#mstoid").val())
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			dialogisopen=true;		
		})
		
		$Pcs2('#lookgrup').click(function(){

		query1="select rpad(grpid,12,' ') Kode,rpad(grpnama,15,' ') Nama from setgrp "
		query2="where true "

		mcomm=query1+query2

		mordd="grpnama"
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
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		})
		
		$Pcs2('#lookmerk').click(function(){
			xxw=window.open('lookmerk.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=400,height=480,right=200,top=10'));
			xxw.focus();
		})
		
		$Pcs2('#mlooksatuan').click(function(){

		query1="select rpad(satuanid,12,' ') ID,satuan Satuan1,satuan2 Satuan2 from setsatuan where true "
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

		$Pcs2('#looksup').click(function(){
			xxw=window.open('looksup.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=500,height=400,right=200,top=10'));
			xxw.focus();
		})
		
	  $Pcs2('#mgrpid').focus(function(){
	  mmdd=fsetstok.mgrpid.value;
	  if (mmdd=='')
	  {$Pcs2('#lookmerk').click()}
	  })

	  $Pcs2('#msatuan').focus(function(){
	  mmdd=fsetstok.msatuan.value;
	  if (mmdd=='')
	  {$Pcs2('#looksatuan').click()}
	  })
	  
	$Pcs2('#mgrpid').blur(function(){
	valigrup();
	})

	$Pcs2('#msupid').blur(function(){
		valisup();
	})
	
	$Pcs2('#msatuan').blur(function(){
		valisat()		
	})

	  $Pcs2('#bsimpan').click(function(){
			mstonama=fsetstok.mstonama.value;
			malias=fsetstok.malias.value;
			mgrpid=fsetstok.mgrpid.value;
			msatid=fsetstok.msatid.value;
			
			//Ceking valid
			if (mstonama==''){alert('Nama Tidak Boleh Kosong!');fsetstok.mstonama.select();return}
			if (mgrpid==''){alert('Grup Tidak Boleh Kosong!');fsetstok.mgrpid.select();return}
			if (msatid==''){alert('Satuan Tidak Boleh Kosong!');fsetstok.msatid.select();return}
			//
			var conf=window.confirm("Simpan Transaksi ?")
			if (conf==false){return}

			fsetstok.mTransaksixx.value='fsstx001';
			transaksi($Pcs2("form").serialize());			
			//execajax("delete from setstok where stoid='"+mstoid+"'")
			//execajax("insert into setstok(stoid,barcode,barcode2,stonama,grpid,supid,satuan,hrgbeli,hrgjual,hrgjualb,hrgjualc,hrgjual2,hrgjualb2,hrgjualc2,hrgjual3,hrgjualb3,hrgjualc3,isi,isi2) values('"+mstoid+"','"+mbarcode+"','"+mbarcode2+"','"+mstonama+"','"+mgrpid+"','"+msupid+"','"+msatuan+"','"+mhrgbeli+"','"+mhrgjual+"','"+mhrgjualb+"','"+mhrgjualc+"','"+mhrgjual2+"','"+mhrgjualb2+"','"+mhrgjualc2+"','"+mhrgjual3+"','"+mhrgjualb3+"','"+mhrgjualc3+"','"+misi+"','"+misi2+"')")
			fsetstok.mTransaksixx.value='fsstx001';
			transaksi($Pcs2("form").serialize());
			
			execajaxas("delete from setstok where stonama=''")

			if (fsetstok.bsimpan.value=='Simpan'){
			fsetstok.reset();
			fsetstok.mstoid.value='';
			ambilstok();
			fsetstok.mstonama.focus();
			} else {
				$Pcs2('#tutup').click();
			}

	  })

	  $Pcs2('#bhapus').click(function(){
			//Ceking valid
			//
			var conf=window.confirm("Hapus Data ?")
			fsetstok.mTransaksixx.value='fsstx002';
			transaksi($Pcs2("form").serialize());
			var mm=parent.tableGrid1.keys._yCurrentPos;
			parent.$Pcs2("#lookup").dialog('close');
			parent.tableGrid1.request="msql=select a.*,concat(b.satuan,' ',b.satuan2,' ',b.satuan3) ssat from vsetsto a left join setsatuan b on a.satuan=b.satuanid"
			parent.tableGrid1.refresh(0,mm-1,true);
			parent.focus();
		})	
	
	$Pcs2('#tutup').click(function(){
		mmm=parent.document.title
		if (mmm=="Setup Stok")
		{
		mm=parent.tableGrid1.keys._yCurrentPos;
		parent.$Pcs2("#lookup").dialog('close');
		parent.tableGrid1.refresh(0,mm,true);
		parent.focus();
		}

		if (mmm=="Pembelian")
		{
		parent.$Pcs2("#kotakdialog2").dialog('close');
		parent.focus();
		}
		
	})
		
		
	$Pcs2('#mhrgjualb').blur(function(){
		var maa=toval($Pcs2('#mhrgjualb').val());
		var mis1=toval($Pcs2('#misi').val());
		var mis2=toval($Pcs2('#misi2').val());
		var mhas=bulu(maa/mis1);
		var mhas2=bulu(mhas/mis2);		
		$Pcs2('#mhrgjualb2').val(mhas)
		$Pcs2('#mhrgjualb3').val(mhas2)
	})

	$Pcs2('#mhrgjualb2').blur(function(){
		var maa=toval($Pcs2('#mhrgjualb2').val());
		var mis2=toval($Pcs2('#misi2').val());
		var mhas=bulu(maa/mis2);
		$Pcs2('#mhrgjualb3').val(mhas)
	})
	
	$Pcs2('#mhrgjualc').blur(function(){
		var maa=toval($Pcs2('#mhrgjualc').val());
		var mis1=toval($Pcs2('#misi').val());
		var mis2=toval($Pcs2('#misi2').val());
		var mhas=bulu(maa/mis1);
		var mhas2=bulu(mhas/mis2);
		$Pcs2('#mhrgjualc2').val(mhas)
		$Pcs2('#mhrgjualc3').val(mhas2)
	})
	
	$Pcs2('#mhrgjualc2').blur(function(){
		var maa=toval($Pcs2('#mhrgjualc2').val());
		var mis2=toval($Pcs2('#misi2').val());
		var mhas=bulu(maa/mis2);
		$Pcs2('#mhrgjualc3').val(mhas)
	})

   $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 600,
		  close : function(){}
	})	  
	
	
	})

	function ambilstok()
	{
		mvstoid=$Pcs2('#mstoid').val();
		if (mvstoid==''){
		fsetstok.bsimpan.value='Simpan'
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
			fsetstok.mstoid.value=mmstoid;
			$Pcs2('#mstoid').select();
			execajaxas("insert into setstok(stoid,aktif) values('"+mmstoid+"',0)")
			}
		});
		}
		else
		{
		setstok=taptabel("setstok","*","stoid='"+mvstoid+"'");
		fsetstok.bsimpan.value='Edit'
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
		$Pcs2('#mhrgjual4').val(tra(toval(setstok.hrgjual4)));
		$Pcs2('#mminimal').val(tra(toval(setstok.minimal)));
		valigrup();
		valisup();
		valisat();
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
				$Pcs2('#msatid').select();
			}	
	}
	
	function valisat()
	{
		mvsatuanid=$Pcs2('#msatid').val();
		if (mvsatuanid==''){return;}
		data=taptabel("setsatuan","*","satuanid='"+mvsatuanid+"'")
		msatuanid=data.satuanid;
				if (msatuanid==undefined)
					{
						alert('Satuan Tidak Valid !');
						$Pcs2('#msatid').select();
						return;
					}
				else 
					{

						$Pcs2("#msatuan1").val(data.satuan);
						$Pcs2("#msatuan2").val(data.satuan2);
						$Pcs2("#misi").select();

						
					}
	
	}
	</script>
</head>
<?php
require ("utama.php");

$msty="style='font-family:verdana;font-size:12pt;border:1pt'";
$msty2="style='font-family:verdana;font-size:12pt;text-align:right;border:1pt'";
echo("
<body bgcolor=#286c00 onload='$mFoc' name=editstok><font color=white>
<form action=setstok.php method=POST id='fsetstok' style='font-family:arial;font-size:12pt' onsubmit='if (!this.submitted) return false; else return true;'>
<font style='Verdana' size='4pt' color=white>
<table>
<tr><td>Kode Stok  </td><td> : <input type=text size='20' name=mstoid id=mstoid value='$mstoid' maxlength='20' $msty readonly></td></tr>
<tr><td>Nama Stok  </td><td> : <input type=text name=mstonama id=mstonama size=50 maxlength='200' $msty title='Isikan Nama Stok'><input type=hidden name=malias id=malias size=30 maxlength='30' $msty title='Isikan alias nama Stok'></td></tr>
<tr><td>Barcode 1 </td><td> : <input type=text size='20' name=mbarcode id=mbarcode value='$mbarcode' maxlength='20' $msty></td></tr>
<tr><td>Barcode 2 </td><td> : <input type=text size='20' name=mbarcode2 id=mbarcode2 value='$mbarcode2' maxlength='20' $msty></td></tr>
<tr><td>Grup</td><td> : <input type=text id=mgrpid name=mgrpid  size=5><input type=button value='F5' id=lookgrup><input id=mgrpnama disabled></td></tr>
<tr><td>Suplier</td><td> : <input type=text id=msupid name=msupid  size=5><input type=button value='F5' id=looksup><input id=msupnama disabled></td></tr>
</td></tr>
</table>
<br>
<table width=100% border=0 bordercolorlight=blue>
<tr><td align=left width=33%>Kemasan</td><td class='hju' > : <input type=text id=msatid name=msatid size=5><input type=button id=mlooksatuan value='F5'><input type=text id=msatuan1 name=msatuan1 readonly size=5> Isi : <input size=3 maxsize=3 name='misi' id='misi'><input type=text id=msatuan2 name=msatuan2  readonly size=5></td></tr>
<tr><td align=left>Hrg. Beli &nbsp</td> <td  colspan=3> : <input type=text size=10 name='mhrgbeli' id='mhrgbeli' $msty2 colspan=2></td></tr>
<tr><td align=left>Hrg. Jual A&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual' id='mhrgjual' $msty2></td></tr>
<tr><td align=left>Hrg. Jual B&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual2' id='mhrgjual2' $msty2></td></tr>
<tr><td align=left>Hrg. Jual C&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual3' id='mhrgjual3' $msty2></td></tr>
<tr><td align=left>Hrg. Jual d&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual4' id='mhrgjual3' $msty2></td></tr>

<tr><td align=left>Stok Minimal&nbsp;</td><td align=left   class='hju' > : <input type=text size=5 id='mminimal' name='mminimal'   class='hju' $msty2></td><td align=left   class='hju2' ><input type=hidden size=5 id='mminimal2' name='mminimal2' class='hju2' $msty2></td><td align=left><input type=hidden size=5 id='mminimal3' name='mminimal3' class='hju3' $msty2></td></tr>
</table>
<hr><font style='Verdana' size='4pt' color=white>
<<input type=button id='btnsaldo' style='font-color:white' value='Saldo Awal'></input>>
<input id=bsimpan type=button value='Simpan' $msty> <input id=bhapus type=button value='Hapus' $msty2> <input id=tutup type=button value='Tutup' $msty2> 
<input name='mTransaksixx' type=hidden>

	<div id=kotakdialog2>
		<center>
		<tr><td><iframe id=framehrg width=100% height=350 top=30></td></tr>
		</center>
	</div>	

</form>
");


?>


</body>
</html>