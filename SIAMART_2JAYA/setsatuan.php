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

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Kemasan</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script type="text/javascript">
	  var $Pcs2 = jQuery.noConflict();
	  var dialogisopen=false;
	$Pcs2(document).ready(function(){

	  $Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			mmf=tableGrid1.keys.thefocus;
			mmf2=Event.element(event).id;
			//alert(event.ctrlKey);

			if (mmv==112){$Pcs2("#tcari").focus();}
			if (mmv==113){$Pcs2("#buka").click();}
			if (mmv==114){$Pcs2("#tambah").click();}
			if (mmv==13){
			if (mmf && mmf2!='tcari'){$Pcs2("#buka").click();}
			}
			if (mmv==27 && dialogisopen){
			var mm=tableGrid1.keys._yCurrentPos;
			tableGrid1.refresh(0,mm,true);
			dialogisopen=false;
			}
			
		});
	  
        $Pcs2("#kotakdialog").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 350,
		  overflow: scroll,	
		  close : function(){
		  
		  $Pcs2("#framehrg").attr('src','');
		  mm=tableGrid1.keys._yCurrentPos;
		  tableGrid1.refresh(0,mm,true);

		  }, 	
		  });

        $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 250,	
		  close : function(){
			$Pcs2("#btnsimpan").focus();
		  },		  
		  });
 		  
        $Pcs2("#tambah").click(function() {
			fsetstok.btnsimpan.value='Simpan'
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.reset();
			datas=taptabel("setsatuan","satuanid","1=1 order by satuanid desc limit 1");
			data=datas.satuanid;
			
			if (data!=undefined)
			{
			mmsatuanid=data.substr(2,5);
			//alert(mmsatuanid);
			mmsatuanid=parseFloat(mmsatuanid);
			//alert(mmsatuanid);
			mmsatuanid=mmsatuanid+1;
			mmsatuanid=''+mmsatuanid
			mmsatuanid='S'+padl(mmsatuanid,'0',3);
			}
			else
			{
			mmsatuanid='S001';
			}
			fsetstok.msatuanid.value=mmsatuanid;

		fsetstok.msatuan.focus();fsetstok.msatuan.select();
		$Pcs2("#msatuan").click()
		})
		
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};
			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			//fsetstok.msatuanid.enabled=true;

			$Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;

			fsetstok.msatuanid.value=isi;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setsatuan&kondisi=(satuanid='"+isi+"')",
			dataType:'json',
			success: function(data){

	maj=document.getElementById("msatuanid")

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
		fsetstok.msatuan.focus();fsetstok.msatuan.select();
		$Pcs2("#msatuan").click()
	    });

        $Pcs2("#btnsimpan").click(function() {

	maj=document.getElementById("msatuanid")
	msu=$Pcs2("#msatuanid").val()
	execajaxas("delete from setsatuan where satuanid='"+msu+"'")
	execajaxas("insert into setsatuan (satuanid) values('"+msu+"')")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mtp=$Pcs2("#"+maj.id).attr('class')
		if (mtp=='fieldna')
		{
			mfieldna=maj.id.substr(1,100)
			execajaxa("update setsatuan set "+mfieldna+"='"+maj.value+"' where satuanid='"+msu+"'")
			
		}
		if (mtp=='fieldna2')
		{
			mfieldna=maj.id.substr(1,100)
			execajaxa("update setsatuan set "+mfieldna+"='"+toval(maj.value)+"' where satuanid='"+msu+"'")
			
		}

	}
	alert("Data Tersimpan !")	
	//$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
	$Pcs2("#tambah").click();
	return;	
	
	});

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			msatuanid=fsetstok.msatuanid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setsatuan where satuanid='"+msatuanid+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			execajaxa("delete from bkbesar where bpid='"+msatuanid+"'")
			execajaxs("mTransaksixx=tosald00231")
			focustogrid(0,0);
			$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});		

        $Pcs2("#btnsaldo").click(function() {
			$Pcs2("#framehrg").attr('src','setsaldosat.php')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Hutang');
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})

        $Pcs2("#btnkontak").click(function() {
			$Pcs2("#framehrg").attr('src','setkontak.php');
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak Kemasan '+$Pcs2("#msatnama").val());
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})
		
        $Pcs2("#btnkeluar").click(function() {
		tableGrid1.refresh(0,0,true);
		$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});

        $Pcs2("#tkeluar").click(function() {
		window.close();
		});
		
        $Pcs2("#tcetak").click(function() {
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
		//tableGrid1.request="msql=select * from setsatuan where (concat(satuanid,satnama,rekid) like '!!"+mfilt+"!!') order by satuanid"
		//tableGrid1.refresh()
		//});		

		$Pcs2("#tcari").keyup(function() {
			var mfilt=tcari.value;
			mfilt=mfilt.trim();
			tableGrid1.request="mfilt="+mfilt
			tableGrid1.refresh()
		});
		
		var mws=screen.width
		var mhs=screen.height
  
		$Pcs2("#mytable1").css({
		'position':'relative',
		'left':'0px',
		'height': mhs-280+'px',
		'background-color':'white',
		'font-size':'12',
		});

		var mws=screen.width
		$Pcs2("#setperxx").css({		'width': mws-680+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
		});
		
		$Pcs2("#fsetstok").keydown(function() {
			mmf2=Event.element(event);
			tabOnEnter (mmf2, event);
		})

		$Pcs2(".fieldna").focus(function() {
			mmnn=document.activeElement.id	
			$Pcs2(".trtr").css("background-color","transparent")
			$Pcs2("#tr"+mmnn).css("background-color","green")
		})
		$Pcs2(".fieldna2").focus(function() {
			mmnn=document.activeElement.id	
			$Pcs2(".trtr").css("background-color","transparent")
			$Pcs2("#tr"+mmnn).css("background-color","green")
		})
		$Pcs2(".fieldna2").keyup(function() {
			mmval=document.activeElement.value
			document.activeElement.value=tra(mmval)
		})
		
		$Pcs2("#tcari").keydown(function() {
			if (event.keyCode==13){this.blur();focustogrid(0,0);}
		})

		$Pcs2("#tcetak").click(function() {
			window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setsatuan&detitle=Master Kemasan<br>")
		})
		
    });
    </script>
    <link type="text/css" href="css/mytablegrid.css" rel="stylesheet">
    <link type="text/css" href="css/shCore.css" rel="stylesheet">
    <link type="text/css" href="css/shThemeRDark.css" rel="stylesheet" id="shTheme">
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js"></script>
	<script type="text/javascript" src="js/builder.js"></script>
	<script type="text/javascript" src="js/effects.js"></script>
	<script type="text/javascript" src="js/dragdrop.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	<script type="text/javascript" src="js/slider.js"></script>
	<script type="text/javascript" src="js/sound.js"></script>
    <script type="text/javascript" src="js/mytablegrid.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/format.js"></script>
	<script type="text/javascript" src="js/tablegrid.js"></script>
	<script type="text/javascript" src="js/keytable.js"></script>
	<script type="text/javascript" src="js/controls_002.js"></script>
    <script type="text/javascript" src="js/shCore.js"></script>
    <script type="text/javascript" src="js/shBrushJScript.js"></script>
    <script type="text/javascript" src="js/shBrushXml.js"></script>
    <script type="text/javascript" src="js/shBrushPlain.js"></script>
    <script type="text/javascript">

