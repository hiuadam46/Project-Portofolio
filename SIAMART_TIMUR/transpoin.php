<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_timur_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
	echo "<script> window.location='index.php' </script>";
}
$hakedit=$rrwx[edit];
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Penukaran Poin</title>
<link href="themes/sunny/ui.all.css" rel="stylesheet" type="text/css">
<link href="css/form-field-tooltip.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript"></script>
<script src="js/jquery-1.3.2.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/rounded-corners.js" type="text/javascript"></script>
<script src="js/form-field-tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
var mvv=15;
var mws=screen.width
var mcomm
var mordd
var mffff
var mharga=3
var msatuan=2
var mkass='<?php echo $_SESSION['MANA']; ?>'
var midkasir='<?php echo $_SESSION['MASUK']; ?>'
var hakedit='<?php echo $hakedit; ?>'

$Pcs2(document).ready(function()
{
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	
	baru();
	
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
			
		},
	});
	
	$Pcs2(document).keypress(function()
	{
		mmv=event.keyCode
		mac=event.element(event).id;
		if (event.which!=0)
		{
			return;
		};

		if (event.which!=0)
		{
			return;
		}
		
		if (mmv==116)
		{
			$Pcs2('#look'+mac).click()
		}
		
		if (mmv==122)
		{
			$Pcs2('#btnmember').click();
		}

		if (mmv==123)
		{
			$Pcs2('#btnkeluar').click();
		}
	})
	
	$Pcs2(document).keyup(function()
	{
		if (event.keyCode==35)
		{
			$Pcs2("#btntukar").click();
		}
	})
	
	$Pcs2("#mlgnid").blur(function()
	{
		datas=taptabel("setlgn", "lgnid, lgnnama, golongan", "lgnid='"+this.value+"'");
		$Pcs2("#mlgnid").val("");
		$Pcs2("#mlgnnama").val("");
		$Pcs2("#mgolongan").val("");
		if (datas.lgnid!=undefined)
		{
			$Pcs2("#mlgnid").val(datas.lgnid);
			$Pcs2("#mlgnnama").val(datas.lgnnama);
			$Pcs2("#mgolongan").val(datas.golongan);
		}
		
		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"', '%d-%c-%Y')";
		datap=taptabel("transpoin1", "sum(poin_d-poin_k) spoin", "lgnid='"+this.value+"' and tgl<="+mtgl+"");
		//alert(datap.spoin);
		if(datap.spoin==null)
		{
			datap.spoin='0';
		}
		
		mpoin=parseFloat(datap.spoin).toFixed(0);
		$Pcs2("#spantabel2").html('<span style="font-size:12pt">Saldo Poin Pelanggan :</span><br><span style="font-size:82pt">'+mpoin+'</span>');
		$Pcs2("#mjumlah").val(mpoin);
		$Pcs2("#mtukar").val(0);
		$Pcs2("#msisa").val(mpoin);
		
		$Pcs2("#mnid").val('');
		$Pcs2("#mtgl").val(tglsekarang());
		mjj=jam();
		$Pcs2("#mjam").val(mjj);
	});

	$Pcs2("#mnid").blur(function()
	{
		mnid=$Pcs2("#mnid").val();
		mgg=taptabel('transpoin1', '*', 'nid="'+mnid+'"');
		
		if (mgg.nid!=undefined)
		{
			$Pcs2('#mlgnid').val(mgg.lgnid);
			$Pcs2('#mlgnid').blur();
			
			$Pcs2("#mnid").val(mnid);
			$Pcs2('#mtgl').val(baliktanggal2(mgg.tgl));
			
			$Pcs2('#mtukar').val(parseFloat(mgg.poin_k).toFixed(0));
			
			mjumlah=$Pcs2("#mjumlah").val();
			mtukar=$Pcs2('#mtukar').val();
			mpoin=parseInt(mjumlah)+parseInt(mtukar);
			$Pcs2("#spantabel2").html('<span style="font-size:12pt">Saldo Poin Pelanggan :</span><br><span style="font-size:82pt">'+mpoin+'</span>');
			$Pcs2("#mjumlah").val(mpoin);
			
			hitung();
		}
	})
	
	$Pcs2("#lookmnid").click(function()
	{
		mcomm='Select nid Nota, date_format(tgl, "%d-%m-%Y") Tgl, left(lgnnama, 16) Pelanggan from transpoin1 a left join setlgn b on a.lgnid=b.lgnid where a.nid like "TP%" ';
		
		mordd='Nota';
		mffff=' concat(nid, date_format(tgl, "%d-%m-%Y"), ifnull(lgnnama, "")) ';

		$Pcs2('#framehrg').attr('src', 'genlookup.php?mobj=mnid');
		$Pcs2('#kotakdialog2').dialog('option', 'title', 'Lookup Transaksi Penukaran Poin');
		$Pcs2('#kotakdialog2').dialog('open');
		$Pcs2('#kotakdialog2').click();
		$Pcs2('#framehrg').contentWindow.focus();
	})
	
	$Pcs2("#btntukar").click(function()
	{
		//$Pcs2("#mtukar").focus();
		$Pcs2("#mtukar").select();
	})
	
	$Pcs2("#btnsimpan").click(function()
	{
		mjumlah=$Pcs2("#mjumlah").val();
		if(mjumlah=='0')
		{
			alert('Jumlah Poin 0, tidak dapat disimpan...');
			return;
		}
		mtukar=$Pcs2("#mtukar").val();
		if(mtukar=='0')
		{
			alert('Silahkan isi besar Poin yang ingin ditukar...');
			$Pcs2("#mtukar").select();
			return;
		}
		msisa=$Pcs2("#msisa").val();
		if(parseInt(msisa)<0)
		{
			alert('Besar Poin yang ditukar lebih besar dari Jumlah Poin...');
			$Pcs2("#mtukar").select();
			return;
		}
		
		mnid=$Pcs2("#mnid").val();
		if (mnid=='')
		{
			datpo=taptabel('transpoin1', 'nid', 'nid like "TP%" order by nid desc limit 0, 1');
			data=datpo.nid;
			//alert(data);
			if (data!=undefined)
			{
				mmmerkid=data.substr(2,7);
				//alert(mmmerkid);
				mmmerkid=parseFloat(mmmerkid);
				//alert(mmmerkid);
				mmmerkid=mmmerkid+1;
				mmmerkid=''+mmmerkid;
				mmmerkid='TP'+padl(mmmerkid, '0', 7);
			}
			else
			{
				mmmerkid='TP0000001';
			}
			
			$Pcs2("#mnid").val(mmmerkid);
			mnid=mmmerkid;
		}
		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')";
		mlgnid=$Pcs2("#mlgnid").val();
		mtukar=$Pcs2("#mtukar").val();
		execajaxas('DELETE FROM transpoin1 where nid="'+mnid+'"');
		mq1='insert into transpoin1(tgl, lgnid, nid, poin_k) ';
		mq2=' values('+mtgl+', "'+mlgnid+'", "'+mnid+'", "'+mtukar+'")';
		execajaxas(mq1+mq2);
		xxw=window.open('printppoin.php', 'aa', ('alwaysraised=yes, scrollbars=no, resizable=no, width=450, height=400, left=600, top=10'));
		xxw.focus();
		alert("Nota No. "+mnid+" telah Tersimpan !");
		baru();
	})
	
	$Pcs2("#btnkeluar").click(function()
	{
		baru();
	})
	
	$Pcs2("#btnhapus").click(function()
	{
		mnid=$Pcs2("#mnid").val();
		if(mnid=='')
		{
			alert('Tidak ada Nota yang perlu dihapus...');
			baru();
			return;
		}
		mconf=confirm('Menghapus Nota No. '+mnid+'?');
		if (mconf==false)
		{
			return;
		}
		execajaxas('DELETE FROM transpoin1 where nid="'+mnid+'"');
		alert("Nota Terhapus !");
		baru();
	})

	$Pcs2("#btnmember").click(function()
	{
		query1="select rpad(lgnid,12,' ') Kode,left(lgnnama,30) Nama,rpad(golongan,12,' ') Gol from setlgn "
		query2=" where true "

		mcomm=query1+query2

		mordd="lgnid"
		mffff=" concat(lgnnama,lgnid) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	})
	
	$Pcs2("#mtukar").keyup(function()
	{
		hitung();
	})
	
	$Pcs2("#msisa").keyup(function()
	{
		hitung();
	})
	
	$Pcs2("#mtab1").keydown(function()
	{
		BlurOnEnter();
	})
});

