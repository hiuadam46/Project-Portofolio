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
<title>Suplier</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
$Pcs2(document).ready(function()
{
	execajaxas(" alter table setsup add kontak char(50) default '' comment '16Kontak Person' ")

	$Pcs2(document).keydown(function()
	{
		var mmv=event.keyCode
		mmf=tableGrid1.keys.thefocus;
		mmf2=Event.element(event).id;
		//alert(event.ctrlKey);

		if (mmv==112)
		{
			$Pcs2("#tcari").focus();
		}
		if (mmv==113)
		{
			$Pcs2("#buka").click();
		}
		if (mmv==114)
		{
			$Pcs2("#tambah").click();
		}
		if (mmv==13)
		{
			if (mmf && mmf2!='tcari')
			{
				$Pcs2("#buka").click();
			}
		}
		if (mmv==27 && dialogisopen)
		{
			var mm=tableGrid1.keys._yCurrentPos;
			tableGrid1.refresh(0,mm,true);
			dialogisopen=false;
		}
	});

	$Pcs2("#kotakdialog").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 665,
		overflow: scroll,
		close : function()
		{
			$Pcs2("#framehrg").attr('src','');
			mm=tableGrid1.keys._yCurrentPos;
			tableGrid1.refresh(0,mm,true);
		},
	});

	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 850,
		close : function()
		{
			$Pcs2("#btnsimpan").focus();
		},
	});

	$Pcs2("#tambah").click(function()
	{
		fsetstok.btnsimpan.value='Simpan'
		$Pcs2("#kotakdialog").dialog('open');
		dialogisopen=true;
		fsetstok.reset();
		datas=taptabel("setsup", "supid", "1=1 order by supid desc limit 1");
		data=datas.supid;

		if (data!=undefined)
		{
			mmsupid=data.substr(1,5);
			//alert(mmsupid);
			mmsupid=parseFloat(mmsupid);
			//alert(mmsupid);
			mmsupid=mmsupid+1;
			mmsupid=''+mmsupid
			mmsupid='S'+padl(mmsupid,'0',3);
		}
		else
		{
			mmsupid='S001';
		}
		fsetstok.msupid.value=mmsupid;

		fsetstok.msupnama.focus();
		fsetstok.msupnama.select();
		$Pcs2("#msupnama").click()
	})

	$Pcs2("#buka").click(function()
	{
		mopp=$Pcs2("#kotakdialog").dialog("isOpen");
		if (mopp)
		{
			return
		};
		fsetstok.btnsimpan.value='Edit'
		var mm=tableGrid1.keys._yCurrentPos;
		var isi=tableGrid1.getValueAt(1,mm);
		fsetstok.msupid.enabled=true;
		$Pcs2("#kotakdialog").dialog('open');
		dialogisopen=true;

		fsetstok.msupid.value=isi;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=EXEC&field=*&tabel=setsup&kondisi=(supid='"+isi+"')",
			dataType:'json',
			success: function(data)
			{
				maj=document.getElementById("msupid")

				for (var mii=1;mii<30;mii++)
				{
					maj=getNextElement(maj)
					mid=maj.id.substr(1,30)
					mtp=$Pcs2("#"+maj.id).attr('class')
					if (mtp=='fieldna')
					{
						maj.value=data[mid]
					}
					if (mtp=='fieldna2')
					{
						maj.value=tra(data[mid])
					}
				}
			}
		});
		fsetstok.msupnama.focus();
		fsetstok.msupnama.select();
	});

	$Pcs2("#btnsimpan").click(function()
	{
		maj=document.getElementById("msupid")
		msu=$Pcs2("#msupid").val()

		majj=taptabel("setsup","supid","supid='"+msu+"'")

		mab='lama'
		if (majj.supid==undefined)
		{
			mab='baru'
		}

		execajaxas("delete from setsup where supid='"+msu+"'")
		execajaxas("insert into setsup (supid) values('"+msu+"')")

		for (var mii=1;mii<30;mii++)
		{
			maj=getNextElement(maj)
			mtp=$Pcs2("#"+maj.id).attr('class')
			if (mtp=='fieldna')
			{
				mfieldna=maj.id.substr(1,100)
				execajaxa("update setsup set "+mfieldna+'="'+maj.value+'" where supid="'+msu+'"')
			}
			if (mtp=='fieldna2')
			{
				mfieldna=maj.id.substr(1,100)
				execajaxa("update setsup set "+mfieldna+'="'+maj.value+'" where supid="'+msu+'"')
			}
		}

		alert("Data Tersimpan !")

		if (mab=='lama')
		{
			$Pcs2("#kotakdialog").dialog('close');
			dialogisopen=false;
		}
		else
		{
			$Pcs2("#tambah").click()
		}
		return;
	});

	$Pcs2("#btnhapus").click(function()
	{
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false)
		{
			return
		}

		msupid=fsetstok.msupid.value;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setsup where supid='"+msupid+"'",
			//dataType:'json',
			success: function(data)
			{
				if(data==1)
				{
					tableGrid1.refresh(0,0,true);
				}
			}
		})
		execajaxa("delete from bkbesar where bpid='"+msupid+"'")
		execajaxs("mTransaksixx=tosald00231")
		focustogrid(0,0);
		$Pcs2("#kotakdialog").dialog('close');
		dialogisopen=false;
	});

	$Pcs2("#btnsaldo").click(function()
	{
		$Pcs2("#framehrg").attr('src', 'setsaldosup.php?msupid='+$Pcs2("#msupid").val())
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Hutang');
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkontak").click(function()
	{
		$Pcs2("#framehrg").attr('src', 'setkontak.php');
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak suplier '+$Pcs2("#msupnama").val());
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkeluar").click(function()
	{
		tableGrid1.refresh(0,0,true);
		$Pcs2("#kotakdialog").dialog('close');
		dialogisopen=false;
	});

	$Pcs2("#tkeluar").click(function()
	{
		window.close();
	});

	$Pcs2("#tcetak").click(function()
	{
		//MenuIDMenuBar1.hide();
		//tombols.hide();
		//window.print()
		//MenuIDMenuBar1.show();
		//tombols.show();
	});

	//$Pcs2("#tcari").keyup(function() {
	//var mfilt=tcari.value;
	//mfilt=mfilt.trim();
	//alert(mfilt);
	//tableGrid1.request="msql=select * from setsup where (concat(supid, supnama, rekid) like '!!"+mfilt+"!!') order by supid"
	//tableGrid1.refresh()
	//});

	$Pcs2("#tcari").keyup(function()
	{
		var mfilt=tcari.value;
		mfilt=mfilt.trim();
		tableGrid1.request="mfilt="+mfilt
		tableGrid1.refresh()
	});

	var mws=screen.width
	var mhs=screen.height

	$Pcs2("#mytable1").css(
	{
		'position':'relative',
		'left':'0px',
		'height': mhs-280+'px',
		'background-color':'white',
		'font-size':'12',
	});

	var mws=screen.width
	$Pcs2("#setperxx").css(
	{
		'width': mws-680+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
	});

	$Pcs2("#fsetstok").keydown(function()
	{
		mmf2=Event.element(event);
		tabOnEnter (mmf2, event);
	})

	$Pcs2(".fieldna").focus(function()
	{
		mmnn=document.activeElement.id
		$Pcs2(".trtr").css("background-color", "transparent")
		$Pcs2("#tr"+mmnn).css("background-color", "green")
	})
	$Pcs2(".fieldna2").focus(function()
	{
		mmnn=document.activeElement.id
		$Pcs2(".trtr").css("background-color", "transparent")
		$Pcs2("#tr"+mmnn).css("background-color", "green")
	})
	$Pcs2(".fieldna2").keyup(function()
	{
		mmval=document.activeElement.value
		document.activeElement.value=tra(mmval)
	})

	$Pcs2("#tcari").keydown(function()
	{
		if (event.keyCode==13)
		{
			this.blur();
			focustogrid(0,0);
		}
	})

	$Pcs2("#tcetak").click(function()
	{
		window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setsup&detitle=Master Suplier<br>")
	})
});
</script>
<link href="css/mytablegrid.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link id="shTheme" href="css/shThemeRDark.css" rel="stylesheet" type="text/css">
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/scriptaculous.js" type="text/javascript"></script>
<script src="js/builder.js" type="text/javascript"></script>
<script src="js/effects.js" type="text/javascript"></script>
<script src="js/dragdrop.js" type="text/javascript"></script>
<script src="js/controls.js" type="text/javascript"></script>
<script src="js/slider.js" type="text/javascript"></script>
<script src="js/sound.js" type="text/javascript"></script>
<script src="js/mytablegrid.js" type="text/javascript"></script>
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/format.js" type="text/javascript"></script>
<script src="js/tablegrid.js" type="text/javascript"></script>
<script src="js/keytable.js" type="text/javascript"></script>
<script src="js/controls_002.js" type="text/javascript"></script>
<script src="js/shCore.js" type="text/javascript"></script>
<script src="js/shBrushJScript.js" type="text/javascript"></script>
<script src="js/shBrushXml.js" type="text/javascript"></script>
<script src="js/shBrushPlain.js" type="text/javascript"></script>
<script type="text/javascript">

