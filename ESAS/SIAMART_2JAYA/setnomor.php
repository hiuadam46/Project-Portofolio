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
<title>promo</title>
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
		width : 400,
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
		datas=taptabel("transnomor","peruid","1=1 order by peruid desc limit 1");
		data=datas.peruid;

		if (data!=undefined)
		{
			mmperuid=data.substr(1,5);
			//alert(mmperuid);
			mmperuid=parseFloat(mmperuid);
			//alert(mmperuid);
			mmperuid=mmperuid+1;
			mmperuid=''+mmperuid
			mmperuid='G'+padl(mmperuid,'0',3);
		}
		else
		{
			mmperuid='G001';
		}
		fsetstok.mperuid.value=mmperuid;

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
		var isi=tableGrid1.getValueAt(1,mm);
		//fsetstok.mperuid.enabled=true;

		$Pcs2("#kotakdialog").dialog('open');
		dialogisopen=true;

		fsetstok.mperuid.value=isi;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php", 
			data: "func=EXEC&field=*&tabel=transnomor&kondisi=(peruid='"+isi+"')",
			dataType:'json',
			success: function(data)
			{
				maj=document.getElementById("mperuid")

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
		maj=document.getElementById("mperuid")
		msu=$Pcs2("#mperuid").val()
		execajaxas("delete from transnomor")
		execajaxas("insert into transnomor (peruid) values('"+msu+"')")

		for (var mii=1;mii<30;mii++)
		{
			maj=getNextElement(maj)
			mtp=maj.type
			if (mtp=='text')
			{
				mfieldna=maj.id.substr(1,100)
				execajaxa("update transnomor set "+mfieldna+"='"+maj.value+"'")
			}
		}

		alert("Data Tersimpan !")
	});

	$Pcs2("#btnhapus").click(function()
	{
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false)
		{
			return
		}

		mperuid=fsetstok.mperuid.value;
		$Pcs2.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from transnomor where peruid='"+mperuid+"'",
			//dataType:'json',
			success: function(data)
			{
				if(data==1)
				{
					tableGrid1.refresh(0,0,true);
				}
			}
		})
		execajaxa("delete from bkbesar where bpid='"+mperuid+"'")
		execajaxs("mTransaksixx=tosald00231")
		focustogrid(0,0);
		$Pcs2("#kotakdialog").dialog('close');
		dialogisopen=false;
	});

	$Pcs2("#btnsaldo").click(function()
	{
		$Pcs2("#framehrg").attr('src','setsaldosat.php')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Hutang');
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkontak").click(function()
	{
		$Pcs2("#framehrg").attr('src','setkontak.php');
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak promo '+$Pcs2("#msatnama").val());
		$Pcs2("#kotakdialog2").dialog('open');
		dialogisopen=true;
	})

	$Pcs2("#btnkeluar").click(function()
	{
		self.close()
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
	//tableGrid1.request="msql=select * from transnomor where (concat(peruid,satnama,rekid) like '!!"+mfilt+"!!') order by peruid"
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
		$Pcs2(".trtr").css("background-color","transparent")
		$Pcs2("#tr"+mmnn).css("background-color","green")
	})
	$Pcs2(".fieldna2").focus(function()
	{
		mmnn=document.activeElement.id
		$Pcs2(".trtr").css("background-color","transparent")
		$Pcs2("#tr"+mmnn).css("background-color","green")
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
		window.open("isilaporan.php?mLapo=mSetup&mtabelnya=transnomor&detitle=Master promo<br>")
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
		title: 'Daftar promo',
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
			id : 'peruid',
			title : 'Kode',
			width : 80,
			editable: false,
		},
		{
			id : 'grpnama',
			title : 'Nama',
			width : 150,
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
	request: "msql=select a.*,b.reknama,true as edit from transnomor a left join setrek b on a.rekid=b.rekid where (1=1) order by peruid"
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
	//window.location='transnomor.php?mperuid='+isi;
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
<form id="fsetstok" style="color: white; font-family: Arial">
	Identitas Program<hr>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
<?php
$msql="
SELECT COLUMN_NAME kolom, DATA_TYPE tipe, NUMERIC_PRECISION panjang1, CHARACTER_MAXIMUM_LENGTH panjang2, COLUMN_COMMENT koment
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA='siamart_2jaya_data' and TABLE_NAME='transnomor' and COLUMN_COMMENT <>''
order by COLUMN_COMMENT
";

$rww=executerow($msql);
$mnom=1;
while ($row=mysql_fetch_assoc($rww))
{
	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{
		$mpand=60;
	}
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';

	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
		$mtpe=" style='font-size:10pt;text-align:right' class='fieldna2'";
	}

	$query535=executerow("select $row[kolom] as pro from transnomor");
	$eert=mysql_fetch_assoc ($query535);
	
	echo "
		<tr>
	";
	echo "
			<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>
	";
	echo "&nbsp;".substr($row[koment],2,100)."";
	if ($row[kolom]=='peruid2')
	{
		echo "<hr>";
	}
	echo "
			</td>
	";
	echo "
			<td>
	";
	echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod value='$eert[pro]'>";

	if ($row[kolom]=='peruid2')
	{
		echo "<hr>";
	}

	echo "
			</td>
	";
	echo "
		</tr>
	";
	$mnom++;
}
?>
	</table>
	<hr><input id="btnsimpan" type="button" value="Simpan">
	<input id="btnkeluar" type="button" value="Tutup">
</form>

</body>

</html>