///awal functions
function baru()
{
	document.fform.reset();
	$Pcs2("#mtgl").val(tglsekarang());
	$Pcs2("#mnid").val("");
	$Pcs2("#mlgnid").val("");
	$Pcs2("#mlgnnama").val("");
	$Pcs2("#mkasir").val('<?php echo $_SESSION['MASUK']; ?>');
	mjj=jam();
	$Pcs2("#mjam").val(mjj);
	
	$Pcs2("#mjumlah").val(0);
	$Pcs2("#mtukar").val(0);
	$Pcs2("#msisa").val(0);
	$Pcs2("#spantabel2").html('<span style="font-size:12pt">Untuk memulai silahkan tekan Tombol :</span><br>'+'<span style="font-size:82pt">F11</span>');
}

function hitung()
{
	mjumlah=$Pcs2("#mjumlah").val();
	mtukar=$Pcs2("#mtukar").val();
	$Pcs2("#msisa").val(mjumlah-mtukar);
}

function BlurOnEnter()
{
	mfield=event.element(event);
	if(event.keyCode==13 && mfield.type!='button')
	{
		//getNextElement(mfield).focus();
		getNextElement(mfield).select();
	}
}

function fokes(theee)
{
	$Pcs2("#"+theee.id).css("background-color","lightgreen")
}