// SyntaxHighlighter.config.clipboardSwf = '../scripts/highlighter/clipboard.swf';
// SyntaxHighlighter.all();

function toggleSampleCode(id, element)
{
	if ($Pcs(id).getStyle('display') == 'none')
	{
		Effect.BlindDown(id);
		element.innerHTML = 'Hide sample code';
	}
	else
	{
		Effect.BlindUp(id);
		element.innerHTML = 'See sample code';
	}
}

var countryList =
[
	{value: 'UK', text: 'United Kingdon'},
	{value: 'US', text: 'United States'},
	{value: 'CL', text: 'Chile'}
];

var mws=screen.width
var tableModel =
{
	options :
	{
		title: 'Daftar Suplier',
		rowClass : function(rowIdx)
		{
			var className = '';
			if (rowIdx % 2 == 0)
			{
				className = 'hightlight';
			}
			return className;
		},

		pager:
		{
			total: 100,
			pages: 1,
			currentPage: 1,
			from: 1,
			to: 100
		},
	},
	columnModel :
	[
		{
			id : 'nomor',
			title : 'No.',
			type: 'number',
			width : 40,
			editable: false,
		},
		{
			id : 'supid',
			title : 'Kode',
			width : 50,
			editable: false,
		},
		{
			id : 'supnama',
			title : 'Nama',
			width : 270,
			editable: false,
		},
		{
			id : 'alamat',
			title : 'Alamat',
			width : 390,
			editable: false,
		},
		{
			id : 'telp',
			title : 'Telpon',
			width : 150,
			editable: false,
		},
		{
			id : 'keterangan',
			title : 'Keterangan',
			width : 200,
			editable: false,
		},
	],
	url: "item.php?mTparam=smsp001",
	request: ""
};