//    SyntaxHighlighter.config.clipboardSwf = '../scripts/highlighter/clipboard.swf';
//    SyntaxHighlighter.all();

    function toggleSampleCode(id, element) {
        if ($Pcs(id).getStyle('display') == 'none') {
            Effect.BlindDown(id);
            element.innerHTML = 'Hide sample code';
        } else {
            Effect.BlindUp(id);
            element.innerHTML = 'See sample code';
        }
    }

    var countryList = [
        {value: 'UK', text: 'United Kingdon'},
        {value: 'US', text: 'United States'},
        {value: 'CL', text: 'Chile'}
    ];

   var mws=screen.width
    var tableModel = {
        options : {
            title: 'Daftar Kemasan',
            rowClass : function(rowIdx) {
                var className = '';
                if (rowIdx % 2 == 0) {
                    className = 'hightlight';
                }
                return className;
            },
			
			pager: {
                total: 100,
                pages: 1,
                currentPage: 1,
                from: 1,
                to: 100
            },

        },
        columnModel : [
            {
                id : 'nomor',
                title : 'No.',
                type: 'number',				
                width : 40,
                editable: false,
            },
            {
                id : 'satuanid',
                title : 'Kode',
                width : 80,
                editable: false,
            },
            {
                id : 'satuan',
		title : 'Kemasan',
                width : 150,
                editable: false,
            },
            {
                id : 'satuan2',
		title : 'Kemasan 2',
                width : 150,
                editable: false,
            },
						
		],
	url: "item.php",
	request: "msql=select *,true as edit from setSatuan where (1=1) order by Satuanid"
    };

    var tableGrid1 = null;
    window.onload = function() {
		var $Pcs = jQuery.noConflict();
        tableGrid1 = new MyTableGrid(tableModel);
        tableGrid1.render('mytable1',true);	
        $Pcs('contactLink').onclick = function() {
            if ($Pcs('contact').getStyle('display') == 'none') {
                Effect.BlindDown('contact');
            } else {
                Effect.BlindUp('contact');
            }
        };
	};

	
	window.onkeypress=function(){
	};
	  
	function proses(){
		//var mm=tableGrid1.keys._yCurrentPos;
		//var isi=tableGrid1.getValueAt(1,mm);
		$Pcs("#buka").click();
		//alert(isi);
		//window.location='setsatuan.php?msatuanid='+isi;
		//cell = tableGrid1.keys.getCellFromCoords(1,1);
		//tableGrid1.keys.setFocus(cell);
		//mytable1.select();	
		//$Pcs("#kotakdialog").dialog('open');
	}

	function focustogrid(xx,yy){
		cell = tableGrid1.keys.getCellFromCoords(xx,yy);
		tableGrid1.keys.setFocus(cell);
		tableGrid1.keys.captureKeys();
		tableGrid1.keys.eventFire("action", tableGrid1.keys._nCurrentFocus);
	}