function lostfokes(theee)
{
	$Pcs2("#"+theee.id).css("background-color","white")
}

/////akhir function
</script>
</head>

<body style="font-size: 90%; font-family: arial; background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<form id="fform" name="fform">
	<table border="0" style="border-collapse: ; color: white; font-family: Arial; font-weight: bold" width="100%">
		<tr>
			<td align="left" colspan="3">&nbsp;Tgl. :
			<input id="mtgl" readonly size="10" style="font-weight: bold" type="text">&nbsp; 
			Nota :
			<input id="mnid" readonly size="10" style="font-weight: bold" type="text"><input id="lookmnid" type="button" value="F5">&nbsp; 
			Kasir :
			<input id="mkasir" disabled readonly size="10" style="font-weight: bold" type="text">&nbsp; 
			Jam :
			<input id="mjam" disabled readonly size="8" style="font-weight: bold" type="text">&nbsp; 
			Member :
			<input id="mlgnid" readonly size="5" style="font-weight: bold" type="text"><input id="mgolongan" readonly size="1" style="font-weight: bold" type="text"><input id="mlgnnama" readonly size="25" style="font-weight: bold" type="text">
			<hr></td>
		</tr>
		<tr>
			<td style="width: 75%; vertical-align: middle; border-style: solid; border-color: green; border-width: medium; background-color:white;text-align:center">
			<span id="spantabel2" style="color: black; font-family: Arial">
			</span></td>
			<td align="right" style="background-color: orange" valign="top">
			<table id="mtab1" border="0" style="font-size: 12pt; background-color: #A52A2A;color:white" width="100%">
				<tr>
					<td>Jumlah Poin&nbsp;
					<input id="mjumlah" onkeyup="" readonly size="10" style="text-align: right; font-weight: bold; font-size: 16pt" type="text" name="mjumlah"></td>
				</tr>
				<tr>
					<td>Poin ditukar&nbsp;
					<input id="mtukar" onblur="lostfokes(this)" onfocus="fokes(this)" onkeyup="" size="10" style="text-align: right; font-weight: bold; font-size: 24pt" type="text" name="mtukar" tabindex="1"></td>
				</tr>
				<tr>
					<td><hr></td>
				</tr>
				<tr>
					<td>Saldo Poin&nbsp;
					<input id="msisa" onblur="lostfokes(this)" onfocus="fokes(this)" size="10" style="text-align: right; font-weight: bold; font-size: 24pt" type="text" name="msisa" tabindex="2"></td>
				</tr>
				<tr>
					<td align="center"><hr>
					<input id="btnsimpan" type="button" value="Simpan" tabindex="3"><br></td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
</form>
<input id="btntukar" type="button" value="End-Tukar">
<input id="btnsp" style="display: none" type="button" value="F7-Sp">
<input id="btnmember" type="button" value="F11-Member">
<input id="btnkeluar" type="button" value="F12-Baru">
<input id="btnganti" type="button" value="Ctrl+Tab-Ganti Antrian">
<?php
if ($hakedit==1)
{
	echo '
<input type="button" value="Hapus" id="btnhapus">
	';
}
?>
<div id="kotakdialog2" title="Setup Pelanggan">
	<center><iframe id="framehrg" height="450" width="100%"></iframe></center>
</div>

</body>

</html>