var tableGrid1 = null;
window.onload = function()
{
	var $Pcs = jQuery.noConflict();
	tableGrid1 = new MyTableGrid(tableModel);
	tableGrid1.render('mytable1',true);
	$Pcs('contactLink').onclick = function()
	{
		if ($Pcs('contact').getStyle('display') == 'none')
		{
			Effect.BlindDown('contact');
		}
		else
		{
			Effect.BlindUp('contact');
		}
	};
};

window.onkeypress=function()
{
};

function proses()
{
	//var mm=tableGrid1.keys._yCurrentPos;
	//var isi=tableGrid1.getValueAt(1,mm);
	$Pcs("#buka").click();
	//alert(isi);
	//window.location='setsup.php?msupid='+isi;
	//cell = tableGrid1.keys.getCellFromCoords(1,1);
	//tableGrid1.keys.setFocus(cell);
	//mytable1.select();
	//$Pcs("#kotakdialog").dialog('open');
}

function focustogrid(xx,yy)
{
	cell = tableGrid1.keys.getCellFromCoords(xx,yy);
	tableGrid1.keys.setFocus(cell);
	tableGrid1.keys.captureKeys();
	tableGrid1.keys.eventFire("action", tableGrid1.keys._nCurrentFocus);
}
</script>
</head>

