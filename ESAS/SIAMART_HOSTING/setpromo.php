<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_pancurmas',$links);
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
    <title>promo</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script type="text/javascript">
	  var $Pcs2 = jQuery.noConflict();
	  var dialogisopen=false;
	  var baru=true;
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
		  width : 400,
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
		  width : 300,	
		  close : function(){
			$Pcs2("#btnsimpan").focus();
		  },		  
		  });
 		  
        $Pcs2("#tambah").click(function() {
			fsetstok.btnsimpan.value='Simpan'
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.reset();
			datas=taptabel("setpromo","promo1","1=1 order by promo1 desc limit 1");
			data=datas.promo1;
			
			if (data!=undefined)
			{
			mmpromo1=data.substr(1,5);
			//alert(mmpromo1);
			mmpromo1=parseFloat(mmpromo1);
			//alert(mmpromo1);
			mmpromo1=mmpromo1+1;
			mmpromo1=''+mmpromo1
			mmpromo1='G'+padl(mmpromo1,'0',3);
			}
			else
			{
			mmpromo1='G001';
			}
			fsetstok.mpromo1.value=mmpromo1;

		fsetstok.mgrpnama.focus();fsetstok.mgrpnama.select();
		$Pcs2("#msatnama").click()
		})
		
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};
			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			//fsetstok.mpromo1.enabled=true;

			$Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;

			fsetstok.mpromo1.value=isi;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setpromo&kondisi=(promo1='"+isi+"')",
			dataType:'json',
			success: function(data){

	maj=document.getElementById("mpromo1")

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
			fsetstok.mgrpnama.focus();fsetstok.mgrpnama.select();
	    });

        $Pcs2("#btnsimpan").click(function() {

	execajaxas("delete from setpromo")
	execajaxas("insert into setpromo(promo1) values('') ")

	for (var mii=1;mii<18;mii++)
	{
	execajaxa("update setpromo set promo"+mii+"='"+$Pcs2("#mpromo"+mii).val()+"' ")
	}

	alert("Data Tersimpan !")	
	//$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
	$Pcs2("#tambah").click();
	return;	
	
	});

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			mpromo1=fsetstok.mpromo1.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setpromo where promo1='"+mpromo1+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			execajaxa("delete from bkbesar where bpid='"+mpromo1+"'")
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
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak promo '+$Pcs2("#msatnama").val());
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})
		
        $Pcs2("#btnkeluar").click(function() {
		self.close()
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
		//tableGrid1.request="msql=select * from setpromo where (concat(promo1,satnama,rekid) like '!!"+mfilt+"!!') order by promo1"
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
			window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setpromo&detitle=Master promo<br>")
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
            title: 'Daftar promo',
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
                id : 'promo1',
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
	request: "msql=select a.*,b.reknama,true as edit from setpromo a left join setrek b on a.rekid=b.rekid where (1=1) order by promo1"
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
		//window.location='setpromo.php?mpromo1='+isi;
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
	<form id='fsetstok'>
	Promo Hari Ini
	<hr>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>

	<?php

	$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH 	
	panjang2,COLUMN_COMMENT koment
	FROM information_schema.COLUMNS 
	WHERE TABLE_SCHEMA='esae1797_pancurmas' and 
	TABLE_NAME='setpromo' and 
	COLUMN_COMMENT <>'' 
	order by 
	COLUMN_COMMENT";

	$rww=executerow($msql);
	$mnom=1;
	while ($row=mysql_fetch_assoc($rww))
	{
	
	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{$mpand=60;}
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';
	
	$mtpe="style='font-size:10pt;' class='fieldna'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
	$mtpe=" style='font-size:10pt;text-align:right'  class='fieldna2'";
	}	

	$eert=execute("select promo$mnom as pro from setpromo");
	
	echo "<tr>";
	echo "<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>";
	echo "&nbsp;".substr($row[koment],2,100)."";
	if ($row[kolom]=='promo12')
	{
	echo "<hr>";
	}
	echo "</td>";
	echo "<td> ";
	echo ": <input width=65% type=$row[koment] id='m".$row[kolom]."' $mtpe maxlength=$mmax size=$mpand $mrod value='$eert[pro]'>";

	if ($row[kolom]=='promo12')
	{
	echo "<hr>";
	}
	
	echo "</td>";
	echo "</tr>";
	$mnom++;
	}


	?>
	</table>
	<hr>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnkeluar' value=Tutup>
	</p>
	</form>
	
</body>
</html>