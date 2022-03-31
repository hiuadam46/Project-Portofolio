<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_2jaya_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
	echo "<script> window.location='index.php' </script>";
}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Mutasi Gudang</title>
<link href="themes/base/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/controls.js" type="text/javascript"></script>
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/format.js" type="text/javascript"></script>
<script src="js/jScrollPane.min.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var databaru=true;
var mvv=18;

var dialogisopen=false;
$Pcs2(document).ready(function()
{
	$Pcs2("#setper").html("<img src='CSS3 Menu_files/css3menu1/stock.png'/><font size=3><i> Mutasi Antar Gudang</font></i>")
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});

	baru()

	$Pcs2("#fform").click(function()
	{
		for (var md=1;md<50;md++)
		{
			$Pcs2("#bodiv_"+md).css("background-color","white")
		}

		midd=event.element(event).id
		mlg=midd.indexOf("_")
		msatu=midd.substr(mlg+1,1000)
		mdua=midd.substr(0,mlg)
		$Pcs2("#bodiv_"+msatu).css("background-color","yellow")

		if (event.element(event).type=='checkbox')
		{
			mhari=mdua-3
			mlgnid=$Pcs2("#2_"+msatu).val()
			msalesid=$Pcs2("#msalesid").val()
			mchk=event.element(event).checked
			execajaxas("delete from setkunjungan where lgnid='"+mlgnid+"' and hari="+mhari+" and salesid='"+msalesid+"'")
			//alert("delete from setkunjungan where lgnid='"+mlgnid+"' and hari="+mhari+" and salesid='"+msalesid+"'")

			if (mchk)
			{
				execajaxas("insert setkunjungan values('"+mlgnid+"',"+mhari+",'"+msalesid+"')")
				//alert("insert setkunjungan values('"+mlgnid+"',"+mhari+",'"+msalesid+"')")
			}
		}
	})

	$Pcs2("#msalesid").change(function()
	{
		refreshgrid()
	})

	$Pcs2("#tcari").keyup(function()
	{
		refreshgrid()
	})

	$Pcs2("#fform1").keydown(function()
	{
		if (event.element(event).id!='mket')
		{
			tabOnEnter (event.element(event), event)
		}

		if (event.element(event).id=='mket' && event.keyCode==13)
		{
			$Pcs2("#2_1").focus();
			$Pcs2("#2_1").select();
		}
	})

	$Pcs2("#fform").keypress(function()
	{
		mname=Event.element(event).id;
		$Pcs2("#"+mname).css("background-color","transparent")

		mlg=mname.indexOf("_")
		msatu=mname.substr(mlg+1,1000)
		mdua=mname.substr(0,mlg)

		//alert(mpar)
		//alert(msatu)
		//alert(mdua)

		if (event.keyCode==13 || event.keyCode==39)
		{
			$Pcs2("#bodiv_"+msatu).css("background-color","white")

			mggg=getNextElement(Event.element(event))
			mggg.focus()
			mggg.select()
			//$Pcs2("#"+mggg.id).css("background-color","lightgreen")

			mlg=mggg.id.indexOf("_")
			msatu=mggg.id.substr(mlg+1,1000)
			$Pcs2("#bodiv_"+msatu).css("background-color","yellow")

			toshow(mggg)
		}

		if (event.keyCode==37)
		{
			$Pcs2("#bodiv_"+msatu).css("background-color","white")

			mjjj=getPrevElement(Event.element(event))
			mjjj.focus()
			mjjj.select()
			//$Pcs2("#"+mjjj.id).css("background-color","lightgreen")

			mlg=mjjj.id.indexOf("_")
			msatu=mjjj.id.substr(mlg+1,1000)
			$Pcs2("#bodiv_"+msatu).css("background-color","yellow")

			toshow2(mjjj)
		}

		if (event.keyCode==38)
		{
			if (msatu!='1')
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")
			}

			mbawah=parseInt(msatu)-1
			mjjj=document.getElementById(mdua+'_'+mbawah)
			mjjj.focus()
			mjjj.select()
			//$Pcs2("#"+mjjj.id).css("background-color","lightgreen")

			mlg=mjjj.id.indexOf("_")
			msatu=mjjj.id.substr(mlg+1,1000)

			$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
			hiderow2(mbawah)
		}
		if (event.keyCode==40)
		{
			mjjjd=$Pcs2("#tabjumlah").val()
			if (parseInt(msatu)<mjjjd)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")
			}
			mbawah=parseInt(msatu)+1
			//$Pcs2("#"+mdua+'_'+mbawah).css("background-color","lightgreen")
			$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
			//hiderow(mbawah)
			document.getElementById(mdua+'_'+mbawah).focus()
			document.getElementById(mdua+'_'+mbawah).select()
		}
		mmv=event.keyCode
		mobj=event.element(event)
		mnn=mobj.id.substr(0,1)

		if (mnn=='2' && mmv==116)
		{
			query1="select left(a.stoid,12) stoid,left(a.barcode,15) Barc,left(a.stonama,30) Nama,'"+$Pcs2("#mlokid1").val()+"' QSALDO from setstok a "
			query2=" where true "

			mcomm=query1+query2

			mordd="stoid"
			mffff=" concat(stonama,barcode,barcode2) "

			mmid=mobj.id

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		}
		
		if (mnn=='5' && mmv==116)
		{
			mmid=mobj.id
			msto=mmid.replace("5_","2_")
			mval=$Pcs2("#"+msto).val()

			query1="select nid2 LOT,qtyin rightQty from bkbesar where bpid='"+mval+"' and qtyin>0 "

			mcomm=query1

			mordd="LOT"
			mffff=" nid2 "

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		}
	})

	$Pcs2('#backtabel').css(
	{
		'position':'relative',
		'background-color':'white',
		'border-color':'black',
		'border-style':'solid',
		'border-width':'1px',
	})
	
	$Pcs2('#footer').css(
	{
		'position':'relative',
		'background-color':'lightblue',
		'border-color':'black',
		'border-style':'solid',
		'border-width':'1px'
	})

	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 800,
		close : function()
		{
			;
		},
	});

	$Pcs2("#btnsimpan").click(function()
	{
		mnid=$Pcs2("#mnid").val()

		execajaxas("delete from transmutasigudang where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		mtgx=baliktanggal($Pcs2("#mtgl").val())
		mlokid1=$Pcs2("#mlokid1").val()
		mlokid2=$Pcs2("#mlokid2").val()
		mket=$Pcs2("#mket").val()
		mnid=$Pcs2("#mnid").val()

		for (ma=1;ma<100;ma++)
		{
			mstoid=$Pcs2("#2_"+ma).val()
			mstoid=mstoid.trim()

			if (mstoid!='')
			{
				mnomor=$Pcs2("#1_"+ma).val()
				mqty=toval($Pcs2("#4_"+ma).val())
				munit=toval($Pcs2("#6_"+ma).val())
				mket=$Pcs2("#8_"+ma).val()
				misi=toval($Pcs2("#9_"+ma).val())
				mtglx=baliktanggal( $Pcs2("#mtgl").val())

				msql1="insert into transmutasigudang(nid,tgl,nomor,stoid,qty,isi,lokid1,lokid2,ket,unit)"
				msql2=" values('"+mnid+"','"+mtglx+"','"+ma+"','"+mstoid+"','"+mqty+"','"+misi+"','"+mlokid1+"','"+mlokid2+"','"+mket+"','"+munit+"') "
				execajaxa(msql1+msql2)

				mjmlhrg=savstofifo(mlokid1,mstoid,mnid,mtglx,0,0,0,((mqty*misi)+munit),'TRANSMUTASI',mket)
				//savstofifo(mlokid2,mstoid,mnid,mtglx,mjmlhrg,((mqty*misi)+munit),0,0,'TRANSMUTASI',mket)
			}
		}

		execajaxa("insert into bkbesar (rekid,nid,tgl,bpid,bpid2,debet,qtyin,trans,ket,nid2) select rekid,nid,tgl,bpid,'"+mlokid2+"',kredit,qtyout,trans,ket,'' from bkbesar where nid='"+mnid+"'")
		alert("Data Tersimpan")

		baru()
	})

	$Pcs2("#btnhapus").click(function()
	{
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false){return}
		mnid=$Pcs2("#mnid").val()
		execajaxas("delete from transmutasigudang where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		alert("Data Terhapus")
		baru()
	})

	$Pcs2("#btnbaru").click(function()
	{
		baru()
	})

	$Pcs2("#mnid").blur(function()
	{
		if (this.value=='')
		{
			this.focus();
			this.select();
		}
		tb1=taptabel("transmutasigudang a","a.*,date_format(tgl,'%d-%m-%Y') tgly","nid='"+this.value+"'");

		mnid=tb1.nid;
		if (mnid!=undefined)
		{
			$Pcs2("#mtgl").val(tb1.tgly)
			$Pcs2("#mlokid1").val(tb1.lokid1)
			$Pcs2("#mlokid2").val(tb1.lokid2)
			$Pcs2("#mket").val(tb1.ket)
			refreshgrid()
		}
		else
		{
			alert("Nomor Tidak Ada !");
			baru(true);
		}
	})
});