<body style="background-image: url('images/num.jpg')">

<?php
require("menu.php");
?>
<table style="width: 100%; color: white; font-family: Arial">
	<tr style="font-weight: bold">
		<td>C a r i :&nbsp;<input id="tcari" size="47" type="text"> </td>
	</tr>
</table>
<div id="mytable1">
</div>
<div id="tombols" style="position: Relative; left: 5px">
	<hr><input id="bCari" type="button" value="F1 = Cari">&nbsp;&nbsp;
	<input id="buka" type="button" value="F2/Enter = Edit">&nbsp;&nbsp;
	<input id="tambah" type="button" value="F3 = Baru">&nbsp;&nbsp;
	<input id="tcetak" type="button" value="F7 = Print">&nbsp;&nbsp;
	<input id="tkeluar" type="button" value="Tutup"> </div>
<div id="kotakdialog" title="Setup Suplier">
	<form id="fsetstok" name="fsetstok">
		<table border="0" cellpadding="0" cellspacing="0" style="font-size: 14pt" width="100%">
			<?php
$msql="
ALTER TABLE `setsup`
CHANGE `supid` `supid` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL COMMENT '10Kode',
CHANGE `kontak` `kontak` CHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT '' COMMENT '16Kontak Person'
";

//execute($msql);

$msql="
SELECT COLUMN_NAME kolom, DATA_TYPE tipe, NUMERIC_PRECISION panjang1, CHARACTER_MAXIMUM_LENGTH panjang2, COLUMN_COMMENT koment
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA='siamart_2jaya_data' and TABLE_NAME='setsup' and COLUMN_COMMENT<>'' and COLUMN_NAME in
(
	'supid', 'supnama', 'alamat', 'telp', 'tempo', 'kontak', 'keterangan', 'isppn'
)
order by COLUMN_COMMENT
";

$rww=executerow($msql);
while ($row=mysql_fetch_assoc($rww))
{
	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{
		$mpand=60;
	}
	$mpand=60;
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';

	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
		$mtpe=" style='font-size:10pt;text-align:right' class='fieldna2'";
	}

	if (($row[kolom])=='supid')
	{
		$mrod='readonly';
	}

	if (($row[kolom])=='tempo')
	{
		$mmax='3';
		$mpand='3';
	}

	$ketamb='';
	if (($row[kolom])=='tempo')
	{
		$ketamb='hari';
	}

	echo "
			<tr>
	";
	echo "
				<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>
	";
	echo "&nbsp;".substr($row[koment],2,100)."";
	echo "
				</td>
	";
	echo "
				<td>
	";
	if (($row[kolom])=='isppn')
	{
		echo "
		: <select id='misppn' $mtpe>
			<option value='PPN'>PPN</option>
			<option value='Non PPN'>Non PPN</option>
		</select>
		";
	}
	else
	{
		echo "
		: <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod >
		";
	}
	/* echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod >"; */
	echo " $ketamb
				</td>
	";
	echo "
			</tr>
	";
}
?>
		</table>
		<hr>&lt;<a id="btnsaldo" href=""><i>Awal Hutang</i></a>&gt;&nbsp;&nbsp;&nbsp;
		<input id="btnsimpan" type="button" value="Simpan">
		<input id="btnhapus" type="button" value="Hapus">
		<input id="btnkeluar" type="button" value="Tutup">
	</form>
</div>
<div id="kotakdialog2" title="Setup Pelanggan">
	<center><iframe id="framehrg" height="400" width="100%"></iframe></center>
</div>

</body>

</html>
