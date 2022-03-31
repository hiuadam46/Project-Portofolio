<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_pelangi_data',$links);
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
    <title>Master Rekening</title>
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
		  show: true,
		  hide: true,
		  width : 500,
		  dragable: true,
        });

        $Pcs2("#tambah").click(function() {
			fsetstok.btnsimpan.value='Simpan'
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.reset();
			
		$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=rekid&tabel=setrek&kondisi=(1=1)  order by rekid desc limit 1",
			dataType:'json',
			success: function(data){
			data=data.rekid;
			//alert(data);
			if (data!=undefined)
			{
			mmrekid=data.substr(1,3);
			//alert(mmrekid);
			mmrekid=parseFloat(mmrekid);
			//alert(mmrekid);
			mmrekid=mmrekid+1;
			mmrekid=''+mmrekid
			mmrekid=padl(mmrekid,'0',3);
			}
			else
			{
			mmrekid='001';
			}
			fsetstok.mrekid.value=mmrekid;
			}
		});
		fsetstok.mreknama.focus();fsetstok.mreknama.select();
		$Pcs2("#mreknama").click()
		})
		
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};

			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			fsetstok.mrekid.enabled=true;
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.mrekid.value=isi;

			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setrek&kondisi=(rekid='"+isi+"')",
			dataType:'json',
			success: function(data){
			fsetstok.mreknama.value=data.reknama;
			fsetstok.mrekid.value=data.rekid;
			fsetstok.mnrcid.value=data.nrcid;
			msal=taptabel('bkbesar','debet-kredit sa',"rekid='"+isi+"' and trans='SA'")
if (msal.sa!=undefined)
{
			fsetstok.msaldoawal.value=tra(toval(msal.sa))
}
else
{
			fsetstok.msaldoawal.value='0'
}

			}
			});
			fsetstok.mrekid.focus();fsetstok.mrekid.select();
	    });

        $Pcs2("#btnsimpan").click(function() {
			mrekid=fsetstok.mrekid.value;
			mreknama=fsetstok.mreknama.value;
			mnrcid=fsetstok.mnrcid.value;
			msaldoawal=fsetstok.msaldoawal.value;

			
			//Ceking valid
			if (mreknama==''){alert('Nama Tidak Boleh Kosong!');fsetstok.mreknama.select();return}
			//
			var conf=window.confirm("Simpan Transaksi ?")
			if (conf==false){return}
			
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setrek where rekid='"+mrekid+"'",
			//dataType:'json',
			success : function(data){
			if(data==1)
			{

				$Pcs2.ajax({
				type:"POST",
				url:"phpexec.php",
				data: "func=EXECUTE&comm=insert into setrek values('"+mrekid+"','"+mreknama+"','"+mnrcid+"')",
				//dataType:'json',
				success: function(data){
				//alert(data);
				if (data==1)
				{
					mcapt=fsetstok.btnsimpan.value
					if(mcapt=='Edit')
						{
						fsetstok.mTransaksixx.value='fsstrrr001';
						transaksi("mTransaksixx=fsstrrr001&mrekid="+mrekid+"&mnrcid="+mnrcid+"&msaldoawal="+msaldoawal);						
						mmxx=tableGrid1.keys._yCurrentPos;
						tableGrid1.refresh(0,mmxx,true);
						//focustogrid(0,mmxx);
						$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
						}
					else
						{
						tableGrid1.refresh();						
						tambah.click();
						}
		
				}
				}
				})
		
			}	
		
		
			}
		})
		});

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			mrekid=fsetstok.mrekid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setrek where rekid='"+mrekid+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			focustogrid(0,0);
			$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});		
	
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
		//tableGrid1.request="msql=select * from setrek where (concat(rekid,reknama,rekid) like '!!"+mfilt+"!!') order by rekid"
		//tableGrid1.refresh()
		//});		

		$Pcs2("#tcari").keyup(function() {
			var mfilt=tcari.value;
			mfilt=mfilt.trim();
			tableGrid1.request="mfilt="+mfilt
			tableGrid1.refresh()
		});
		
		var mws=screen.width
  
		$Pcs2("#mytable1").css({
		'position':'relative',
		'height': '400px',
		'background-color':'white',
		'font-size':'12',
		});

		$Pcs2("#fsetstok").keydown(function() {
			mmf2=Event.element(event);
			tabOnEnter (mmf2, event);
		})
				
		$Pcs2("#tcari").keydown(function() {
			if (event.keyCode==13){this.blur();focustogrid(0,0);}
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
            title: 'Daftar Rekening',
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
                id : 'rekid',
                title : 'Kode',
                width : 80,
                editable: false,
            },
            {
                id : 'reknama',
                title : 'Uraian',
                width : 250,
                editable: false,
            },
            {
                id : 'nrcid',
                title : 'Kode Neraca',
                width : 80,
                editable: false,
            },
            {
                id : 'nrcnama',
                title : 'Nama Neraca',
                width : 100,
                editable: false,
            },
			            
        ],
	url: "item.php?mTparam=rrrkkk",
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
		//window.location='setrek.php?mrekid='+isi;
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
	
	<div id="mytable1"  ondblclick="proses()" >
	</div>
	
	<hr>
	<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
	<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
	<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
	<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
	<input type='button' id="tkeluar" value="Tutup" >
    
	<div id="kotakdialog" title="Setup Rekening">
	<form name='fsetstok' id='fsetstok'>
	Kode <br>&nbsp;<input type=text id=mrekid maxlength=5>
	<br>Nama <br>&nbsp;<input type=text id=mreknama size=30>

	<br>Neraca <br>&nbsp;<select id=mnrcid>
	<?php
	
	$misetsup=executerow("select * from setneraca order by nrcid");
	while ($setsup=mysql_fetch_assoc ($misetsup))
	{
	$msupid=$setsup[nrcid];
	$msupnama=$setsup[nrcnama];
	echo("<option value=$msupid>$msupid - $msupnama</option>");
	}
	?>
	</select>
	<br>Saldo Awal Rp. <br>&nbsp;<input type=text id=msaldoawal style="text-align:right">
	<input type=hidden id=mTransaksixx name=mTransaksixx>
	<br><hr>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnhapus' value=Hapus>
	<input type=button id='btnkeluar' value=Tutup>
	</form>
	</div>
	
</body>
</html>