function ambilstok(thee)
{
	mid=thee.id
	mval=$Pcs2('#'+mid).val()
	mstonam=mid.replace('2_','3_')
	misi=mid.replace('2_','9_')
	msat1=mid.replace('2_','5_')
	msat2=mid.replace('2_','7_')

	moo=taptabel("setstok","stoid,stonama,isi,satuan1,satuan2","stoid='"+mval+"'")
	$Pcs2("#"+mstonam).val('')
	if (moo.stoid!=undefined)
	{
		$Pcs2("#"+mstonam).val(moo.stonama)
		$Pcs2("#"+misi).val(moo.isi)
		$Pcs2("#"+msat1).val(moo.satuan1)
		$Pcs2("#"+msat2).val(moo.satuan2)
		mqty=mid.replace('2_','4_')
		$Pcs2("#"+mqty).focus()
	}
}

function ambillot(thee)
{
	return
}

function toshow(obj)
{
	mname=obj.id;
	mlg=mname.indexOf("_")
	msatu=parseInt(mname.substr(mlg+1,1000))
	mdua=mname.substr(0,mlg)
	//$Pcs2("#bodiv_"+(msatu)).show()
	//$Pcs2("#bodiv_"+(msatu-mvv)).hide()
}

function toshow2(obj)
{
	mname=obj.id;
	mlg=mname.indexOf("_")
	msatu=parseInt(mname.substr(mlg+1,1000))
	mdua=mname.substr(0,mlg)
	//$Pcs2("#bodiv_"+(msatu)).show()
	//$Pcs2("#bodiv_"+(mvv+msatu)).hide()
}

