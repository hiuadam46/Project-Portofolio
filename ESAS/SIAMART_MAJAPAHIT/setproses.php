<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>proses</title>
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
		  width : 665,
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
		  width : 850,	
		  close : function(){
			$Pcs2("#btnsimpan").focus();
		  },		  
		  });
 		  
        $Pcs2("#tambah").click(function() {
			fsetstok.btnsimpan.value='Simpan'
			$Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.reset();
			datas=taptabel("setproses","prosesid","1=1 order by prosesid desc limit 1");
			data=datas.prosesid;
			
			if (data!=undefined)
			{
			mprosesid=data.substr(1,5);
			//alert(mprosesid);
			mprosesid=parseFloat(mprosesid);
			//alert(mprosesid);
			mprosesid=mprosesid+1;
			mprosesid=''+mprosesid
			mprosesid='P'+padl(mprosesid,'0',3);
			}
			else
			{
			mprosesid='P001';
			}
			fsetstok.mprosesid.value=mprosesid;

		fsetstok.nama.focus();fsetstok.nama.select();
		$Pcs2("#nama").click()
		})
		
        $Pcs2("#buka").click(function() {

			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};
			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			fsetstok.mprosesid.enabled=true;
			$Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;

			fsetstok.mprosesid.value=isi;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setproses&kondisi=(prosesid='"+isi+"')",
			dataType:'json',
			success: function(data){

	maj=document.getElementById("mprosesid")

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
			fsetstok.msupnama.focus();fsetstok.msupnama.select();
	    });

        $Pcs2("#btnsimpan").click(function() {
	maj=document.getElementById("mprosesid")
	msu=maj.value
	execajaxas("delete from setproses where prosesid='"+msu+"'")
	execajaxas("insert into setproses (prosesid) values('"+msu+"')")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mtp=$Pcs2("#"+maj.id).attr('class')
		if (mtp=='fieldna')
		{
			mfieldna=maj.id.substr(1,100)
			execajaxa("update setproses set "+mfieldna+"='"+maj.value+"' where prosesid='"+msu+"'")
			
		}
		if (mtp=='fieldna2')
		{
			mfieldna=maj.id.substr(1,100)
			execajaxa("update setproses set "+mfieldna+"='"+toval(maj.value)+"' where prosesid='"+msu+"'")
			
		}

	}
	alert("Data Tersimpan !")	
	$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
	return;	
	
	});

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			prosesid=fsetstok.mprosesid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setproses where prosesid='"+prosesid+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			execajaxa("delete from bkbesar where bpid='"+prosesid+"'")
			execajaxs("mTransaksixx=tosald00231")
			focustogrid(0,0);
			$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});		

        $Pcs2("#btnsaldo").click(function() {
			$Pcs2("#framehrg").attr('src','setsaldosup.php')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Hutang');
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})

        $Pcs2("#btnkontak").click(function() {
			$Pcs2("#framehrg").attr('src','setkontak.php');
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak proses '+$Pcs2("#msupnama").val());
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
		//tableGrid1.request="msql=select * from setproses where (concat(prosesid,supnama,rekid) like '!!"+mfilt+"!!') order by prosesid"
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
			window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setproses&detitle=Master proses<br>")
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
            title: 'Daftar proses',
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
                id : 'prosesid',
                title : 'Kode',
                width : 50,
                editable: false,
            },
            {
                id : 'nama',
                title : 'Nama',
                width : 200,
                editable: false,
            },
            {
                id : 'ket',
                title : 'Keterangan',
                width : 200,
                editable: false,
            },			
            {
                id : 'upah',
                title : 'Upah/Kg',
                type: 'number',				
                width : 80,
                editable: false,
            },
		],
	url: "item.php?query=select * from setproses order by prosesid",
	request: ""
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
		//window.location='setproses.php?prosesid='+isi;
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
    
	<div id="kotakdialog" title="Setup proses">	
	<form name='fsetstok' id='fsetstok'>
	<font size=4>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>

	<?php

	

	$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH 	
	panjang2,COLUMN_COMMENT koment
	FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='siamart_majapahit_data' and TABLE_NAME='setproses' and COLUMN_COMMENT<>''
	order by COLUMN_COMMENT";

	$rww=executerow($msql);
	while ($row=mysql_fetch_assoc($rww))
	{
	
	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{$mpand=60;}
	$mpand=60;
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';
	
	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
	$mtpe=" style='font-size:10pt;text-align:right'  class='fieldna2'";
	}	
	
	if (($row[kolom])=='prosesid')
	{$mrod='readonly';}
	echo "<tr>";
	echo "<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>";
	echo "&nbsp;".substr($row[koment],2,100)."";
	echo "</td>";
	echo "<td>";
	echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' name='".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod >";
	echo "</td>";
	echo "</tr>";
	}

	?>
	</table>
	<hr><<a href id='btnsaldo'><i>Awal Hutang</i></a>>
	&nbsp;&nbsp;&nbsp;<input type=button id='btnsimpan' value=Simpan>
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