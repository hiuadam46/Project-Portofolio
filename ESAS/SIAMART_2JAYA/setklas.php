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
    <title>Master Klasifikasi</title>
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
			data: "func=EXEC&field=clid&tabel=setklas&kondisi=(1=1)  order by clid desc limit 1",
			dataType:'json',
			success: function(data){
			data=data.clid;
			//alert(data);
			if (data!=undefined)
			{
			mmclid=data.substr(1,3);
			//alert(mmclid);
			mmclid=parseFloat(mmclid);
			//alert(mmclid);
			mmclid=mmclid+1;
			mmclid=''+mmclid
			mmclid=padl(mmclid,'0',3);
			}
			else
			{
			mmclid='001';
			}
			fsetstok.mclid.value=mmclid;
			}
		});
		fsetstok.mclnama.focus();fsetstok.mclnama.select();
		$Pcs2("#mclnama").click()
		})
		
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};

			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			fsetstok.mclid.enabled=true;
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.mclid.value=isi;

			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setklas&kondisi=(clid='"+isi+"')",
			dataType:'json',
			success: function(data){
			fsetstok.mclnama.value=data.clnama;
			fsetstok.msupid.value=data.clid;
			fsetstok.mdork.value=data.dork;
			fsetstok.mposisi.value=data.posisi;			
			}
			});
			fsetstok.mclid.focus();fsetstok.mclid.select();
	    });

        $Pcs2("#btnsimpan").click(function() {
			mclid=fsetstok.mclid.value;
			mclnama=fsetstok.mclnama.value;
			mdork=fsetstok.mdork.value;
			mposisi=fsetstok.mposisi.value;
			
			//Ceking valid
			if (mclnama==''){alert('Nama Tidak Boleh Kosong!');fsetstok.mclnama.select();return}
			//
			var conf=window.confirm("Simpan Transaksi ?")
			if (conf==false){return}
			
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setklas where clid='"+mclid+"'",
			//dataType:'json',
			success : function(data){
			if(data==1)
			{

				$Pcs2.ajax({
				type:"POST",
				url:"phpexec.php",
				data: "func=EXECUTE&comm=insert into setklas values('"+mclid+"','"+mclnama+"','"+mdork+"','"+mposisi+"')",
				//dataType:'json',
				success: function(data){
				//alert(data);
				if (data==1)
				{
					mcapt=fsetstok.btnsimpan.value
					if(mcapt=='Edit')
						{
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
		
			mclid=fsetstok.mclid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setklas where clid='"+mclid+"'",
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
		//tableGrid1.request="msql=select * from setklas where (concat(clid,clnama,rekid) like '!!"+mfilt+"!!') order by clid"
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
            title: 'Daftar Klasifikasi',
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
                id : 'clid',
                title : 'Kode',
                width : 80,
                editable: false,
            },
            {
                id : 'clnama',
                title : 'Uraian',
                width : 150,
                editable: false,
            },
            {
                id : 'dk',
                title : 'default',
                width : 80,
                editable: false,
            },
            {
                id : 'neraca',
                title : 'Posisi Neraca',
                width : 100,
                editable: false,
            },
			            
        ],
	url: "item.php?mTparam=sncll",
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
		//window.location='setklas.php?mclid='+isi;
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
    
	<div id="kotakdialog" title="Setup Klasifikasi">
	<form name='fsetstok' id='fsetstok'>
	Kode <br>&nbsp;<input type=text id=mclid maxlength=5 readonly>
	Nama <br>&nbsp;<input type=text id=mclnama>

	<br>Default <br>&nbsp;<select id=mdork>
	<option value='D'>Debet</option>
	<option value='K'>Kredit</option>
	</select>

	<br>Posisi <br>&nbsp;<select id=mposisi>
	<option value='A'>Aktiva</option>
	<option value='P'>Pasiva</option>
	<option value='D'>Pendapatan</option>
	<option value='B'>Beban</option>
	</select>
	
	<hr>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnhapus' value=Hapus>
	<input type=button id='btnkeluar' value=Tutup>
	</form>
	</div>
	
</body>
</html>