</script>
</head>

<body background='images/num.jpg'>
<?php 
	require("menu.php");
?>	
			
	<font face='arial' color='white'>
	<table>
	<tr>
	</td>
	<b>
	C a r i : <input type='text' id='tcari' size=47>
	</b>
	</td>
	</tr>
	</table>
	</font>
	
	<div id="mytable1" >
	</div>	

	<div id='tombols' style="position:Relative;left:5px">
	<hr>
	<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
	<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
	<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
	<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
	<input type='button' id="tkeluar" value="Tutup" >
	</div>
    
	<div id="kotakdialog" title="Setup Kemasan">	
	<form name='fsetstok' id='fsetstok'>
	<font size=4>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>

	<?php
	$msql="
	SELECT COLUMN_NAME kolom, DATA_TYPE tipe, NUMERIC_PRECISION panjang1, CHARACTER_MAXIMUM_LENGTH panjang2, COLUMN_COMMENT koment
	FROM information_schema.COLUMNS
	WHERE TABLE_SCHEMA='siamart_2jaya_data' and TABLE_NAME='setsatuan' and COLUMN_COMMENT <>''
	order by COLUMN_COMMENT
	";

	$rww=executerow($msql);
	while ($row=mysql_fetch_assoc($rww))
	{
	
	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{$mpand=60;}
	$mpand=20;
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';
	
	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
	$mtpe=" style='font-size:10pt;text-align:right'  class='fieldna2'";
	}	
	
	if (($row[kolom])=='satuanid')
	{$mrod='readonly';}
	echo "<tr>";
	echo "<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>";
	echo "&nbsp;".substr($row[koment],2,100)."";
	echo "</td>";
	echo "<td>";
	echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod >";
	echo "</td>";
	echo "</tr>";
	}

	?>
	</table>
	<hr>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnhapus' value=Hapus>
	<input type=button id='btnkeluar' value=Tutup>
	</p>
	</form>
	</div>

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=400></td></tr>
		</center>
	</div>	
	
</body>
</html>