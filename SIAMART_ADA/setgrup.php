<?php
ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_ada_data',$links);
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
<title>Grup</title>
<link href="themes/le-frog/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
var baru=true;
$Pcs2(document).ready(function()
{
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
			tableGrid1.refresh(0, mm, true);
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
		width : 470,
		overflow: scroll,
		close : function()
		{
			$Pcs2("#framehrg").attr('src', '');
			mm=tableGrid1.keys._yCurrentPos;
			tableGrid1.refresh(0, mm, true);
		},
	});

	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 300,
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
		datas=taptabel("setgrp", "grpid", "1=1 order by grpid desc limit 1");
		data=datas.grpid;

		if (data!=undefined)
		{
			mmgrpid=data.substr(1, 5);
			//alert(mmgrpid);
			mmgrpid=parseFloat(mmgrpid);
			//alert(mmgrpid);
			mmgrpid=mmgrpid+1;
			mmgrpid=''+mmgrpid
			mmgrpid='G'+padl(mmgrpid, '0', 3);
		}
		else
		{
			mmgrpid='G001';
		}
		fsetstok.mgrpid.value=mmgrpid;

		fsetstok.mgrpnama.focus();
		fsetstok.mgrpnama.select();
		$Pcs2("#msatnama").click()
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
		var isi=tableGrid1.getValueAt(1, mm);
		//fsetstok.mgrpid.enabled=true;

		$Pcs2("#kotakdialog").dialog('open');
		dialogisopen=true;

		fsetstok.mgrpid.value=isi;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=EXEC&field=*&tabel=setgrp&kondisi=(grpid='"+isi+"')",
			dataType:'json',
			success: function(data)
			{
				maj=document.getElementById("mgrpid")

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
		fsetstok.mgrpnama.focus();
		fsetstok.mgrpnama.select();
	});

	$Pcs2("#btnsimpan").click(function()
	{
		maj=document.getElementById("mgrpid")
		msu=$Pcs2("#mgrpid").val()
		execajaxas("delete from setgrp where grpid='"+msu+"'")
		execajaxa("insert into setgrp (grpid, grpnama, rekid, diskon, poin_rp) values('"+msu+"', '"+$Pcs2("#mgrpnama").val()+"', '"+$Pcs2("#mrekid").val()+"', '"+$Pcs2("#mdiskon").val()+"', '"+$Pcs2("#mpoin_rp").val().replace(',', '').replace(',', '').replace(',', '')+"')");

		alert("Data Tersimpan !")
		//$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		$Pcs2("#tambah").click();
		return;
	});

	$Pcs2("#btnhapus").click(function()
	{
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false)
		{
			return
		}

		mgrpid=fsetstok.mgrpid.value;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setgrp where grpid='"+mgrpid+"'",
			//dataType:'json',
			success: function(data)
			{
				if(data==1)
				{
					tableGrid1.refresh(0, 0, true);
				}
			}
		})
		execajaxa("delete from bkbesar where bpid='"+mgrpid+"'")
		execajaxs("mTransaksixx=tosald00231")
		focustogrid(0, 0);
		$Pcs2("#kotakdialog").dialog('close');
		dialogisopen=false;
	});

	$Pcs2("#btnsaldo").click(function()
	{
		$Pcs2("#framehrg").attr('src', 'setsaldosat.php')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Hutang');
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkontak").click(function()
	{
		$Pcs2("#framehrg").attr('src','setkontak.php');
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak Grup '+$Pcs2("#msatnama").val());
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkeluar").click(function()
	{
		tableGrid1.refresh(0, 0, true);
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

	/* $Pcs2("#tcari").keyup(function()
	{
		var mfilt=tcari.value;
		mfilt=mfilt.trim();
		alert(mfilt);
		tableGrid1.request="msql=select * from setgrp where (concat(grpid, satnama, rekid) like '!!"+mfilt+"!!') order by grpid"
		tableGrid1.refresh()
	}); */

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
			focustogrid(0, 0);
		}
	})

	$Pcs2("#tcetak").click(function()
	{
		window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setgrp&detitle=Master Grup<br>")
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
		title: 'Daftar Grup',
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
			id : 'grpid',
			title : 'Kode',
			width : 80,
			editable: false,
		},
		{
			id : 'grpnama',
			title : 'Nama',
			width : 180,
			editable: false,
		},
		{
			id : 'poin_rp_num',
			title : 'Nominal Poin',
			width : 80,
			type : 'number',
			editable: false,
		},
		{
			id : 'diskon',
			title : 'Diskon %',
			width : 80,
			type : 'number',
			editable: false,
		},
		{
			id : 'rekid',
			title : 'Rek.',
			width : 80,
			editable: false,
		},
		{
			id : 'reknama',
			title : 'Nama Rek.',
			width : 280,
			editable: false,
		},
	],
	url: "item.php",
	request: "msql=select a.*, format(poin_rp, 0) poin_rp_num, b.reknama, true as edit from setgrp a left join setrek b on a.rekid=b.rekid where (1=1) order by grpid"
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
	//window.location='setgrp.php?mgrpid='+isi;
	//cell = tableGrid1.keys.getCellFromCoords(1,1);
	//tableGrid1.keys.setFocus(cell);
	//mytable1.select();
	//$Pcs("#kotakdialog").dialog('open');
}

function focustogrid(xx, yy)
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
<table style="color: white; font-family: Arial; width: 100%">
	<tr>
		<td><b>C a r i : <input id="tcari" size="47" type="text"> </b></td>
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
<div id="kotakdialog" title="Setup Grup">
	<form id="fsetstok" name="fsetstok">
		<table border="0" cellpadding="0" cellspacing="0" style="font-size: 14pt" width="100%">
<?php
$msql="
SELECT COLUMN_NAME kolom, DATA_TYPE tipe, NUMERIC_PRECISION panjang1, CHARACTER_MAXIMUM_LENGTH panjang2, COLUMN_COMMENT koment
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA='siamart_ada_data' and TABLE_NAME='setgrp' and COLUMN_COMMENT <>''
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
	$mpand=20;
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';

	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
		$mtpe=" style='font-size:10pt;text-align:right' class='fieldna2'";
	}

	if (($row[kolom])=='grpid')
	{
		$mrod='readonly';
	}

	echo "
			<tr>
	";
	echo "
				<td width=27% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>
	";
	echo '&nbsp;'.substr($row[koment],2,100);
	echo "
				</td>
	";
	echo "
				<td>
	";

	if (($row[kolom])=='rekid')
	{
		echo ": <select id='m".$row[kolom]."' $mtpe $mrod disabled>";
		$mrr=executerow("select rekid misi, concat(rekid, ' ', reknama) mtampil from setrek where nrcid='103' order by misi");
		while ($row=mysql_fetch_assoc($mrr))
		{
			echo ("<option value='$row[misi]'>$row[mtampil]</option>");
		}
		echo "</select>";
	}
	else
	{
		echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod >";
	}

	echo "
				</td>
	";
	echo "
			</tr>
	";
}
?>
		</table>
		<hr><input id="btnsimpan" type="button" value="Simpan">
		<input id="btnhapus" type="button" value="Hapus">
		<input id="btnkeluar" type="button" value="Tutup">
	</form>
</div>
<div id="kotakdialog2" title="Setup Pelanggan">
	<center><iframe id="framehrg" height="400" width="100%"></iframe></center>
</div>

</body>

</html>