function refreshgrid()
{
	mser="&mnid="+$Pcs2("#mnid").val();
	$Pcs2.ajax(
	{
		type:"POST",
		chace : true,
		context: document.body,
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridmutagud.php",
		data : "mTform=transproduksi"+mser,
		async: true,
		success : function(data)
		{
			$Pcs2("#spantabel").html(data)
		}
	});
}

function baru()
{
	$Pcs2("#mtgl").val(tglsekarang());
	$Pcs2("#mnid").val('');
	$Pcs2("#mlokid1").val('L001');
	$Pcs2("#mlokid2").val('L001');
	$Pcs2("#mket").val('');

	datas=taptabel("transmutasigudang","nid"," 1=1 order by nid desc limit 0,1")

	data=datas.nid;

	if (data!=undefined)
	{
		mmmerkid=data.substr(2,7);
		//alert(mmmerkid);
		mmmerkid=parseFloat(mmmerkid);
		//alert(mmmerkid);
		mmmerkid=mmmerkid+1;
		mmmerkid=''+mmmerkid
		mmmerkid='MG'+padl(mmmerkid,'0',7);
	}
	else
	{
		mmmerkid='MG0000001';
	}
	$Pcs2("#mnid").val(mmmerkid);
	execajaxa("delete from transmutasigudang where nid='"+mmmerkid+"'")
	execajaxa("delete from transmutasigudang where nid='"+mmmerkid+"'")
	execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
	refreshgrid()
	$Pcs2("#mket").focus()
}

function cekqty(thiee)
{
	mmid=thiee.id;
	/* alert(mmid);
	return; */
	
	m22=mmid.substr(0,2)
	
	m23=mmid.replace('4_','')
	m23=m23.replace('6_','')
	
	mqty=toval($Pcs2("#4_"+m23).val())
	munit=toval($Pcs2("#6_"+m23).val())
	misi=toval($Pcs2("#9_"+m23).val())
	mtotqty=((mqty)*misi)+munit;
	/* alert(mtotqty);
	return; */
	
	cck=ceksaldo_lok($Pcs2("#2_"+m23), mtotqty, $Pcs2("#3_"+m23).val())
	
	if (cck==false)
	{
		thiee.value='';
		return;
	}
}

function ceksaldo_lok(msto, mqty, mstonama)
{
	mstoid=msto.val();
	mlokid1=$Pcs2("#mlokid1").val();
	
	mgh=taptabel("bkbesar", "ifnull(sum(qtyin), 0)-ifnull(sum(qtyout), 0) saldo", "bpid='"+mstoid+"' and bpid2='"+mlokid1+"' ");
	
	if ( (mqty>mgh.saldo && mgh.saldo!=null) || mgh.saldo==null )
	{
		malert="Stok "+mstonama+" Tidak Mencukup ! Saldo :"+mgh.saldo
		alert(malert)
		mmg=false
	}
	else
	{
		mmg=true
	}

	return mmg
}

</script>
</head>

<body style="background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<form id="fform1" name="fform1">
	<table style="color: white; font-family: Arial" width="100%">
		<tr>
			<td>Tgl.</td>
			<td>: <input id="mtgl" readonly size="10" type="text"></td>
			<td>Lokasi Asal</td>
			<td>: <?php
combobox("select lokid misi,concat(loknama,' - ',lokid) mtampil from setlok order by lokid","mlokid1");
?></td>
			<td>Keterangan</td>
			<td>:<input id="mket" size="50" type="text"></td>
		</tr>
		<tr>
			<td>No.</td>
			<td>: <input id="mnid" size="10" type="text"> </td>
			<td>Lokasi Tujuan</td>
			<td>: <?php
combobox("select lokid misi,concat(loknama,' - ',lokid) mtampil from setlok order by lokid","mlokid2");
?></td>
			<td></td>
			<td>:<input id="mket2" size="50" type="text"></td>
		</tr>
	</table>
</form>
<form id="fform" name="fform">
	<span id="spantabel"></span><hr>
	<input id="btnsimpan" type="button" value="Simpan">
	<input id="btnbaru" type="button" value="Baru">
	<input id="btnhapus" type="button" value="Hapus">
	<input id="btnkeluar" type="button" value="Keluar">
</form>
<div id="kotakdialog2" title="Setup Pelanggan">
	<center><iframe id="framehrg" height="400" style="top: 30px" width="700">
	</iframe></center></div>

</body>

</html>
