<html>

<head>
<title>SETUP STOK</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
</head>

<body name="editstok" onload="$mFoc" style="font-family: Verdana; color: white; background-color: #286C00">

<?php
require ("utama.php");

$query19=executerow("
select a.*, b.grpnama, c.supnama
from setstok a
left join setgrp b on a.grpid=b.grpid
left join setsup c on a.supid=c.supid
where stoid='$_GET[mstoid]'
");
$mstok=mysql_fetch_assoc ($query19);

$mmstoid=$mstok[stoid];
$mbarr=$mstok[barcode];
$meed='Edit';

if ($mmstoid=='')
{
	$meed='Simpan';

	$query33=executerow("
	select concat('B', lpad(convert(substring(stoid, 2, 5), signed)+1, 5, '0')) nid
	from setstok
	order by nid desc limit 0, 1
	");
	$mstokx=mysql_fetch_assoc ($query33);
	
	if ($mstokx[nid]=='')
	{
		$mmstoid='B00001';
	}
	else
	{
		$mmstoid=$mstokx[nid];
	}
	$mbarr=str_replace("B","",$mmstoid);
}
?>
<form id="fform">
	<table>
		<tr>
			<td>Kode Stok </td>
			<td>:
			<input id="mstoid" maxlength="20" name="mstoid" readonly size="20" type="text" value="<?php echo $mmstoid; ?>"></td>
		</tr>
		<tr>
			<td>Barcode 1 </td>
			<td>:
			<input id="mbarcode" maxlength="20" name="mbarcode" size="20" type="text" value="<?php echo $mbarr ?>"></td>
		</tr>
		<tr>
			<td>Nama Stok </td>
			<td>:
			<input id="mstonama" maxlength="200" name="mstonama" size="50" title="Isikan Nama Stok" type="text" value="<?php echo $mstok[stonama] ?>"></td>
		</tr>
		<tr>
			<td>Grup</td>
			<td>:
			<input id="mgrpid" name="mgrpid" size="10" type="text" value="<?php echo $mstok[grpid] ?>"><input id="lookgrup" type="button" value="F5"><input id="mgrpnama" disabled value="<?php echo $mstok[grpnama] ?>"></td>
		</tr>
		<tr>
			<td>Suplier</td>
			<td>:
			<input id="msupid" name="msupid" size="10" type="text" value="<?php echo $mstok[supid] ?>"><input id="looksup" type="button" value="F5"><input id="msupnama" disabled value="<?php echo $mstok[supnama] ?>"></td>
		</tr>
	</table>
	<br>
	<table border="0" style="border-color: aqua" width="100%">
		<tr>
			<td align="left" style="width: 23%">Kemasan</td>
			<td class="hju">:
			<input id="msatid" name="msatid" size="5" type="text" value="<?php echo $mstok[satuan] ?>"><input id="mlooksatuan" type="button" value="F5"><input id="msatuan1" disabled name="msatuan1" size="5" type="text" value="<?php echo $mstok[satuan1] ?>"> 
			Isi :
			<input id="misi" name="misi" size="3" style="max-width: 30px" value="<?php echo $mstok[isi] ?>"><input id="msatuan2" disabled name="msatuan2" size="5" type="text" value="<?php echo $mstok[satuan2] ?>"></td>
		</tr>
		<tr>
			<td align="left">Hrg. Beli&nbsp; </td>
			<td colspan="3">:
			<input id="mhrgbeli" name="mhrgbeli" size="10" style="text-align: right" type="text" value="<?php echo number_format($mstok[hrgbeli],0,'.',',') ?>"></td>
		</tr>
		<tr>
			<td align="left">Hrg. Jual Spesial </td>
			<td colspan="3">:
			<input id="mhrgjual" name="mhrgjual" size="10" style="text-align: right" type="text" value="<?php echo number_format($mstok[hrgjual],0,'.',',') ?>"></td>
		</tr>
		<tr>
			<td align="left">Hrg. Jual Grosir </td>
			<td colspan="3">:
			<input id="mhrgjual2" name="mhrgjual2" size="10" style="text-align: right" type="text" value="<?php echo number_format($mstok[hrgjual2],0,'.',',') ?>"></td>
		</tr>
		<tr>
			<td align="left">Hrg. Jual Ecer </td>
			<td colspan="3">:
			<input id="mhrgjual3" name="mhrgjual3" size="10" style="text-align: right" type="text" value="<?php echo number_format($mstok[hrgjual3],0,'.',',') ?>"></td>
		</tr>
		<tr>
			<td align="left">Hrg. Bandrol </td>
			<td colspan="3">:
			<input id="mhrgjual4" name="mhrgjual4" size="10" style="text-align: right" type="text" value="<?php echo number_format($mstok[hrgjual4],0,'.',',') ?>"></td>
		</tr>
		<tr>
			<td align="left">Stok Minimal </td>
			<td align="left" class="hju">:
			<input id="mminimal" class="hju" name="mminimal" size="5" style="text-align: right" type="text" value="<?php echo number_format($mstok[minimal],0,'.',',') ?>"></td>
		</tr>
	</table>
	<hr><input id="bsimpan" type="button" value="<?php echo $meed; ?>">
	<input id="bhapus" type="button" value="Hapus">
	<input id="tutup" type="button" value="Tutup"> &lt;<input id="btnsaldo" style="color: black" type="button" value="Saldo Awal">&gt;
	<div id="kotakdialog2" style="color: white; font-size: 4pt; font-family: Verdana">
		<center>
		<iframe id="framehrg" height="350" style="top: 30px" width="100%">
		</iframe></center></div>
</form>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var mobj='<?php echo $mobj; ?>'
$Pcs2(document).ready(function()
{
	$Pcs2('#msupid').val(parent.$Pcs2('#msupid').val());
	valisup()
	if (parent.$Pcs2('#msupid').val()!='')
	{
		$Pcs2('#msupid').attr('disabled',true)
	}
	///
	$Pcs2('#mstonama').select();

	///
	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		dragable: true,
		width : 730,

		close : function()
		{
			dialogisopen=false;
		},

		open : function()
		{
			dialogisopen=true;
		},
	})

	///
	$Pcs2(document).keydown(function()
	{
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
			xxw=window.open('setgrp.php', 'aa', ('alwaysraised=yes, scrollbars=no, resizable=no, width=450, height=400, right=200, top=10'));
			xxw.focus();
		}

		if (mmv.keyCode==116 && mmf2.id=='msatuan')
		{
			$Pcs2("#looksatuan").click()
		}

		if (mmv.keyCode==117 && mmf2.id=='msatuan')
		{
			xxw=window.open('setsatuan2.php', 'aa', ('alwaysraised=yes, scrollbars=no, resizable=no, width=400, height=400, right=200, top=10'));
			xxw.focus();
		}

		if (mmv.keyCode==116 && mmf2.id=='msupid')
		{
			$Pcs2("#looksup").click()
		}

		if (mmv.keyCode==117 && mmf2.id=='msupid')
		{
			xxw=window.open('setsup.php', 'aa', ('alwaysraised=yes, scrollbars=no, resizable=no, width=400, height=400, right=200, top=10'));
			xxw.focus();
		}
	})

	///
	$Pcs2(document).keyup(function()
	{
		var mmv=event
		mmf2=event.element(event);
		if (mmf2.id=='misi' || mmf2.id=='misi2' || mmf2.id=='mminimal' || mmf2.id.substr(0,8)=='mhrgbeli' || mmf2.id.substr(0,8)=='mhrgjual')
		{
			maa=tra(Event.element(event).value)
			Event.element(event).value=maa
		}
	})

	///
	$Pcs2('#misi').blur(function()
	{
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			this.select()
		}
	})

	$Pcs2('#mstonama').blur(function()
	{
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			this.select()
		}
	})

	$Pcs2('#mgrpid').blur(function()
	{
		valigrup()
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			$Pcs2('#lookgrup').click()
		}
	})

	$Pcs2('#msatid').blur(function()
	{
		valisat()
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			$Pcs2('#mlooksatuan').click()
		}
	})

	$Pcs2('#mhrgbeli').blur(function()
	{
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			this.select()
		}
	})

	$Pcs2('#mhrgjual3').blur(function()
	{
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			this.select()
		}
	})

	$Pcs2('#mbarcode').blur(function()
	{
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
			alert("Barcode "+this.value+" sudah dipakai di Stok "+tpt.stonama)
			this.select()
			this.value=''
			return;
		}
	})

	$Pcs2('#mbarcode2').blur(function()
	{
		if (this.value!='' && this.value==$Pcs2('#mbarcode').val())
		{
			alert("Barcode 1 dan 2 Tidak Boleh Sama !")
			this.select()
			this.value=''
			return;
		}
		tpt=taptabel("setstok","stonama","barcode='"+this.value+"' or barcode2='"+this.value+"' and stoid<>'"+$Pcs2('#mstoid').val()+"' ")
		if (this.value!='' && $Pcs2('#mstoid').val()!=tpt.stoid && tpt.stonama!=undefined)
		{
			alert("Barcode "+this.value+" sudah dipakai di Stok "+tpt.stonama)
			this.select()
			this.value=''
			return;
		}
	})

	$Pcs2('#btnsaldo').click(function()
	{
		$Pcs2("#framehrg").attr('src','setsaldostok.php?mstoid='+$Pcs2("#mstoid").val())
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		dialogisopen=true;
	})

	$Pcs2('#lookgrup').click(function()
	{
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

	$Pcs2('#looksup').click(function()
	{
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

	$Pcs2('#lookmerk').click(function()
	{
		xxw=window.open('lookmerk.php?mobj=setstok1', 'aa', ('alwaysraised=yes, scrollbars=yes, resizable=no, width=400, height=480, right=200, top=10'));
		xxw.focus();
	})

	$Pcs2('#mlooksatuan').click(function()
	{
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

	$Pcs2('#looksup').click(function()
	{
		xxw=window.open('looksup.php?mobj=setstok1', 'aa', ('alwaysraised=yes, scrollbars=yes, resizable=no, width=500, height=400, right=200, top=10'));
		xxw.focus();
	})

	$Pcs2('#mgrpid').focus(function()
	{
		mmdd=fform.mgrpid.value;
		if (mmdd=='')
		{
			$Pcs2('#lookmerk').click()
		}
	})

	$Pcs2('#msatuan').focus(function()
	{
		mmdd=fform.msatuan.value;
		if (mmdd=='')
		{
			$Pcs2('#looksatuan').click()
		}
	})

	$Pcs2('#msupid').blur(function()
	{
		valisup();
	})

	$Pcs2('#bsimpan').click(function()
	{
		mstonama=fform.mstonama.value;
		//malias=fform.malias.value;
		mgrpid=fform.mgrpid.value;
		msatid=fform.msatid.value;
		misi=fform.misi.value;
		$Pcs2('#msatuan1').attr('disabled',false)
		$Pcs2('#msatuan2').attr('disabled',false)

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
		if (conf==false)
		{
			return
		}

		transaksi($Pcs2("form").serialize()+"&mTransaksixx=fsstx001");

		execajaxas("delete from setstok where stonama=''")

		parent.$Pcs2("#"+mobj).val(fform.mstoid.value)
		parent.$Pcs2("#"+mobj).select()

		parent.$Pcs2("#kotakdialog2").dialog('close');
		parent.$Pcs2("#"+mobj).blur()
		//document.location.reload()
	})

	$Pcs2('#bhapus').click(function()
	{
		//Ceking valid
		//
		var conf=window.confirm("Hapus Data ?")

		transaksi($Pcs2("form").serialize()+"&mTransaksixx=fsstx002");

		$Pcs2('#tutup').click();
	})

	$Pcs2('#tutup').click(function()
	{
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
	if (mvstoid=='')
	{
		fform.bsimpan.value='Simpan'
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php", 
			data: "func=EXEC&field=stoid&tabel=setstok&kondisi=(1=1) order by stoid desc limit 1",
			dataType:'json',
			success: function(data)
			{
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
				execajaxas("insert into setstok(stoid,aktif) values('"+mmstoid+"',0)")
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

	if (mvgrpid=='')
	{
		$Pcs2("#mmerknama").val("");
		return;
	}
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
	if (mvsupid=='')
	{
		$Pcs2("#msupnama").val("");
		return;
	}
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
	if (mvsatuanid=='')
	{
		return;
	}
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

///
</script>

</body>

</html>
