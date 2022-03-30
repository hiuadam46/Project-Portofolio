<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_dwijaya_data',$links);
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
    <title>Nomor Faktur Pajak</title>
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

	execajaxas("create table setnomorfakturpajak(nomorfp varchar(19) default '',jumlah int default 0,nidpakai varchar(10) default '') ")

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
		  width : 500,	
		  close : function(){
			$Pcs2("#btnsimpan").focus();
		  },		  
		  });
 		  
        $Pcs2("#tambah").click(function() {
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Isikan Nomer Awal Faktur Pajak');
            $Pcs2("#kotakdialog2").dialog('open');
		})

        $Pcs2("#btnok").click(function() {
/*
			nom=prompt("Isikan Nomer Awal Faktur Pajak")
			pan=nom.length
			if (pan!=16)
			{
			alert("Jumlah Digit harus 16 !")
			return
			}
*/
			execajaxas("delete from setnomorfakturpajak")
			nom=$Pcs2("#digit1").val()+'.'+$Pcs2("#digit2").val()+'-'+$Pcs2("#digit3").val()+'.'+$Pcs2("#digit4").val()
			jum=$Pcs2("#tjumlah").val()
			jum=parseFloat(jum,0)
			execajaxa("insert into setnomorfakturpajak(nomorfp) values('"+nom+"') ")
			awal=$Pcs2("#digit1").val()+'.'+$Pcs2("#digit2").val()+'-'+$Pcs2("#digit3").val()+'.'
			akhir=$Pcs2("#digit4").val()
			akhirn=parseFloat(akhir)
			for (abg=1;abg<jum;abg++)
			{

			akhirn2=akhirn+1
			akhirn=akhirn2
			akhirn2=akhirn2+''
			nom=awal+padl(akhirn2,'0',8)
			execajaxa("insert into setnomorfakturpajak(nomorfp) values('"+nom+"') ")
				
			}
			alert("Simpan Selesai")
			tableGrid1.refresh(0,0,true);
		
		})
		
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};
			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			//fsetstok.mgrpid.enabled=true;

			$Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;

			fsetstok.mgrpid.value=isi;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setnomorfakturpajak&kondisi=(grpid='"+isi+"')",
			dataType:'json',
			success: function(data){

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
			fsetstok.mgrpnama.focus();fsetstok.mgrpnama.select();
	    });

        $Pcs2("#btnsimpan").click(function() {

	maj=document.getElementById("mgrpid")
	msu=$Pcs2("#mgrpid").val()

	alert("Data Tersimpan !")	
	//$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
	$Pcs2("#tambah").click();
	return;	
	
	});

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			mgrpid=fsetstok.mgrpid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setnomorfakturpajak where grpid='"+mgrpid+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			execajaxa("delete from bkbesar where bpid='"+mgrpid+"'")
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
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Kontak grup '+$Pcs2("#msatnama").val());
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
		
		$Pcs2("#tcari").keyup(function() {
		var mfilt=tcari.value;
		mfilt=mfilt.trim();
		tableGrid1.request="msql=select * from setnomorfakturpajak where nomorfp like '!!"+mfilt+"!!') order by nomorfp"
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
			window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setnomorfakturpajak&detitle=Master grup<br>")
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
            title: 'Daftar grup',
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
                id : 'nomorfp',
                title : 'Nomor Faktur Pajak',
                width : 500,
                editable: false,
            },						
            {
                id : 'nidpakai',
                title : 'Terpakai',
                width : 500,
                editable: false,
            },						
		],
	url: "item.php",
	request: "msql=select * from setnomorfakturpajak where (1=1) order by nomorfp"
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
		//window.location='setnomorfakturpajak.php?mgrpid='+isi;
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
	<input type='button' id="tambah" value="Isi Nomer Baru" >&nbsp;&nbsp;
	<input type='button' id="tkeluar" value="Tutup" >
	</div>
    
	<div id="kotakdialog2">
		<center>
		<form name='fsetstok' id='fsetstok'>
		No. Awal : <input type=text size=3 id='digit1' maxlength=3> . <input type=text size=3 id='digit2' maxlength=3> - <input type=text size=2 id='digit3' maxlength=2> . <input type=text size=8 id='digit4' maxlength=8>
		<br>Jumlah : <input type=text id='tjumlah'>	
		<br><input type=button value='OK' id='btnok'>	
		</form>
		</center>
	</div>	
	
</body>
</html>