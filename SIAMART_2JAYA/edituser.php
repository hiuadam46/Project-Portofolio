<html>

<head>
<title>SETUP user</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
</head>

<body name="editstok" onload="$mFoc" style="font-family: Verdana; background-color: #286C00">

<?php
require ("utama.php");

$query18=executerow("
select *
from user 
where id='$_GET[mid]'
");
$mstok=mysql_fetch_assoc ($query18);

$medit='';
if ($mstok[edit]==1)
{
	$medit='checked';
}
?>
<form id="fform">
	<table>
		<tr>
			<td><label style="color: white">Kode user </label></td>
			<td style="color:white">:
			<input id="mid" maxlength="20" name="mid" size="20" type="text" value="<?php echo $mstok[id] ?>"></td>
		</tr>
		<tr>
			<td><label style="color: white">Nama user </label></td>
			<td style="color:white">:
			<input id="mnama" maxlength="200" name="mnama" size="50" title="Isikan Nama user" type="text" value="<?php echo $mstok[nama] ?>"></td>
		</tr>
		<tr>
			<td><label style="color: white">Password </label></td>
			<td style="color:white">:
			<input id="mpass" maxlength="200" name="mpass" size="50" title="Isikan password user" type="text" value="<?php echo $mstok[password] ?>"></td>
		</tr>
		<tr>
			<td><label style="color: white">Edit/Hapus </label></td>
			<td style="color:white">: <input type=checkbox name=medit id=medit <?php echo $medit ?>></td>
		</tr>
		<tr>
			<td><label style="color: white">Akses Menu </label></td>
			<td style="color:white">:</td>
		</tr>
	</table>
	<div id="backtabel" style="background-image: url(images/backt.png); height: 300px; border-color: black; border-style: solid; border-width: 1px; overflow: auto">
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background-color: white; color: black">
<?php
$query="
select a.*, b.user
from setmenu a
left join menuuser b on a.menuid=b.menuid and user='$_GET[mid]'
order by ids
";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_assoc($rrw))
{
	$mjeda="&nbsp;&nbsp;&nbsp;";
	if ($rows[menupos]=='topmenu')
	{
		$mjeda='';
	}

	$mck='checked';
	if ($rows[user]=='')
	{
		$mck='';
	}

	$mjda=' ';

	echo "
			<tr id='tr_$mnom' class='thetr' >
				<td>$mnom.</td><input type=hidden value='$rows[menuid]' id='id_$mnom' >
				<td hidden>$mjda-$rows[menuid] &nbsp; </td>
				<td>$mjda-$rows[menucapt]&nbsp;</td>
				<td align=center><input type=checkbox id='check_$mnom' $mck onmousemove=garis($mnom)></td>
			</tr>
	";
	$mnom++;
}
?>
		</table>
	</div>
	<hr><label style="color: white; font-size: 4pt; font-family: Verdana">
	<input id="bsimpan" type="button" value="Simpan">
	<input id="bhapus" type="button" value="Hapus">
	<input id="tutup" type="button" value="Tutup">
	<input id="aksesall" type="button" value="Akses Semua Menu">
	<input id="noaksesall" type="button" value="Lepas Semua Akses"> </label>
</form>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function()
{
	execajaxas("alter table user add edit numeric(1) default 0")

	var lan='<?php echo $mstok[userlantai] ?>'
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
			this.focus()
		}
	})

	$Pcs2('#msatid').blur(function()
	{
		valisat()
	})

	$Pcs2('#misi2').blur(function()
	{
		if (this.value=='' || this.value=='0' || this.value==0)
		{
			this.focus()
		}
	})

	$Pcs2('#btnsaldo').click(function()
	{
		$Pcs2("#framehrg").attr('src','setsaldostok.php?mid='+$Pcs2("#mid").val())
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		dialogisopen=true;
	})

	$Pcs2('#aksesall').click(function()
	{
		for (hj=1;hj<100;hj++)
		{
			$Pcs2("#check_"+hj).attr("checked",true)
		}
	})

	$Pcs2('#noaksesall').click(function()
	{
		for (hj=1;hj<100;hj++)
		{
			$Pcs2("#check_"+hj).attr("checked",false)
		}
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
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})

	$Pcs2('#lookmerk').click(function()
	{
		xxw=window.open('lookmerk.php?mobj=user1', 'aa', ('alwaysraised=yes, scrollbars=yes, resizable=no, width=400, height=480, right=200, top=10'));
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
		xxw=window.open('looksup.php?mobj=user1', 'aa', ('alwaysraised=yes, scrollbars=yes, resizable=no, width=500, height=400, right=200, top=10'));
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

	$Pcs2('#mgrpid').blur(function()
	{
		valigrup();
	})

	$Pcs2('#msupid').blur(function()
	{
		valisup();
	})

	$Pcs2('#msatuan').blur(function()
	{
		valisat()
	})

	$Pcs2('#bsimpan').click(function()
	{
		mid=fform.mid.value;

		//Ceking valid
		if (mid=='')
		{
			alert('Kode Tidak Boleh Kosong!');
			fform.mid.select();
			return
		}
		//

		mnama=fform.mnama.value;

		//Ceking valid
		if (mnama=='')
		{
			alert('Nama Tidak Boleh Kosong!');
			fform.mnama.select();
			return
		}
		//

		var conf=window.confirm("Simpan Transaksi ?")
		if (conf==false)
		{
			return
		}
		medd=0
		if ($Pcs2("#medit").attr('checked'))
		{
			medd=1
		}
		execajaxas("delete from user where id='"+$Pcs2("#mid").val()+"'")
		execajaxas("delete from menuuser where user='"+$Pcs2("#mid").val()+"'")
		execajaxa("insert into user(id, nama, password, edit) values('"+$Pcs2("#mid").val()+"', '"+$Pcs2("#mnama").val()+"', '"+$Pcs2("#mpass").val()+"', '"+medd+"')")

		for (hj=1;hj<100;hj++)
		{
			abc=$Pcs2("#check_"+hj).attr("checked")
			if ($Pcs2("#id_"+hj).val()==undefined)
			{
				break;
			}

			if (abc)
			{
				execajaxa("insert into menuuser(user, menuid) values('"+$Pcs2("#mid").val()+"', '"+$Pcs2("#id_"+hj).val()+"')")
			}
		}

		$Pcs2('#tutup').click();
	})

	$Pcs2('#bhapus').click(function()
	{
		mid=fform.mid.value;

		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false)
		{
			return
		}

		execajaxas("delete from user where id='"+$Pcs2("#mid").val()+"'")

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
function garis(thee)
{
	$Pcs2(".thetr").css("background-color","white")
	$Pcs2("#tr_"+thee).css("background-color","yellow")
}

function ambilstok()
{
	mvid=$Pcs2('#mid').val();
	if (mvid=='')
	{
		fform.bsimpan.value='Simpan'
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php", 
			data: "func=EXEC&field=id&tabel=user&kondisi=(1=1) order by id desc limit 1",
			dataType:'json',
			success: function(data)
			{
				mmid=data.id;
				//alert(data);
				if (mmid!=undefined)
				{
					//alert(msatuanid);
					mmid=mmid.substr(1,15)
					mmid=parseFloat(mmid);
					//alert(msatuanid);
					mmid=mmid+1;
					mmid=''+mmid
					mmid='B'+padl(mmid,'0',5);
				}
				else
				{
					mmid='B00001';
				}
				fform.mid.value=mmid;
				$Pcs2('#mid').select();
				execajaxas("insert into user(id,aktif) values('"+mmid+"',0)")
			}
		});
	}
	else
	{
		user=taptabel("user","*","id='"+mvid+"'");
		fform.bsimpan.value='Edit'
		$Pcs2('#mnama').val(user.nama);
		$Pcs2('#mbarcode').val(user.barcode);
		$Pcs2('#mbarcode2').val(user.barcode2);
		$Pcs2('#msatid').val(user.satuan);
		$Pcs2('#mgrpid').val(user.grpid);
		$Pcs2('#msupid').val(user.supid);
		$Pcs2('#msatuan').val(user.satuan);
		$Pcs2('#misi').val(user.isi);
		$Pcs2('#misi2').val(user.isi2);
		$Pcs2('#mhrgbeli').val(tra(toval(user.hrgbeli)));
		$Pcs2('#mhrgjual').val(tra(toval(user.hrgjual)));
		$Pcs2('#mhrgjual2').val(tra(toval(user.hrgjual2)));
		$Pcs2('#mhrgjual3').val(tra(toval(user.hrgjual3)));
		$Pcs2('#mminimal').val(tra(toval(user.minimal)));
		valigrup();
		valisup();
		valisat();
		$Pcs2('#mid').attr('readonly','true')
		$Pcs2('#mnama').select();

		saldo=taptabel("bkbesar","qtyin","bpid='"+mvid+"' and trans='SA'");

		if (saldo.qtyin!=undefined)
		{
			msd=saldo.qtyin;
			mi1=user.isi;
			mi2=user.isi2;
			mss1=parseInt(msd/(mi1*mi2),0);

			if (mi1==1)
			{
				mss1=0;
			}

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
