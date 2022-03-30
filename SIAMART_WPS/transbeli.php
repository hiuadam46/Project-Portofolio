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
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Pembelian</title>
<link href="themes/sunny/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
var mvv=15;
var mws=screen.width
var mcomm
var mordd
var mffff
var mstokall=''
var mplafon=0
var thefoc = ''
var mdd='<?php echo session_id(); ?>'
var mposisi=''

var mnidopen='<?php echo $mnid; ?>';

$Pcs2(document).ready(function()
{
	$Pcs2("#setper").html("<font size=3><i>Transaksi Pembelian</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Transaksi Pembelian");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	execajaxas("alter table transbeli1 add lokid varchar(10) default 'L001' ")
	baru()

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

	$Pcs2(document).keypress(function()
	{
		$Pcs2("#spanket").html("")

		mmv=event.keyCode
		mac=event.element(event).id;
		if (event.which!=0)
		{
			return;
		}

		if (mmv==112)
		{
			$Pcs2('#btnsimpan').click()
		}

		if (mmv==113)
		{
			$Pcs2('#btnbaru').click()
		}

		if (mmv==114)
		{
			$Pcs2('#btnhapus').click()
		}

		if (mmv==116)
		{
			$Pcs2('#look'+mac).click()
		}

		if (mmv==123)
		{
			$Pcs2('#btnkeluar').click()
		}
	})

	$Pcs2("#fform").keydown(function()
	{
		mmf2=event.element(event);
		mmid=mmf2.id
		mmv=event.keyCode
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
			tabOnEnter2(mmf2, event);
		}

		if (mmid.substr(0,2)=='12' && (mmv==116 || (mmv==13 && mmf2.value=='') ))
		{
			query1="select left(a.stoid, 12) stoid, left(a.barcode, 15) Barc, left(a.stonama, 30) Nama, left(format(a.hrgbeli, 0), 15) rightHarga, 'L001' QSALDO from setstok a "
			query2=" where true "

			mcomm=query1+query2

			mordd="stoid"
			mffff=" concat(barcode,stonama) "

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		}

		if (mmid.substr(0,2)=='12' && (mmv==117 || (mmv==13 && mmf2.value=='') ))
		{
			$Pcs2("#framehrg").attr('src','editsetstok.php?mobj='+mmid)
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Stok Baru');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		}
	})

	$Pcs2("#fform").keyup(function()
	{
		mmf2=event.element(event);
		mmid=mmf2.id
		m22=mmid.substr(0,2)
		mri=$Pcs2("#"+mmid).css('text-align')
		if (m22==15 || m22==16 || m22==17 || mmid=='mtunai' || mmid=='mongkos' || mri=='right')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		rumus1()
	})

	$Pcs2("#mkarid").blur(function()
	{
		datas=taptabel("setkaryawan","karid,karnama","karid='"+this.value+"'")
		$Pcs2("#mkarid").val("")
		$Pcs2("#mkarnama").val("")
		if (datas.karid!=undefined)
		{
			$Pcs2("#mkarid").val(datas.karid)
			$Pcs2("#mkarnama").val(datas.karnama)
			$Pcs2("#mket").focus()
		}
	})

	$Pcs2("#msupid").blur(function()
	{
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup", "supid, plafon, supnama, DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"', '%d-%c-%Y'), INTERVAL tempo DAY) jt", "supid='"+this.value+"'")

		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
			$Pcs2("#msupid").val(datas.supid)
			$Pcs2("#msupnama").val(datas.supnama)
			$Pcs2("#mjt").val(baliktanggal2(datas.jt))
			$Pcs2("#mket").focus()
			mplafon=datas.plafon
		}
	})

	$Pcs2("#mnid").blur(function()
	{
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transbeli1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))

			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#msupid").val(mgg.supid)
			$Pcs2("#mlokid").val(mgg.lokid)
			$Pcs2("#mket").val(mgg.ket)
			$Pcs2("#mfakturid").val(mgg.fakturid)

			$Pcs2("#mkarid").blur()
			$Pcs2("#msupid").blur()

			refreshgrid2(mgg)
			$Pcs2("#mfakturid").focus()
		}
		else
		{
			baru()
		}
	})

	$Pcs2("#looklok").click(function()
	{
		mcomm="Select rpad(lokid, 12, ' ') Kode, left(loknama, 50) Nama from setlok where true"
		mordd="Kode"
		mffff=" concat(lokid, loknama) "

		$Pcs2("#framehrg").attr('src', 'genlookup.php?mobj=mlokid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Lokasi');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})

	$Pcs2("#mlokid").blur(function()
	{
		mll=taptabel("setlok", "loknama", "lokid='"+this.value+"'")
		$Pcs2("#mloknama").val(mll.loknama)
		$Pcs2("#mket").focus()
	})

	$Pcs2("#lookmsupid").click(function()
	{
		mcomm="Select rpad(supid, 12, ' ') Kode, left(supnama, 50) Nama from setsup where true"
		mordd="Kode"
		mffff=" concat(supid, supnama) "

		$Pcs2("#framehrg").attr('src', 'genlookup.php?mobj=msupid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})

	$Pcs2("#lookmnid").click(function()
	{
		mcomm="Select nid Nota, date_format(tgl, '%d-%m-%Y') Tgl, left(concat(a.supid, '-', supnama), 30) Suplier, left(FORMAT(total, 0), 12) rightTotal from transbeli1 a left join setsup b on a.supid=b.supid where true"
		mordd="Nota"
		mffff=" concat(nid, date_format(tgl, '%d-%m-%Y'), supnama) "

		$Pcs2("#framehrg").attr('src', 'genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Nota Beli');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})

	$Pcs2("#btnsimpan").click(function()
	{
		//////////////////////////////create number////////////////////
	mnid = $Pcs2("#mnid").val();
	if (mnid=='')
	{
		datas=taptabel("transbeli1", "nid", "1=1 order by nid desc limit 0, 1")
		data=datas.nid;
		if (data!=undefined)
			{
				mmmerkid=data.substr(2, 7);
				//alert(mmmerkid);
				mmmerkid=parseFloat(mmmerkid);
				//alert(mmmerkid);
				mmmerkid=mmmerkid+1;
				mmmerkid=''+mmmerkid
				mmmerkid='TB'+padl(mmmerkid, '0', 7);
			}
			else
			{
				mmmerkid='TB0000001';
			}
	
			$Pcs2("#mnid").val(mmmerkid);

			execajaxas("delete from transbeli1 where nid='"+mmmerkid+"'")
			execajaxas("delete from transbeli2 where nid='"+mmmerkid+"'")
			execajaxas("delete from bkbesar where nid='"+mmmerkid+"'")
	}
	//////////////////////////////create number////////////////////

		mtun=toval($Pcs2("#mtunai").val())
		$Pcs2("#mhutang").val(tra(mj1-(mong+mtun)))
		if (tra(mj1-(mong+mtun))==0)
		{
			$Pcs2("#mjt").val("")
		}
		else
		{
			msup=$Pcs2("#msupid").val()
			datas=taptabel("setsup", "supid, supnama, DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"', '%d-%c-%Y'), INTERVAL tempo DAY) jt", "supid='"+msup+"'")
			$Pcs2("#mjt").val(baliktanggal2(datas.jt))
		}
		mnid=$Pcs2("#mnid").val()
		if (mnid=='')
		{
			malert="TIDAK BISA DISIMPAN ! <br> Nota Kosong"
			$Pcs2("#spanket").html(malert)
			$Pcs2("#mnid").focus();

			return;
		}

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		mjt="str_to_date('"+$Pcs2("#mjt").val()+"','%d-%c-%Y')"

		msupid=$Pcs2("#msupid").val()
		if (msupid=='')
		{
			malert="TIDAK BISA DISIMPAN ! <br> Suplier Kosong"
			$Pcs2("#spanket").html(malert)
			$Pcs2("#msupid").focus();
			return;
		}

		mket=$Pcs2("#mket").val()
		mfakturid=$Pcs2("#mfakturid").val()

		msupnama=$Pcs2("#msupnama").val()
		mlokid=$Pcs2("#mlokid").val()

		mtotal=toval($Pcs2("#mtotal").val())
		mtunai=toval($Pcs2("#mtunai").val())
		mhutang=toval($Pcs2("#mhutang").val())
		mongkos=toval($Pcs2("#mongkos").val())

		if (mtotal==0)
		{
			malert="TIDAK BISA DISIMPAN ! <br> Total Beli Kosong"
			$Pcs2("#spanket").html(malert)
			$Pcs2("#12_1").focus();
			return;
		}
		
		 execajaxas("delete from bkbesar where nid='"+mnid+"'")
		 execajaxas("delete from transbeli1 where nid='"+mnid+"'")
		 execajaxas("delete from transbeli2 where nid='"+mnid+"'")

		mq1="insert into transbeli1(nid,tgl,tgljt,ket,fakturid,supid,total,tunai,jumlah,ongkos,status,lokid) "
		mq2=" values('"+mnid+"',"+mtgl+","+mjt+",'"+mket+"','"+mfakturid+"','"+msupid+"','"+mtotal+"','"+mtunai+"','"+mhutang+"','"+mongkos+"',2,'"+mlokid+"')"
		execajaxas(mq1+mq2)

		mtot=0
		mkat=" insert into transbeli2(nomor,nid,tgl,stoid,qty,unit,extra,extraunit,totqty,hrgsat,jmlhrg,isi,diskonp) values "

		for (gg=1;gg<100;gg++)
		{
			mstoid=$Pcs2("#12_"+gg).val()
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())
			mextra=toval($Pcs2("#18_"+gg).val())
			mextraunit=toval($Pcs2("#20_"+gg).val())
			misi=toval($Pcs2("#misi_"+gg).val())
			mtotqty=((mqty+mextra)*misi)+munit+mextraunit
			mhrgsat=toval($Pcs2("#22_"+gg).val())
			mdisk=toval($Pcs2("#23_"+gg).val())
			mjmlhrg=toval($Pcs2("#24_"+gg).val())

			if (mstoid==undefined)
			{
				break
			}

			if (mstoid!='')
			{
				mlokid=$Pcs2("#mlokid").val()

				mtglx=baliktanggal( $Pcs2("#mtgl").val() )

				mkat=mkat+" ('"+gg+"','"+mnid+"',"+mtgl+",'"+mstoid+"','"+mqty+"','"+munit+"','"+mextra+"','"+mextraunit+"','"+mtotqty+"','"+mhrgsat+"','"+mjmlhrg+"','"+misi+"','"+mdisk+"'), "

				execajaxa("update setstok set hrgbeli="+mhrgsat+" where stoid='"+mstoid+"'")
			}
		}
		mkat=mkat+" ('','','','','','','','','','','','','') "
		execajaxas(mkat)
		$Pcs2.ajax(
		{
			type:"POST",
			url:"jurnaling.php",
			async: true,
			data : "mnid="+mnid,
			success : function(data)
			{
				
			}
		})

		malert="DATA TERSIMPAN !"
		$Pcs2("#spanket").html(malert)

		//xxw=window.open('printbeli.php?mnid='+mnid,'aa',('alwaysraised=yes,scrollbars=no,resizable=no,height=550,left=200,top=10'));
		//xxw.focus();

		baru()
	})

	$Pcs2("#btnbaru").click(function()
	{
		baru()
	})

	$Pcs2("#btnhapus").click(function()
	{
		mnid=$Pcs2("#mnid").val()
		mconf=confirm("Menghapus Transaksi No. "+mnid+"?")
		if (mconf==false)
		{
			return;
		}
		execajaxas("delete from transbeli1 where nid='"+mnid+"'")
		execajaxas("delete from transbeli2 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")

		malert="DATA TERHAPUS !"
		$Pcs2("#spanket").html(malert)

		baru()
	})

	$Pcs2("#btnkeluar").click(function()
	{
		self.close()
	})
	
	if (mnidopen!='')
	{
		$Pcs2("#mnid").val(mnidopen);
		$Pcs2("#mnid").blur();
	}
});

///awal functions
function bukastok(theid)
{
	mid=theid.id.replace('25','12')
	mstoid=$Pcs2("#"+mid).val()

	$Pcs2("#framehrg").attr('src', 'editsetstok.php?mstoid='+mstoid+"&mobj="+mid)
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Stok');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}

function arah(theid)
{
	mname=theid.id;
	mlg=mname.indexOf("_")
	msatu=mname.substr(mlg+1,1000)

	mdua=mname.substr(0,mlg)
	$Pcs2(".thebodiv").css("background-color", "transparent")
	$Pcs2(".rcell").css("background-color", "transparent")

	mggg=theid
	if (mggg.type!='button')
	{
		$Pcs2("#"+mggg.id).css("background-color", "lightblue")
	}
	mlg=mggg.id.indexOf("_")
	msatu=mggg.id.substr(mlg+1,1000)
	$Pcs2("#bodiv_"+msatu).css("background-color","yellow")

	if (event.keyCode==13 || event.keyCode==39)
	{
		mggg=getNextElement2(theid)
		if (mggg.type!='button')
		{
			$Pcs2("#"+mggg.id).css("background-color", "lightblue")
		}
		mlg=mggg.id.indexOf("_")
		msatu=mggg.id.substr(mlg+1, 1000)
		$Pcs2("#bodiv_"+msatu).css("background-color", "yellow")
		mggg.focus()
		mggg.select()
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
	}

	if (event.keyCode==38)
	{
		mbawah=parseInt(msatu)-1
		mjjj=document.getElementById(mdua+'_'+mbawah)
		mjjj.focus()
		mjjj.select()
		if (mjjj.type!='button')
		{
			$Pcs2("#"+mjjj.id).css("background-color", "lightblue")
		}
		mlg=mjjj.id.indexOf("_")
		msatu=mjjj.id.substr(mlg+1,1000)
		$Pcs2("#bodiv_"+msatu).css("background-color", "yellow")
	}
	if (event.keyCode==40)
	{
		mjjjd=$Pcs2("#tabjumlah").val()
		mbawah=parseInt(msatu)+1
		document.getElementById(mdua+'_'+mbawah).focus()
		document.getElementById(mdua+'_'+mbawah).select()
		mjjj=document.getElementById(mdua+'_'+mbawah)
		if (mjjj.type!='button')
		{
			$Pcs2("#"+mjjj.id).css("background-color", "lightblue")
		}
		$Pcs2("#bodiv_"+mbawah).css("background-color", "yellow")
	}
}

function refreshgrid2(mgg)//
{
	//$Pcs2("#spantabel2").html(data)
	axc=$Pcs2("#mnid").val();
	//alert("masuk di refreshgrid2 --" + axc)
	mser="&mnid="+$Pcs2("#mnid").val();
	$Pcs2.ajax(
	{
		type:"POST",
		chace : true,
		context: document.body,
		global : false,
		isLocal : true,
		processData : false,
		type : 'GET',
		url:"grids/gridbeli.php",
		data : "mTform=transbeli1"+mser,
		async: true,
		success : function(data)
		{
			$Pcs2("#spantabel2").html(data)
			$Pcs2("#mtotal").val(tra(mgg.total))
			$Pcs2("#mongkos").val(tra(mgg.ongkos))
			$Pcs2("#mtunai").val(tra(mgg.tunai))
			$Pcs2("#mhutang").val(tra(mgg.jumlah))
			$Pcs2("#mctunai").attr('checked', false)
			if (mgg.jumlah==0)
			{
				$Pcs2("#mctunai").attr('checked', true)
			}
			$Pcs2("#mjt").val(baliktanggal2(mgg.tgljt))
		}
	});
}

function baru(mgdn)
{
	mnid=$Pcs2("#mnid").val()
	datasx=taptabel("transbeli1", "nid", "nid='"+mnid+"' and status=2")

	$Pcs2("#mtgl").val("")
	$Pcs2("#mnid").val("")
	$Pcs2("#mkarid").val("")
	$Pcs2("#msupid").val("")
	$Pcs2("#mfakturid").val("")
	$Pcs2("#msupnama").val("")
	$Pcs2("#mket").val("")
	refreshgrid2()

	$Pcs2("#mtgl").val(tglsekarang());

	// datas=taptabel("transbeli1", "nid", "1=1 order by nid desc limit 0, 1")
	// data=datas.nid;

	// if (data!=undefined)
	// {
	// 	mmmerkid=data.substr(2, 7);
	// 	//alert(mmmerkid);
	// 	mmmerkid=parseFloat(mmmerkid);
	// 	//alert(mmmerkid);
	// 	mmmerkid=mmmerkid+1;
	// 	mmmerkid=''+mmmerkid
	// 	mmmerkid='TB'+padl(mmmerkid, '0', 7);
	// }
	// else
	// {
	// 	mmmerkid='TB0000001';
	// }

	// $Pcs2("#mnid").val(mmmerkid);
	// execajaxas("delete from transbeli1 where nid='"+mmmerkid+"'")
	// execajaxas("delete from transbeli2 where nid='"+mmmerkid+"'")
	// execajaxas("delete from bkbesar where nid='"+mmmerkid+"'")
	$Pcs2("#mfakturid").focus()
	mlkk=taptabel("setlok","lokid,loknama","lokid='L001' order by lokid limit 0,1")
	$Pcs2("#mlokid").val(mlkk.lokid)
	$Pcs2("#mloknama").val(mlkk.loknama)

	mcomm=''
	mordd=''
	mffff=''
	mstokall=''
	mplafon=0
}

function ambilstok(theid)
{
	mmid=theid.id
	misi=theid.value

	rownama=mmid.replace('12','13')

	if (misi=='')
	{
		geserdata(theid)
		return;
	}

	if ($Pcs2("#"+rownama).val()!='')
	{
		return;
	}

	rowsat1=mmid.replace('12','15')
	rowsat2=mmid.replace('12','17')
	rowsat3=mmid.replace('12','19')
	rowsat4=mmid.replace('12','21')
	rowqty=mmid.replace('12','14')
	rowunit=mmid.replace('12','16')
	rowextra=mmid.replace('12','18')
	rowextraunit=mmid.replace('12','20')
	rowhrg=mmid.replace('12','22')
	rownom=mmid.replace('12','11')
	rowisi=mmid.replace('12','misi')
	$Pcs2("#"+rownama).val("")
	$Pcs2("#"+rowsat1).val("")

	mnnm=toval(mmid.replace('12_',''))
	for (ggt=1;ggt<101;ggt++)
	{
		msst=$Pcs2("#12_"+ggt).val()
		mnama=$Pcs2("#13_"+ggt).val()

		if (misi!='' && ggt!=mnnm && misi==msst)
		{
			malert="STOK "+misi+" "+mnama+" SUDAH DIINPUT !"
			$Pcs2("#spanket").html(malert)

			theid.value=''
			theid.focus()
			theid.select()
			$Pcs2("#"+mmid).select()
			return;
		}
	}

	mstok=taptabel("setstok", "stoid, stonama, satuan1, satuan2, satuan3, format(hrgbeli, 0) hrgbeli, isi", " stoid='"+misi+"' or barcode='"+misi+"' or barcode2='"+misi+"' ")

	if (mstok.stonama!=undefined)
	{
		$Pcs2("#"+mmid).val(mstok.stoid)
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowsat2).val(mstok.satuan2)
		$Pcs2("#"+rowsat3).val(mstok.satuan1)
		$Pcs2("#"+rowsat4).val(mstok.satuan2)
		$Pcs2("#"+rowhrg).val(mstok.hrgbeli)
		$Pcs2("#"+rowisi).val(mstok.isi)
		mnn=$Pcs2("#"+rownom).val()
		mnn=mnn.replace('.','')
		mnn=padl(mnn,'0',2)
		getNextElement2(theid).focus()
	}
	rumus1()
}

function geserdata(theid)
{
	mid=theid.id
	maa=toval(mid.replace('12_',''))
	for (abc=maa;abc<101;abc++)
	{
		def=abc+1

		misix=$Pcs2("#misi_"+def).val()
		$Pcs2("#misi_"+abc).val(misix)

		for (axx=12;axx<25;axx++)
		{
			misi=$Pcs2("#"+axx+"_"+def).val()

			if (misi==undefined)
			{
				break;
			}

			$Pcs2("#"+axx+"_"+abc).val(misi)
		}
	}
}

function rumus1()
{
	mj1=0
	mj2=0
	mstokall=''
	for (gg=1;gg<100;gg++)
	{
		if ($Pcs2("#12_"+gg).val()!='')
		{
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())

			mextra=toval($Pcs2("#18_"+gg).val())
			mextraunit=toval($Pcs2("#20_"+gg).val())

			misi=toval($Pcs2("#misi_"+gg).val())
			//$Pcs2("#mket").val(misi)
			mhrg=toval($Pcs2("#22_"+gg).val())
			mdis=mhrg*toval($Pcs2("#23_"+gg).val())*0.01
			mhrg=(mhrg-mdis)/misi

			mjmlhrg=((mqty*misi)+munit)*mhrg
			mjmlhrg=Math.round(mjmlhrg,0)

			$Pcs2("#24_"+gg).val(tra(mjmlhrg))

			mnii=$Pcs2("#24_"+gg).val()
			mj1=mj1+toval(mnii)
			mstokall=mstokall+"'"+$Pcs2("#12_"+gg).val()+"',"
		}
	}
	mstokall=mstokall+"'axxxff'"
	$Pcs2("#mtotal").val(tra(mj1))
	mong=toval($Pcs2("#mongkos").val())
	mkk=mj1-mong
	mcck=$Pcs2("#mctunai").attr("checked")

	if (toval($Pcs2("#mtunai").val())==mkk)
	{
		$Pcs2("#mtunai").val('0')
	}

	if (mcck)
	{
		$Pcs2("#mtunai").val(tra(mkk))
	}

	mtun=toval($Pcs2("#mtunai").val())
	$Pcs2("#mhutang").val(tra(mj1-(mong+mtun)))
	if (tra(mj1-(mong+mtun))==0)
	{
		$Pcs2("#mjt").val("")
	}
	else
	{
		/*msup=$Pcs2("#msupid").val()
		datas=taptabel("setsup","supid,supnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","supid='"+msup+"'")
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))
		*/
	}
}

function ceksaldo(theid)
{
	mdidi=theid.id
	mqty=toval(theid.value)
	mdidi2=mdidi.replace("15","12")
	mstoid=$Pcs2("#"+mdidi2).val()
	mgh=taptabel("bkbesar","sum(qtyin-qtyout) saldo","bpid='"+mstoid+"'")
	if (mqty>mgh.saldo)
	{
		malert="Stok Tidak Mencukup ! Saldo :"+mgh.saldo
		$Pcs2("#spanket").html(malert)

		theid.value=0;
		return;
	}
}
/////akhir function
</script>
</head>

<body style="font-size: 90%; font-family: arial; background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<form id="fform" name="fform">
	<table border="0" style="color: white; font-family: Arial; font-weight: bold" width="100%">
		<tr>
			<td>Tgl. </td>
			<td>:&nbsp;<input id="mtgl" size="10" type="text"></td>
			<td>Kode </td>
			<td>: <input id="mnid" size="10" type="text"><input id="lookmnid" type="button" value="F5"></td>
		</tr>
		<tr>
			<td>No Faktur Pajak </td>
			<td>: <input id="mfakturid" size="20" type="text"></td>
			<td>Suplier </td>
			<td colspan="5">: <input id="msupid" size="5" type="text"><input id="lookmsupid" type="button" value="F5"><input id="msupnama" disabled size="45" type="text">&nbsp;&nbsp;&nbsp; 
			Lokasi : <input id="mlokid" size="5" type="text" value="01"><input id="looklok" type="button" value="F5"><input id="mloknama" disabled size="15" type="text">
			</td>
		</tr>
		<tr>
			<td>Catatan </td>
			<td colspan="5">: <input id="mket" size="130" type="text"></td>
		</tr>
	</table>
	<table border="0" style="color: white; font-family: Arial; font-weight: bold" width="100%">
		<tr>
			<td colspan="1" valign="top">
			<span id="spantabel2" style="color: black; font-family: Arial">
			</span></td>
		</tr>
	</table>
	<input id="btnsimpan" type="button" value="F1-Simpan">
	<input id="btnbaru" type="button" value="F2-Baru">
	<input id="btnhapus" type="button" value="F3-Hapus">
	<input id="btnkeluar" type="button" value="F12-Keluar">
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center><iframe id="framehrg" height="450" width="100%"></iframe>
		</center></div>
</form>

</body>

</html>
